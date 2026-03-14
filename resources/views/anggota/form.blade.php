<x-app-layout title="Form Anggota">

    <x-slot name="heading">
        {{ $page_meta['title'] }}
    </x-slot>

    <x-slot name="body">
        <div class="p-8 space-y-2">
            <form action="{{ $page_meta['url'] }}" method="POST" class="space-y-6">
                @csrf
                @method($page_meta['method'])

                {{-- Nama Anggota --}}
                <div>
                    <label for="nama" class="block font-medium mb-1">Nama Anggota</label>
                    <input type="text" id="nama" name="nama"
                        value="{{ old('nama', $anggota->nama ?? '') }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('nama')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $anggota->email ?? '') }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full border rounded px-3 py-2"
                        autocomplete="off"
                        placeholder="{{ $page_meta['method'] === 'PUT' ? 'Kosongkan jika tidak ingin diubah' : 'Masukkan password' }}"
                        {{ $page_meta['method'] === 'POST' ? 'required' : '' }}>
                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block font-medium mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat"
                        value="{{ old('alamat', $anggota->alamat ?? '') }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('alamat')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No HP --}}
                <div>
                    <label for="no_hp" class="block font-medium mb-1">No HP</label>
                    <input type="text" id="no_hp" name="no_hp"
                        value="{{ old('no_hp', $anggota->no_hp ?? '') }}"
                        class="w-full border rounded px-3 py-2"
                        required>
                    @error('no_hp')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status Anggota --}}
                @if(auth()->guard('admin')->check())
                <div>
                    <label for="status_anggota" class="block font-medium mb-1">Status Anggota</label>
                    <select id="status_anggota" name="status_anggota"
                        class="w-full border rounded px-3 py-2">
                        <option value="aktif" @selected(old('status_anggota', $anggota->status_anggota ?? '') == 'aktif')>Aktif</option>
                        <option value="nonaktif" @selected(old('status_anggota', $anggota->status_anggota ?? '') == 'nonaktif')>Nonaktif</option>
                    </select>
                    @error('status_anggota')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @else
                {{-- User biasa tidak bisa ubah, default nonaktif --}}
                <input type="hidden" name="status_anggota" value="{{ $anggota->status_anggota ?? 'nonaktif' }}">
                @endif

                {{-- Submit Button --}}
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        {{ $page_meta['button'] }}
                    </button>
                </div>

            </form>
        </div>
    </x-slot>

</x-app-layout>