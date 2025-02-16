<x-app-layout>
  <x-slot name="header">
    {{ __('Daftar Booking') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Daftar Booking</h1>
    <x-alert-notification />

    <div class="mt-4 mb-4 float-right">

      <a href="{{ route('reportBooking') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600"
        target="_blank">
        Export PDF
      </a>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
              <th class="px-4 py-3">Nama Pengguna</th>
              <th class="px-4 py-3">Nama Penginapan / Aula</th>
              <th class="px-4 py-3">Check-in</th>
              <th class="px-4 py-3">Check-out</th>
              <th class="px-4 py-3">Jumlah Tamu</th>
              <th class="px-4 py-3">Total Harga</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @foreach ($bookings as $booking)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $booking->user->name }}</td>
                <td class="px-4 py-3 text-sm">
                  {{ $booking->penginapan ? $booking->penginapan->nama_penginapan : ($booking->aula ? $booking->aula->nama_aula : '-') }}
                </td>
                <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
                <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
                <td class="px-4 py-3 text-sm">{{ $booking->total_guest }}</td>
                <td class="px-4 py-3 text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-sm">
                  @if ($booking->status === 'approved')
                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-200 rounded-lg">Approved</span>
                  @elseif ($booking->status === 'rejected')
                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-200 rounded-lg">Rejected</span>
                  @else
                    <span
                      class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-200 rounded-lg">Pending</span>
                  @endif
                </td>
                <td class="px-4 py-3 text-sm text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500 hover:text-blue-700">
                      <x-icons.show />
                    </a>

                    @if ($booking->status === 'pending')
                      <form action="{{ route('bookings.approved', $booking->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menyetujui booking ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-green-500 hover:text-green-700">
                          <x-icons.approve />
                        </button>
                      </form>

                      <form action="{{ route('bookings.rejected', $booking->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menolak booking ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                          <x-icons.reject />
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t">
        {{ $bookings->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
