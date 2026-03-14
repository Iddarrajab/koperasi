<x-app-layout title="Data Anggota">

    <x-slot name="heading">
        Data Anggota
    </x-slot>

    <x-slot name="body">
        <div class="p-8 space-y-2">
            <h1>hallo</h1>


            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Kode</x-table.th>
                        <x-table.th>Nama</x-table.th>
                        <x-table.th>No HP</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th class="text-center">Aksi</x-table.th>
                    </tr>
                </x-table.thead>

                <x-table.tbody>
                    @forelse ($anggota as $item)
                    <tr>
                        <x-table.td>{{ $item->kode_anggota }}</x-table.td>
                        <x-table.td>{{ $item->nama }}</x-table.td>
                        <x-table.td>{{ $item->no_hp }}</x-table.td>

                        {{-- Status Anggota --}}
                        <x-table.td>
                            @if ($item->status_anggota === 'aktif')
                            <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                            <span class="text-red-600 font-semibold">Nonaktif</span>
                            @endif
                        </x-table.td>

                        {{-- Aksi --}}
                        <x-table.td class="text-center">
                            <div class="flex justify-center gap-3">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('anggota.edit', ['anggotum' => $item->id]) }}"
                                    class="text-yellow-600 hover:underline">
                                    Edit
                                </a>

                                {{-- Tombol Validasi --}}
                                @auth('admin')
                                @if ($item->status_anggota !== 'aktif')
                                <form action="{{ route('anggota.validasi', ['anggota' => $item->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Validasi anggota ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                        Validasi
                                    </button>
                                </form>
                                @endif
                                @endauth

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('anggota.destroy', ['anggotum' => $item->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </x-table.td>
                    </tr>
                    @empty
                    <tr>
                        <x-table.td colspan="5" class="text-center text-gray-500">
                            Belum ada anggota
                        </x-table.td>
                    </tr>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
    </x-slot>

</x-app-layout>