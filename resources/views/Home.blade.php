<x-app-layout name="dashboard">
    <x-slot name="body">

        <header class="sticky top-0 z-10 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-primary/10 px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4 flex-1 max-w-xl">
                <div class="relative w-full">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-slate-100 dark:bg-primary/5 border-none rounded-xl focus:ring-2 focus:ring-primary/50 text-sm transition-all outline-none" placeholder="Cari transaksi, anggota, atau pinjaman..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-3 ml-6">
                <button class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-slate-100 dark:hover:bg-primary/10 text-slate-500 transition-colors relative">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-background-dark"></span>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-slate-100 dark:hover:bg-primary/10 text-slate-500 transition-colors">
                    <span class="material-symbols-outlined">calendar_today</span>
                </button>
                @auth('admin')
                <div class="h-6 w-[1px] bg-slate-200 dark:bg-primary/20 mx-2"></div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-red-600 rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
                @endauth

                {{-- ============================= --}}
                {{-- Anggota Links --}}
                {{-- ============================= --}}
                @auth('anggota')
                <a href="{{ route('home') }}" class="px-3 py-2 bg-gray-800 rounded">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-red-600 rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
                @endauth

                {{-- ============================= --}}
                {{-- Guest Links --}}
                {{-- ============================= --}}
                @guest('admin')
                @guest('anggota')
                <a href="{{ route('login.form') }}" class="px-3 py-2 bg-primary-600 rounded hover:bg-green-700">Login</a>
                @endguest
                @endguest
            </div>
        </header>
        <div class="p-8 space-y-8">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight">Ikhtisar Dashboard</h2>
                <p class="text-slate-500 dark:text-slate-400">Selamat datang kembali, Adrian. Berikut perkembangan hari ini.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-[#111822] p-6 rounded-2xl border border-slate-200 dark:border-primary/10 group hover:border-primary/40 transition-all shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined">account_balance_wallet</span>
                        </div>
                        <span class="text-emerald-500 text-xs font-bold bg-emerald-500/10 px-2 py-1 rounded-full">+12.5%</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Simpanan</p>
                    <h3 class="text-2xl font-bold mt-1">R p 500.000.000</h3>
                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">history</span>
                        vs bulan lalu
                    </p>
                </div>
                <div class="bg-white dark:bg-[#111822] p-6 rounded-2xl border border-slate-200 dark:border-primary/10 group hover:border-primary/40 transition-all shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined">credit_score</span>
                        </div>
                        <span class="text-emerald-500 text-xs font-bold bg-emerald-500/10 px-2 py-1 rounded-full">+5.2%</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Pinjaman Beredar</p>
                    <h3 class="text-2xl font-bold mt-1">Rp 325.000.000</h3>
                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">history</span>
                        vs bulan lalu
                    </p>
                </div>
                <div class="bg-white dark:bg-[#111822] p-6 rounded-2xl border border-slate-200 dark:border-primary/10 group hover:border-primary/40 transition-all shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-indigo-500/10 text-indigo-500 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined">person_add</span>
                        </div>
                        <span class="text-emerald-500 text-xs font-bold bg-emerald-500/10 px-2 py-1 rounded-full">+2.1%</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Anggota Aktif</p>
                    <h3 class="text-2xl font-bold mt-1">1,240</h3>
                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">trending_up</span>
                        Meningkat minggu ini
                    </p>
                </div>
                <div class="bg-white dark:bg-[#111822] p-6 rounded-2xl border border-slate-200 dark:border-primary/10 group hover:border-primary/40 transition-all shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined">pending_actions</span>
                        </div>
                        <span class="text-rose-500 text-xs font-bold bg-rose-500/10 px-2 py-1 rounded-full">Penting</span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Menunggu Persetujuan</p>
                    <h3 class="text-2xl font-bold mt-1">12</h3>
                    <p class="text-xs text-slate-400 mt-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">timer</span>
                        Butuh tindakan segera
                    </p>
                </div>
            </div>
        </div>
        <footer class="px-8 py-6 text-center">
            <p class="text-xs text-slate-500">© 2024 Sistem Manajemen Koperasi Simpan Pinjam. Hak Cipta Dilindungi.</p>
        </footer>
        </main>
    </x-slot>
</x-app-layout>