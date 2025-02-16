<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Aula;

class LandingPageController extends Controller
{
    public function index()
    {
        $penginapans = Penginapan::with(['host', 'properties'])
            ->where('status', 'active')
            ->whereDoesntHave('bookings', function ($query) {
                $query->whereIn('status', ['pending', 'approved']);
            })
            ->get();

        $aulas = Aula::with(['host', 'properties'])
            ->where('status', 'active')
            ->whereDoesntHave('bookings', function ($query) {
                $query->whereIn('status', ['pending', 'approved']);
            })
            ->get();
        
        return view('welcome', compact('penginapans', 'aulas'));
    }

    public function booking(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan.');
        }

        // Validasi input
        $request->validate([
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'total_guest' => 'required|integer|min:1',
            'penginapan_id' => 'nullable',
            'aula_id' => 'nullable'
        ]);

        // Pastikan hanya salah satu yang dipilih
        if ($request->penginapan_id && $request->aula_id) {
            return redirect()->back()->with('error', 'Pilih salah satu antara penginapan atau aula.');
        }

        return DB::transaction(function () use ($request) {
            if ($request->penginapan_id) {
                $item = Penginapan::lockForUpdate()->findOrFail($request->penginapan_id);
            } elseif ($request->aula_id) {
                $item = Aula::lockForUpdate()->findOrFail($request->aula_id);
            } else {
                return redirect()->back()->with('error', 'Harap pilih penginapan atau aula.');
            }

            // Cek apakah penginapan/aula sudah dipesan pada tanggal tersebut
            $existingBooking = Booking::where(function ($query) use ($request) {
                $query->whereBetween('check_in', [$request->tanggal_checkin, $request->tanggal_checkout])
                    ->orWhereBetween('check_out', [$request->tanggal_checkin, $request->tanggal_checkout])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('check_in', '<=', $request->tanggal_checkin)
                            ->where('check_out', '>=', $request->tanggal_checkout);
                    });
            })
            ->whereIn('status', ['pending', 'approved'])
            ->when($request->penginapan_id, function ($query) use ($request) {
                $query->where('penginapan_id', $request->penginapan_id);
            })
            ->when($request->aula_id, function ($query) use ($request) {
                $query->where('aula_id', $request->aula_id);
            })
            ->exists();

            if ($existingBooking) {
                return redirect()->back()->with('error', 'Sudah ada pemesanan pada tanggal tersebut.');
            }

            // Simpan booking
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'penginapan_id' => $request->penginapan_id ?? null,
                'aula_id' => $request->aula_id ?? null,
                'check_in' => $request->tanggal_checkin,
                'check_out' => $request->tanggal_checkout,
                'total_guest' => $request->total_guest,
                'total_price' => $item->price,
                'status' => 'pending',
            ]);

            return redirect()->route('landing-page')->with('success', 'Pemesanan berhasil! Tunggu konfirmasi.')->with('booking', $booking);
        });
    }

    public function receipt()
    {
        $booking = Booking::with('user', 'penginapan', 'aula')->where('user_id', auth()->id())->where('status', 'approved')->get();

        return response()->json($booking);
    }
}
