<x-app-layout title="Form Pinjaman">

    <x-slot name="heading">
        {{ $page_meta['title'] }}
    </x-slot>

    <x-slot name="body">
        <div class="p-8 space-y-2">
            <form action="{{ $page_meta['url'] }}" method="POST" class="space-y-6">
                @csrf
                @method($page_meta['method'])

                {{-- Anggota --}}
                <div>
                    <label class="block font-medium mb-1" for="anggota_id">Anggota</label>
                    <select id="anggota_id" name="anggota_id" class="w-full border rounded px-3 py-2" required>
                        @foreach($anggota as $a)
                        <option value="{{ $a->id }}" @selected(old('anggota_id', $pinjaman->anggota_id) == $a->id)>
                            {{ $a->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('anggota_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Pinjaman --}}
                <div>
                    <label class="block font-medium mb-1" for="jumlah_pinjaman">Jumlah Pinjaman</label>
                    <input type="number" id="jumlah_pinjaman" name="jumlah_pinjaman"
                        value="{{ old('jumlah_pinjaman', $pinjaman->jumlah_pinjaman) }}"
                        class="w-full border rounded px-3 py-2"
                        required />
                    @error('jumlah_pinjaman')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tenor --}}
                <div>
                    <label class="block font-medium mb-1" for="tenor">Tenor (bulan)</label>
                    <input type="number" id="tenor" name="tenor"
                        value="{{ old('tenor', $pinjaman->tenor) }}"
                        class="w-full border rounded px-3 py-2"
                        required />
                    @error('tenor')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bunga --}}
                <div>
                    <label class="block font-medium mb-1" for="bunga">Bunga (%)</label>
                    <input type="number" id="bunga" name="bunga"
                        value="{{ old('bunga', $pinjaman->bunga) }}"
                        class="w-full border rounded px-3 py-2"
                        required />
                    @error('bunga')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Pinjaman --}}
                <div>
                    <label class="block font-medium mb-1" for="status_pinjaman">Status Pinjaman</label>
                    <select id="status_pinjaman" name="status_pinjaman" class="w-full border rounded px-3 py-2">
                        <option value="aktif" @selected(old('status_pinjaman', $pinjaman->status_pinjaman)=='aktif')>Aktif</option>
                        <option value="lunas" @selected(old('status_pinjaman', $pinjaman->status_pinjaman)=='lunas')>Lunas</option>
                    </select>
                    @error('status_pinjaman')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        {{ $page_meta['button'] }}
                    </button>
                </div>

            </form>
        </div>
    </x-slot>

</x-app-layout>