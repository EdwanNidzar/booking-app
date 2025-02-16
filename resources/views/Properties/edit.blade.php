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

          <!-- Pilih Jenis -->
          <div class="mb-4">
            <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
            <select id="jenis" name="jenis" class="w-full border rounded p-2">
              <option value="penginapan" {{ $propertie->penginapan_id ? 'selected' : '' }}>Penginapan</option>
              <option value="aula" {{ $propertie->aula_id ? 'selected' : '' }}>Aula</option>
            </select>
          </div>

          <!-- Pilih Penginapan -->
          <div class="mt-4" id="penginapan_field">
            <x-input-label for="penginapan_id" :value="__('Nama Penginapan')" />
            <select name="penginapan_id" id="penginapan_id" class="block w-full border-gray-300 rounded-md shadow-sm">
              <option value="" selected disabled>Pilih Penginapan</option>
              @foreach ($penginapans as $penginapan)
                <option value="{{ $penginapan->id }}"
                  {{ $propertie->penginapan_id == $penginapan->id ? 'selected' : '' }}>
                  {{ $penginapan->nama_penginapan }}</option>
              @endforeach
            </select>
          </div>

          <!-- Pilih Aula -->
          <div class="mt-4" id="aula_field">
            <x-input-label for="aula_id" :value="__('Nama Aula')" />
            <select name="aula_id" id="aula_id" class="block w-full border-gray-300 rounded-md shadow-sm">
              <option value="" selected disabled>Pilih Aula</option>
              @foreach ($aulas as $aula)
                <option value="{{ $aula->id }}" {{ $propertie->aula_id == $aula->id ? 'selected' : '' }}>
                  {{ $aula->nama_aula }}</option>
              @endforeach
            </select>
          </div>

          <!-- Tipe Properti -->
          <div class="mt-4" id="type_field">
            <label for="type" class="block text-sm font-medium text-gray-700">Tipe Properti</label>
            <select name="type" id="type" class="block w-full border-gray-300 rounded-md">
              <option value="" selected disabled>Pilih Tipe Properti</option>
              <option value="kamar" {{ $propertie->type == 'kamar' ? 'selected' : '' }}>Kamar</option>
              <option value="villa" {{ $propertie->type == 'villa' ? 'selected' : '' }}>Villa</option>
              <option value="apartemen" {{ $propertie->type == 'apartemen' ? 'selected' : '' }}>Apartemen</option>
            </select>
          </div>

          <!-- Jumlah Tempat Tidur -->
          <div class="mt-4" id="beds_field">
            <label for="beds" class="block text-sm font-medium text-gray-700">Jumlah Tempat Tidur</label>
            <input type="number" id="beds" name="beds"
              class="block w-full border-gray-300 rounded-md shadow-sm" value="{{ $propertie->beds }}">
          </div>

          <!-- Jumlah Kamar Mandi -->
          <div class="mt-4" id="bathrooms_field">
            <label for="bathrooms" class="block text-sm font-medium text-gray-700">Jumlah Kamar Mandi</label>
            <input type="number" id="bathrooms" name="bathrooms"
              class="block w-full border-gray-300 rounded-md shadow-sm" value="{{ $propertie->bathrooms }}">
          </div>

          <!-- Fasilitas -->
          <div class="mt-4">
            <label for="facilities" class="block text-sm font-medium text-gray-700">Fasilitas</label>
            <textarea id="facilities" name="facilities" class="block w-full border-gray-300 rounded-md shadow-sm">{{ $propertie->facilities }}</textarea>
          </div>

          <!-- Kapasitas Maksimal -->
          <div class="mt-4">
            <label for="max_guest" class="block text-sm font-medium text-gray-700">Kapasitas Maksimal</label>
            <input type="number" id="max_guest" name="max_guest"
              class="block w-full border-gray-300 rounded-md shadow-sm" value="{{ $propertie->max_guest }}">
          </div>

          <!-- Submit Button -->
          <div class="mt-4">
            <button type="submit" class="float-right bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
              Perbarui Properti
            </button>
            <a href="{{ route('properties.index') }}"
              class="float-right px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
              Kembali
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let jenisSelect = document.getElementById('jenis');
      let penginapanField = document.getElementById('penginapan_field');
      let aulaField = document.getElementById('aula_field');
      let typeField = document.getElementById('type_field');
      let bedsField = document.getElementById('beds_field');
      let bathroomsField = document.getElementById('bathrooms_field');

      function toggleFields() {
        let jenis = jenisSelect.value;
        if (jenis === 'penginapan') {
          penginapanField.style.display = 'block';
          aulaField.style.display = 'none';
          typeField.style.display = 'block';
          bedsField.style.display = 'block';
          bathroomsField.style.display = 'block';
        } else if (jenis === 'aula') {
          penginapanField.style.display = 'none';
          aulaField.style.display = 'block';
          typeField.style.display = 'none';
          bedsField.style.display = 'none';
          bathroomsField.style.display = 'none';
        }
      }

      jenisSelect.addEventListener('change', toggleFields);
      toggleFields();
    });
  </script>
</x-app-layout>
