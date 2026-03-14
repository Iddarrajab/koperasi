<x-app-layout title="Form Angsuran">

    <x-slot name="heading">
        {{ $page_meta['title'] }}
    </x-slot>

    <x-slot name="body">
        <form action="{{ $page_meta['url'] }}" method="POST" class="space-y-6">
            @csrf
            @method($page_meta['method'])

            {{-- Pilih Pinjaman --}}
            <div>
                <label for="pinjaman_id" class="block font-medium mb-1">Pinjaman</label>
                <select id="pinjaman_id" name="pinjaman_id"
                    class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Pinjaman --</option>
                    @foreach($pinjaman as $p)
                    <option value="{{ $p->id }}"
                        @selected(old('pinjaman_id', $angsuran->pinjaman_id) == $p->id)>
                        {{ $p->anggota->nama }} - Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
                @error('pinjaman_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah Angsuran --}}
            <div>
                <label for="jumlah_angsuran" class="block font-medium mb-1">Jumlah Angsuran</label>
                <input id="jumlah_angsuran" name="jumlah_angsuran" type="number"
                    value="{{ old('jumlah_angsuran', $angsuran->jumlah_angsuran) }}"
                    class="w-full border rounded px-3 py-2"
                    placeholder="Masukkan jumlah angsuran"
                    required>
                @error('jumlah_angsuran')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    {{ $page_meta['button'] }}
                </button>
            </div>

        </form>
    </x-slot>

</x-app-layout>