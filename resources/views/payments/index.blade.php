<x-app-layout>
  <x-slot name="header">
    {{ __('Daftar Pembayaran') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Pembayaran</h1>
    <x-alert-notification />

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
              <th class="px-4 py-3">Nama</th>
              <th class="px-4 py-3">Metode Pembayaran</th>
              <th class="px-4 py-3">Jumlah Pembayaran</th>
              <th class="px-4 py-3">Bukti Pembayaran</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @foreach ($payments as $payment)
              <tr class="text-gray-700">
                <td class="px-4 py-3">{{ $payment->booking->user->name }}</td>
                <td class="px-4 py-3">{{ $payment->payment_method }}</td>
                <td class="px-4 py-3">{{ $payment->amount }}</td>
                <td class="px-4 py-3">
                  <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank">
                    <span class="text-blue-500">Lihat Bukti Pembayaran</span>
                  </a>
                </td>
                <td class="px-4 py-3">
                  {{ $payment->status }}
                </td>
                <td class="px-4 py-3">
                  @if ($payment->status == 'waiting')
                    <div class="flex justify-center space-x-1">
                      <form action="{{ route('payments.approved', $payment->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menyetujui pembayaran ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-green-500 hover:text-green-700">
                          <x-icons.approve />
                        </button>
                      </form>

                      <form action="{{ route('payments.rejected', $payment->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menolak pembayaran ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                          <x-icons.reject />
                        </button>
                      </form>
                    </div>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t">
        {{ $payments->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
