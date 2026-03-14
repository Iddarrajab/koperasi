<x-app-layout title="Data Angsuran">

    <x-slot name="heading">
        Data Angsuran
    </x-slot>

    <x-slot name="body">

        <div class="flex justify-end mb-4">
            <a href="{{ route('angsuran.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                + Tambah Angsuran
            </a>
        </div>

        <x-table class="mt-8">
            <x-table.thead>
                <tr>
                    <x-table.th>Anggota</x-table.th>
                    <x-table.th>Pinjaman</x-table.th>
                    <x-table.th>Jumlah Bayar</x-table.th>
                    <x-table.th>Sisa</x-table.th>
                    <x-table.th>Aksi</x-table.th>
                </tr>
            </x-table.thead>

            <x-table.tbody>
                @forelse ($angsuran as $item)
                <tr>
                    <x-table.td>{{ $item->pinjaman->anggota->nama }}</x-table.td>
                    <x-table.td>#{{ $item->pinjaman->id }}</x-table.td>
                    <x-table.td>Rp {{ number_format($item->jumlah_angsuran, 0, ',', '.') }}</x-table.td>
                    <x-table.td>Rp {{ number_format($item->sisa_pinjaman, 0, ',', '.') }}</x-table.td>
                    <x-table.td class="flex gap-2">
                        {{-- Tombol Edit --}}
                        <a href="{{ route('angsuran.edit', $item->id) }}"
                            class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('angsuran.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Apakah anda yakin ingin menghapus angsuran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </x-table.td>
                </tr>
                @empty
                <tr>
                    <x-table.td colspan="5" class="text-center text-gray-500">
                        Data angsuran belum tersedia
                    </x-table.td>
                </tr>
                @endforelse
            </x-table.tbody>
        </x-table>

    </x-slot>

</x-app-layout>