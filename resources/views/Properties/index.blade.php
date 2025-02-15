<x-app-layout>
  <x-slot name="header">
    {{ __('Properti') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Properti</h1>
    <x-alert-notification />

    <div class="mt-4 mb-4 float-right">
      <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        Tambah Properti
      </a>
      <a href="#" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600" target="_blank">
        Export PDF
      </a>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
              <th class="px-4 py-3">Nama Penginapan</th>
              <th class="px-4 py-3">Tipe</th>
              <th class="px-4 py-3">Tempat Tidur</th>
              <th class="px-4 py-3">Kamar Mandi</th>
              <th class="px-4 py-3">Fasilitas</th>
              <th class="px-4 py-3">Maksimal Tamu</th>
              <th class="px-4 py-3">Action</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y">
            @foreach ($properties as $property)
              <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $property->penginapan->nama_penginapan }}</td>
                <td class="px-4 py-3 text-sm">{{ $property->type }}</td>
                <td class="px-4 py-3 text-sm">{{ $property->beds }}</td>
                <td class="px-4 py-3 text-sm">{{ $property->bathrooms }}</td>
                <td class="px-4 py-3 text-sm">{{ $property->facilities }}</td>
                <td class="px-4 py-3 text-sm">{{ $property->max_guest }}</td>
                <td class="px-4 py-3 text-sm text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="{{ route('properties.edit', $property->id) }}" class="text-blue-500 hover:text-blue-700">
                      <x-icons.edit />
                    </a>
                    <a href="{{ route('properties.show', $property->id) }}" class="text-green-500 hover:text-green-700">
                      <x-icons.show />
                    </a>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
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
        {{ $properties->links() }}
      </div>
    </div>
  </div>
</x-app-layout>
