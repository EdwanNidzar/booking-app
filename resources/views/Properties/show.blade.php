<x-app-layout>
  <x-slot name="header">
    {{ __('Detail Properti') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Detail Properti</h1>

    <div class="mt-4">
      <p><strong>Jenis:</strong> {{ ucfirst($propertie->jenis) }}</p>

      @if ($propertie->jenis === 'penginapan' && $propertie->penginapan)
        <p><strong>Nama Penginapan:</strong> {{ $propertie->penginapan->nama_penginapan }}</p>
        <p><strong>Tipe:</strong> {{ $propertie->type }}</p>
        <p><strong>Tempat Tidur:</strong> {{ $propertie->beds }}</p>
        <p><strong>Kamar Mandi:</strong> {{ $propertie->bathrooms }}</p>
      @elseif ($propertie->jenis === 'aula' && $propertie->aula)
        <p><strong>Nama Aula:</strong> {{ $propertie->aula->nama_aula }}</p>
      @endif

      <p><strong>Fasilitas:</strong> {{ $propertie->facilities }}</p>
      <p><strong>Maksimal Tamu:</strong> {{ $propertie->max_guest }}</p>
    </div>

    <div class="mt-6">
      <a href="{{ route('properties.index') }}"
        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
    </div>
  </div>
</x-app-layout>
