<x-app-layout>
  <x-slot name="header">
    {{ __('Edit Properti') }}
  </x-slot>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <h1 class="text-2xl font-semibold text-gray-800">Edit Properti</h1>

    <div class="overflow-hidden mb-8 w-full rounded-lg shadow-xs">
      <div class="overflow-x-auto w-full">
        <form action="{{ route('properties.update', $propertie->id) }}" method="POST" autocomplete="off">
          @csrf
          @method('PUT')

          <!-- Nama Properti -->
          <div class="mt-4">
            <x-input-label for="penginapan_id" :value="__('Nama Penginapan')" />
            <select name="penginapan_id" id="penginapan_id"
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
              required>
              <option value="" selected disabled>Pilih Penginapan</option>
              @foreach ($penginapans as $penginapan)
                <option value="{{ $penginapan->id }}"
                  {{ $propertie->penginapan_id == $penginapan->id ? 'selected' : '' }}>
                  {{ $penginapan->nama_penginapan }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Tipe -->
          <div class="mt-4">
            <x-input-label for="type" :value="__('Type')" />
            <select name="type" id="type"
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
              required>
              <option value="" selected disabled>Pilih Tipe Properti</option>
              <option value="kamar" {{ $propertie->type == 'kamar' ? 'selected' : '' }}>Kamar</option>
              <option value="villa" {{ $propertie->type == 'villa' ? 'selected' : '' }}>Villa</option>
              <option value="apartemen" {{ $propertie->type == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
            </select>
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
          </div>

          <!-- Jumlah Tempat Tidur -->
          <div class="mt-4">
            <x-input-label for="beds" :value="__('Jumlah Tempat Tidur')" />
            <x-text-input type="number" id="beds" name="beds" class="block w-full"
              value="{{ $propertie->beds }}" required />
            <x-input-error :messages="$errors->get('beds')" class="mt-2" />
          </div>

          <!-- Jumlah Kamar Mandi -->
          <div class="mt-4">
            <x-input-label for="bathrooms" :value="__('Jumlah Kamar Mandi')" />
            <x-text-input type="number" id="bathrooms" name="bathrooms" class="block w-full"
              value="{{ $propertie->bathrooms }}" required />
            <x-input-error :messages="$errors->get('bathrooms')" class="mt-2" />
          </div>

          <!-- Fasilitas -->
          <div class="mt-4">
            <x-input-label for="facilities" :value="__('Fasilitas')" />
            <textarea id="facilities" name="facilities"
              class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
              required>{{ $propertie->facilities }}</textarea>
            <x-input-error :messages="$errors->get('facilities')" class="mt-2" />
          </div>

          <!-- Kapasitas Maksimal -->
          <div class="mt-4">
            <x-input-label for="max_guest" :value="__('Kapasitas Maksimal')" />
            <x-text-input type="number" id="max_guest" name="max_guest" class="block w-full"
              value="{{ $propertie->max_guest }}" required />
            <x-input-error :messages="$errors->get('max_guest')" class="mt-2" />
          </div>

          <!-- Submit Button -->
          <div class="mt-4">
            <x-primary-button class="float-right">
              {{ __('Update Properti') }}
            </x-primary-button>
            <a href="{{ route('properties.index') }}"
              class="float-right px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>
