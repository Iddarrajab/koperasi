<x-app-layout title="Data Simpanan">

    <x-slot name="heading">
        Data Simpanan
    </x-slot>

    <x-slot name="body">
        <div class="p-8 space-y-2">

            {{-- Tombol Tambah --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('simpanan.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                    + Tambah Simpanan
                </a>
            </div>

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Anggota</x-table.th>
                        <x-table.th>Jenis Simpanan</x-table.th>
                        <x-table.th>Saldo Masuk</x-table.th>
                        <x-table.th>Total Saldo Anggota (per jenis)</x-table.th>
                    </tr>
                </x-table.thead>

                <x-table.tbody>
                    @forelse ($simpanan as $item)
                    <tr>
                        <x-table.td>
                            {{ $item->anggota->nama }}
                        </x-table.td>

                        <x-table.td>
                            {{ ucwords(str_replace('_', ' ', $item->jenis_simpanan)) }}
                        </x-table.td>

                        {{-- SALDO MASUK (transaksi ini saja) --}}
                        <x-table.td>
                            Rp {{ number_format($item->jumlah_setoran, 0, ',', '.') }}
                        </x-table.td>

                        {{-- TOTAL SALDO PER JENIS (hasil akumulasi saat itu) --}}
                        <x-table.td class="font-semibold text-green-700">
                            Rp {{ number_format($item->saldo, 0, ',', '.') }}
                        </x-table.td>
                    </tr>
                    @empty
                    <tr>
                        <x-table.td colspan="4" class="text-center text-gray-500">
                            Data simpanan belum tersedia
                        </x-table.td>
                    </tr>
                    @endforelse
                </x-table.tbody>
            </x-table>

        </div>

    </x-slot>

</x-app-layout>