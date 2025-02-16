<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'penginapan', 'aula')->orderBy('id', 'desc')->paginate(5);
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
        $bookings = Booking::with('penginapan', 'aula')->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return response()->json($bookings);
    }

    public function reportBooking()
    {
        $bookings = Booking::with('user', 'penginapan', 'aula')->orderBy('id', 'desc')->get();
        $pdf = PDF::loadView('bookings.report', compact('bookings'));
        return $pdf->stream('report-booking.pdf');
    }

}
