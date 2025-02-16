<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'penginapan')->orderBy('id', 'desc')->paginate(5);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function updateStatusApproved(Booking $booking)
    {
        if ($booking->status === 'approved') {
            return redirect()->back()->with('info', 'Booking sudah disetujui sebelumnya.');
        }

        $booking->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Status booking berhasil disetujui.');
    }

    public function updateStatusRejected(Booking $booking)
    {
        if ($booking->status === 'rejected') {
            return redirect()->back()->with('info', 'Booking sudah ditolak sebelumnya.');
        }

        $booking->update([
            'status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Status booking berhasil ditolak.');
    }

    public function cart()
    {
        $bookings = Booking::with('penginapan')->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json($bookings);
    }

}
