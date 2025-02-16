<x-app-layout>
  <x-slot name="header">
    {{ __('Aula') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Aula</h1>
    <x-alert-notification />

    <div class="mt-4 mb-4 float-right">
      <a href="{{ route('aula.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah
        Aula</a>
      <a href="#" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600" target="_blank">Export
        PDF</a>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
              <th class="px-4 py-3">Pemilik</th>
              <th class="px-4 py-3">Nama Aula</th>
              <th class="px-4 py-3">Lokasi Aula</th>
              <th class="px-4 py-3">Photo</th>
              <th class="px-4 py-3">Harga</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @foreach ($aulas as $aula)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $aula->host->name }}</td>
                <td class="px-4 py-3 text-sm">{{ $aula->nama_aula }}</td>
                <td class="px-4 py-3 text-sm">{{ $aula->location }}</td>
                <td class="px-4 py-3 text-sm text-center">
                  <img src="{{ asset('storage/' . $aula->photo) }}" alt="{{ $aula->nama_aula }}"
                    class="w-16 h-16 rounded">
                </td>
                <td class="px-4 py-3 text-sm">Rp{{ number_format($aula->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-sm">
                  <span
                    class="px-2 py-1 rounded-md text-white {{ $aula->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $aula->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('aula.edit', $aula->id) }}" class="text-blue-500 hover:text-blue-700">
                      <x-icons.edit />
                    </a>
                    <a href="{{ route('aula.show', $aula->id) }}" class="text-green-500 hover:text-green-700">
                      <x-icons.show />
                    </a>
                    <form action="{{ route('aula.destroy', $aula->id) }}" method="POST"
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
        {{ $aulas->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
