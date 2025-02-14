<x-app-layout>
  <x-slot name="header">
    {{ __('Detail Penginapan') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Detail Penginapan</h1>

    <div class="mt-4">
      <p><strong>Nama:</strong> {{ $penginapan->nama_penginapan }}</p>
      <p><strong>Lokasi:</strong> {{ $penginapan->location }}</p>
      <p><strong>Harga per Malam:</strong> Rp{{ number_format($penginapan->price, 0, ',', '.') }}</p>
      <p><strong>Status:</strong>
        <span
          class="px-2 py-1 rounded-md text-white {{ $penginapan->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
          {{ $penginapan->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
        </span>
      </p>

      @if ($penginapan->photo)
        <div class="mt-4">
          <img src="{{ asset('storage/' . $penginapan->photo) }}" alt="Foto Penginapan" class="w-64 rounded-lg shadow-md">
        </div>
      @endif
    </div>

    <div class="mt-6">
      <a href="{{ route('penginapan.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
    </div>
  </div>
</x-app-layout>
