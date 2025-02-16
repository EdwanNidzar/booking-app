<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;

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
        return view('welcome', compact('penginapans'));
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
        ]);

        return DB::transaction(function () use ($request, $id) {
            $penginapan = Penginapan::lockForUpdate()->findOrFail($id);

            // Cek apakah penginapan masih tersedia di tanggal tersebut
            $existingBooking = Booking::where('penginapan_id', $penginapan->id)
                ->where(function ($query) use ($request) {
                    $query
                        ->whereBetween('check_in', [$request->tanggal_checkin, $request->tanggal_checkout])
                        ->orWhereBetween('check_out', [$request->tanggal_checkin, $request->tanggal_checkout])
                        ->orWhere(function ($q) use ($request) {
                            $q->where('check_in', '<=', $request->tanggal_checkin)->where('check_out', '>=', $request->tanggal_checkout);
                        });
                })
                ->whereIn('status', ['pending', 'approved'])
                ->exists();

            if ($existingBooking) {
                return redirect()->back()->with('error', 'Penginapan sudah dipesan pada tanggal tersebut.');
            }

            // Simpan data booking ke database
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'penginapan_id' => $penginapan->id,
                'check_in' => $request->tanggal_checkin,
                'check_out' => $request->tanggal_checkout,
                'total_guest' => $request->total_guest,
                'total_price' => $penginapan->price,
                'status' => 'pending',
            ]);

            // Use the $booking variable
            return redirect()->route('landing-page')->with('success', 'Pemesanan berhasil! Tunggu konfirmasi dari pemilik penginapan.')->with('booking', $booking);
        });
    }

    public function receipt()
    {
        $booking = Booking::with('user', 'penginapan')->where('user_id', auth()->id())->where('status', 'approved')->get();

        return response()->json($booking);
    }
}
