<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->paginate(5);
        return view('payments.index', compact('payments'));
        // dd(compact('payments'));
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
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $payment_proof_path = $request->file('payment_proof')->store('payment_proofs', 'public');

        Payment::create([
            'booking_id' => $request->booking_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->total_price,
            'status' => 'waiting',
            'payment_proof' => $payment_proof_path,
        ]);

        Booking::where('id', $request->booking_id)->update([
            'status' => 'waiting',
        ]);

        return redirect()->route('landing-page')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function paymentApprove($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'approved',
        ]);

        Booking::where('id', $payment->booking_id)->update([
            'status' => 'approved',
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function paymentReject($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'rejected',
        ]);

        Booking::where('id', $payment->booking_id)->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditolak.');
    }
}
