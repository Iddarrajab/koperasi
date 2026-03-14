<x-app-layout title="Data Admin">

    <x-slot name="heading">
        Data Admin
    </x-slot>

    <x-slot name="body">

        <header class="sticky top-0 z-10 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-primary/10 px-8 py-4 flex items-center justify-between">
            <div class="flex flex-col">
                <h2 class="text-2xl font-extrabold tracking-tight">Manajemen Anggota</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Kelola dan pantau data anggota koperasi.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-lg">person_add</span>
                    Tambah Anggota
                </button>
            </div>
        </header>



        <x-table class="mt-8">
            <x-table.thead>
                <tr>
                    <x-table.th>Nama</x-table.th>
                    <x-table.th>Username</x-table.th>
                    <x-table.th>Dibuat</x-table.th>
                </tr>
            </x-table.thead>

            <x-table.tbody>
                @foreach ($admin as $item)
                <tr>
                    <x-table.td>{{ $item->name }}</x-table.td>
                    <x-table.td>{{ $item->email ?? '-' }}</x-table.td>
                    <x-table.td>{{ $item->created_at->format('d-m-Y') }}</x-table.td>
                </tr>
                @endforeach
            </x-table.tbody>
        </x-table>
    </x-slot>

</x-app-layout>