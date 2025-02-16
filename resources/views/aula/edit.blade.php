<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Aula') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Aula</h1>

        <div class="overflow-hidden mb-8 w-full rounded-lg shadow-xs">
            <div class="overflow-x-auto w-full">
                <form action="{{ route('aula.update', $aula->id) }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Aula -->
                    <div class="mt-4">
                        <x-input-label for="nama_aula" :value="__('Nama Aula')" />
                        <x-text-input type="text" id="nama_aula" name="nama_aula" class="block w-full"
                            value="{{ old('nama_aula', $aula->nama_aula) }}" required />
                        <x-input-error :messages="$errors->get('nama_aula')" class="mt-2" />
                    </div>

                    <!-- Lokasi -->
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Lokasi')" />
                        <x-text-input type="text" id="location" name="location" class="block w-full"
                            value="{{ old('location', $aula->location) }}" required />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Photo -->
                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Photo')" />
                        <x-text-input type="file" id="photo" name="photo" class="block w-full"
                            value="{{ old('photo') }}" />
                        <x-input-label for="photo" :value="__('Photo Sekarang:')" />
                        @if ($aula->photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $aula->photo) }}" alt="Current Photo"
                                    class="w-32 h-32 object-cover">
                            </div>
                        @endif
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <!-- Harga per Jam -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Harga per Jam')" />
                        <x-text-input type="number" id="price" name="price" class="block w-full"
                            value="{{ old('price', $aula->price) }}" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <select name="status" id="status"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
                            required>
                            <option value="active" {{ old('status', $aula->status) == 'active' ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="inactive" {{ old('status', $aula->status) == 'inactive' ? 'selected' : '' }}>Tidak
                                Tersedia</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <x-primary-button class="float-right">
                            {{ __('Update Aula') }}
                        </x-primary-button>
                        <a href="{{ route('aula.index') }}"
                            class="float-right px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Back</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
