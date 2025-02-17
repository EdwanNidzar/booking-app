<x-app-layout>
    <x-slot name="header">
      {{ __('Detail Booking') }}
    </x-slot>
  
    <div class="p-4 bg-white rounded-lg shadow-xs">
      <h1 class="text-2xl font-semibold text-gray-800">Detail Booking</h1>
  
      <div class="mt-4">
        <p><strong>Nama Pengguna:</strong> {{ $booking->user->name }}</p>
        <p><strong>Nama Penginapan:</strong>{{ $booking->penginapan ? $booking->penginapan->nama_penginapan : ($booking->aula ? $booking->aula->nama_aula : '-') }}</p>
        <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</p>
        <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</p>
        <p><strong>Jumlah Tamu:</strong> {{ $booking->total_guest }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
        <p><strong>Status:</strong>
          @if ($booking->status === 'approved')
            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-lg">Approved</span>
          @elseif ($booking->status === 'rejected')
            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-200 rounded-lg">Rejected</span>
          @else
            <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-200 rounded-lg">Pending</span>
          @endif
  
      <div class="mt-6">
        <a href="{{ route('bookings.index') }}"
          class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
      </div>
    </div>
  </x-app-layout>