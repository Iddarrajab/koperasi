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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white dark:bg-[#111822] p-8 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-bold">Tren Pertumbuhan</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Simpanan vs Pinjaman</p>
                        </div>
                        <div class="flex gap-2">
                            <div class="flex items-center gap-2 text-xs font-bold px-3 py-1.5 rounded-lg bg-slate-50 dark:bg-primary/5 text-slate-600 dark:text-slate-300">
                                <span class="w-2 h-2 rounded-full bg-primary"></span> Simpanan
                            </div>
                            <div class="flex items-center gap-2 text-xs font-bold px-3 py-1.5 rounded-lg bg-slate-50 dark:bg-primary/5 text-slate-600 dark:text-slate-300">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span> Pinjaman
                            </div>
                        </div>
                    </div>
                    <div class="h-64 flex flex-col justify-end gap-2 px-2">
                        <div class="flex items-end justify-around h-full w-full gap-4">
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 40%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 70%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">JAN</span>
                            </div>
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 55%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 60%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">FEB</span>
                            </div>
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 70%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 85%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">MAR</span>
                            </div>
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 60%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 75%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">APR</span>
                            </div>
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 80%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 90%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">MEI</span>
                            </div>
                            <div class="flex-1 flex flex-col justify-end gap-1">
                                <div class="w-full bg-primary/20 rounded-t-lg relative" style="height: 95%;">
                                    <div class="absolute bottom-0 w-full bg-primary rounded-t-lg" style="height: 80%;"></div>
                                </div>
                                <span class="text-[10px] text-center font-bold text-slate-400">JUN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-[#111822] p-8 rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm flex flex-col">
                    <h3 class="text-lg font-bold mb-6">Aksi Cepat</h3>
                    <div class="space-y-3 flex-1">
                        <button class="w-full p-4 flex items-center gap-4 rounded-xl border border-slate-100 dark:border-primary/10 hover:border-primary hover:bg-primary/5 transition-all text-left">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">person_add</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Tambah Anggota</p>
                                <p class="text-xs text-slate-500">Daftarkan anggota koperasi baru</p>
                            </div>
                        </button>
                        <button class="w-full p-4 flex items-center gap-4 rounded-xl border border-slate-100 dark:border-primary/10 hover:border-primary hover:bg-primary/5 transition-all text-left">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">request_quote</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Pengajuan Pinjaman</p>
                                <p class="text-xs text-slate-500">Proses pengajuan pinjaman baru</p>
                            </div>
                        </button>
                        <button class="w-full p-4 flex items-center gap-4 rounded-xl border border-slate-100 dark:border-primary/10 hover:border-primary hover:bg-primary/5 transition-all text-left">
                            <div class="w-10 h-10 bg-primary/10 text-primary rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold">Buat Laporan</p>
                                <p class="text-xs text-slate-500">Unduh ringkasan keuangan bulanan</p>
                            </div>
                        </button>
                    </div>
                    <div class="mt-6 pt-6 border-t border-slate-100 dark:border-primary/10">
                        <p class="text-xs text-slate-400 text-center italic">Siklus laporan berikutnya: 30 Juli 2024</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-[#111822] rounded-2xl border border-slate-200 dark:border-primary/10 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-primary/10 flex items-center justify-between">
                    <h3 class="text-lg font-bold">Transaksi Terbaru</h3>
                    <button class="text-sm font-bold text-primary hover:underline">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 dark:bg-primary/5 text-slate-500 dark:text-slate-400 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Nama Anggota</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Tipe</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-primary/10 text-sm">
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" data-alt="Male cooperative member profile photo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNt8WYjEi0H75ZrIUu3IDAUzkIHKg0NAg7Mqp-TvyAkm4W_4ewCYLDYCmUuzmONikbiZikS9ofA9f926KbaYveMZwStRGffxTdR5UjHGG5TRIAR7axqEuqy1H_VLHCKEO1ZvpwW2-O2Ovbx9AejVHssxCettqq-Tsx2dIOi7vfUa-MlLvzI27a_gr9XGuGQDXnhDFUF1oztLTIoVt0NuvxIeTePjz4HsPl2cpf1a5oA7f7QH-8li0crBIJlJBw5PO2X8LtNje0Er4" />
                                        <span class="font-bold">Budi Santoso</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">24 Okt 2023</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-500">Simpanan</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-emerald-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span class="text-xs font-medium">Selesai</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">Rp 2.500.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" data-alt="Female cooperative member profile photo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBEtP1RN5Lqw6pGWyvMfUlrI-KeLt5me1s6yOZbZOh5Ba3LPA25McpbK9I-vVuAYh85GhWwi4MBhvSPDjWXQQFqcgDMUO9jaYAm1VLhjFwrOco1ziLTXIT1ocmwciMa_LZXlHBsMh5xU0uM9jgxlarju0zshwr2d-4J8h8QYYmPpF3o0tn_YatAZFyVYIddXV4juluTMXNWJ-0d5lIgnBKX5AmK2855-PUazaCrNUSDXlBSzGwXCFgW91D_YF3AGn5GgO8_n2R0SRA" />
                                        <span class="font-bold">Siti Aminah</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">24 Okt 2023</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-indigo-500/10 text-indigo-500">Angsuran</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-emerald-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span class="text-xs font-medium">Selesai</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">Rp 1.200.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" data-alt="Male cooperative member profile photo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsL5zuW9rqKBoOwbOx4FWO5mka8uCWT92R3p5CPvF3dX_M4g-B2kLv7VdSMXT1iXT9sQsSHniu2mm354GNABzVjZ8t2lrwoDDiA5-GknZ4TkqrJ_QwZBL0aeKsohq-jwCP-aUc9AUkguW8Qo6jHRNr15Y03HM_FjF4a32ZoZ3CV8iMktnm8aEWX_H8rVB26H4vsgsIb0OvhQ9AGhzhzvHHg91QvVdHgpGNCHzIeig37gwNhgceaoCfPzc8cIDsoGvKz5NGn9eiRiU" />
                                        <span class="font-bold">Rizky Ramadhan</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">23 Okt 2023</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-rose-500/10 text-rose-500">Penarikan</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-amber-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span class="text-xs font-medium">Diproses</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">Rp 5.000.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" data-alt="Female cooperative member profile photo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQ9CtYM3jvudYWp4gxecV5ytzl1RvYBU5Rm48WS4kan_IYwIfYTzwooJ-outLYf-bHrll8SiuKpeu_Sf2GglLGlKPR8vczcsmA3XQKejHBq7z_onZ7ioQJQdB2HVLOW6SBm9ZJaqX4--V_ichTyqY1P2nkMYfmqmYmBhasCRginZZdZ9SrrcJAnpVYe00yVbjo4mJDcSiPRShyOAP4wDexRx6NuArfjxFhhKL4xSH8dHpivXxQxsSLlILTPWEmFvX9rMXG97xrbdU" />
                                        <span class="font-bold">Dewi Lestari</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">23 Okt 2023</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-500/10 text-emerald-500">Simpanan</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-emerald-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span class="text-xs font-medium">Selesai</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">Rp 850.000</td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-primary/5 transition-colors border-none">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-8 h-8 rounded-full object-cover" data-alt="Male cooperative member profile photo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsWKehbh0mQTFc6wsADu_DQCTeTFvXT0zWBopQka9229aXPLN2W72Ce6yTYfHKxKRLCVcYPWxQ-2A8buCtjOQASPTiJ8yfzbOhIDFf_5fR8mBCy8E-dEQ7gkxahwsSR9X2q4OzbAGkOSjXnULP9AYc7eo6CRzduyHOqvlQyk1aaG3_scfOMcEOBeep4d7PgQmVXevMqTkRNMYFnsXquHLNjqwEbhXBU5rle4ICJnQy2uy_LGVNeue40CTMK94gXYPcLelaeei6N18" />
                                        <span class="font-bold">Ahmad Fauzi</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">22 Okt 2023</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-indigo-500/10 text-indigo-500">Angsuran</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1.5 text-rose-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span class="text-xs font-medium">Ditolak</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right font-bold">Rp 2.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="px-8 py-6 text-center">
            <p class="text-xs text-slate-500">© 2024 Sistem Manajemen Koperasi Simpan Pinjam. Hak Cipta Dilindungi.</p>
        </footer>
        </main>
    </x-slot>
</x-app-layout>