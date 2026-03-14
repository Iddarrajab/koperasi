<x-app-layout title="Form Simpanan">

    <x-slot name="heading">
        {{ $page_meta['title'] }}
    </x-slot>

    <x-slot name="body">

        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

            <form action="{{ $page_meta['url'] }}" method="POST" class="space-y-5">
                @csrf
                @method($page_meta['method'])

                {{-- Anggota --}}
                <div>
                    <label class="block mb-1 font-medium">Anggota</label>
                    <select
                        name="anggota_id"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggota as $a)
                        <option value="{{ $a->id }}"
                            @selected(old('anggota_id', $simpanan->anggota_id ?? '') == $a->id)>
                            {{ $a->nama }}
                        </option>
                        @endforeach
                    </select>

                    @error('anggota_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis Simpanan --}}
                <div>
                    <label class="block mb-1 font-medium">Jenis Simpanan</label>
                    <select
                        name="jenis_simpanan"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="simpanan_pokok"
                            @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '')=='simpanan_pokok')>
                            Simpanan Pokok
                        </option>
                        <option value="simpanan_wajib"
                            @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '')=='simpanan_wajib')>
                            Simpanan Wajib
                        </option>
                        <option value="simpanan_sukarela"
                            @selected(old('jenis_simpanan', $simpanan->jenis_simpanan ?? '')=='simpanan_sukarela')>
                            Simpanan Sukarela
                        </option>
                    </select>

                    @error('jenis_simpanan')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Setoran --}}
                <div>
                    <label class="block mb-1 font-medium">Jumlah Setoran</label>
                    <input
                        type="number"
                        name="jumlah_setoran"
                        value="{{ old('jumlah_setoran', $simpanan->jumlah_setoran ?? '') }}"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Masukkan jumlah setoran"
                        required>

                    @error('jumlah_setoran')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('simpanan.index') }}"
                        class="px-4 py-2 rounded border hover:bg-gray-100">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ $page_meta['button'] }}
                    </button>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>