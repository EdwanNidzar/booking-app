<x-app-layout>
  <x-slot name="header">
    {{ __('Penginapan') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Penginapan</h1>
    <x-alert-notification />

    <div class="mt-4 mb-4 float-right">
      <a href="{{ route('penginapan.create') }}"
        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah Penginapan</a>
      <a href="#" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600" target="_blank">Export
        PDF</a>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
              <th class="px-4 py-3">Pemilik</th>
              <th class="px-4 py-3">Nama Penginapan</th>
              <th class="px-4 py-3">Lokasi Penginapan</th>
              <th class="px-4 py-3">Photo</th>
              <th class="px-4 py-3">Harga</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @foreach ($penginapans as $penginapan)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $penginapan->host->name }}</td>
                <td class="px-4 py-3 text-sm">{{ $penginapan->nama_penginapan }}</td>
                <td class="px-4 py-3 text-sm">{{ $penginapan->location }}</td>
                <td class="px-4 py-3 text-sm text-center">
                  <img src="{{ asset('storage/' . $penginapan->photo) }}" alt="{{ $penginapan->nama_penginapan }}"
                    class="w-16 h-16 rounded">
                </td>
                <td class="px-4 py-3 text-sm">Rp{{ number_format($penginapan->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-sm">
                  <span
                    class="px-2 py-1 rounded-md text-white {{ $penginapan->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $penginapan->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('penginapan.edit', $penginapan->id) }}"
                      class="text-blue-500 hover:text-blue-700">
                      <x-icons.edit />
                    </a>
                    <a href="{{ route('penginapan.show', $penginapan->id) }}"
                      class="text-green-500 hover:text-green-700">
                      <x-icons.show />
                    </a>
                    <form action="{{ route('penginapan.destroy', $penginapan->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-700">
                        <x-icons.delete />
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t">
        {{ $penginapans->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
