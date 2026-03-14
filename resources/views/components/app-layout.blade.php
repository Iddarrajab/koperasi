<!DOCTYPE html>
<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Ikhtisar Dashboard Simpan Pinjam</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#136dec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101822",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <button id="btnSidebar"
        class="md:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-primary/10">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .sidebar-item-active {
            background-color: #136dec;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased font-display">

    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-40 w-64 bg-white dark:bg-[#111822] border-r border-slate-200 dark:border-primary/20 flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300">
            <div class="p-6 flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">account_balance</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-none">Simpan Pinjam</h1>
                    <p class="text-xs text-slate-500 dark:text-primary/60 font-medium">Admin Koperasi</p>
                </div>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto custom-scrollbar">
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white font-medium" href="{{ route('home') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                @auth('admin')
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('anggota.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span>Anggota</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('simpanan.index') }}">
                    <span class="material-symbols-outlined">savings</span>
                    <span>Simpanan</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('pinjaman.index') }}">
                    <span class="material-symbols-outlined">payments</span>
                    <span>Pinjaman</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="{{ route('angsuran.index') }}">
                    <span class="material-symbols-outlined">event_repeat</span>
                    <span>Angsuran</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="#">
                    <span class="material-symbols-outlined">bar_chart</span>
                    <span>Laporan</span>
                </a>
                <div class="pt-6 pb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Sistem</div>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span>Pengaturan</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-primary/10 hover:text-primary transition-colors" href="#">
                    <span class="material-symbols-outlined">help</span>
                    <span>Dukungan</span>
                </a>
                @endauth
            </nav>
            <div class="p-4 border-t border-slate-200 dark:border-primary/20">
                <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-50 dark:bg-primary/5">
                    <img class="w-10 h-10 rounded-full border-2 border-primary/20 object-cover" data-alt="Admin user profile picture avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOKc_B9NN6PcicTQpc__WV-BVl-RhfIQ5eng96AjW55W_vtMbvHOXanO3xyKL5yfgNhEyvhrIpBNqJU8GQuYp_3e5LkakUlOegAqeSrZIELgDb7WIXLn3jvj9OOZ88iB_70ZKxwEDps70RQULcDeVFQlX6sRaKrIacsXmCfZEMx3ThRr9P7N9M30405AbLwMPkMb4QbZj--SGC1ETqDgzDZTO3A7rNPscY-0K-NlUwsV54ATMMnEePXc68r1h6B_FrztPCPamUajw" />
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold truncate">Adrian Pratama</p>
                        <p class="text-xs text-slate-500 truncate">Administrator Utama</p>
                    </div>
                    <button class="text-slate-400 hover:text-primary">
                        <span class="material-symbols-outlined text-xl">logout</span>
                    </button>
                </div>
            </div>
        </aside>
        <div id="overlay" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden">
            <script>
                const overlay = document.getElementById('overlay');

                btnSidebar.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });

                overlay.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            </script>

        </div>
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark custom-scrollbar">
            {{ $body ?? $slot }}
        </main>
    </div>

</body>

</html>