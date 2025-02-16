<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Aula') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Aula</h1>

        <div class="mt-4">
            <p><strong>Nama:</strong> {{ $aula->nama_aula }}</p>
            <p><strong>Lokasi:</strong> {{ $aula->location }}</p>
            <p><strong>Harga per Jam:</strong> Rp{{ number_format($aula->price, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                <span
                    class="px-2 py-1 rounded-md text-white {{ $aula->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $aula->status == 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                </span>
            </p>

            @if ($aula->photo)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $aula->photo) }}" alt="Foto Aula" class="w-64 rounded-lg shadow-md">
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('aula.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
        </div>
    </div>
</x-app-layout>
