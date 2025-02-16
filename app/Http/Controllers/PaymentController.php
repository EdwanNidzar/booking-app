<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->get();
        return view('payments.index', compact('payments'));
    }

    public function create($id)
    {
        $bookings = Booking::where('status', 'pending')->where('id', $id)->firstOrFail();
        return view('payments.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric|min:0',
        ]);

        Payment::create([
            'booking_id' => $request->booking_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->total_price,
            'status' => 'success',
        ]);

        Booking::where('id', $request->booking_id)->update([
            'status' => 'approved',
        ]);

        return redirect()->route('landing-page')->with('success', 'Pembayaran berhasil ditambahkan.');
    }
}
