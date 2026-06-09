<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SDN 118198 Sei Piandang</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Nunito', sans-serif; 
        }
        /* Custom scrollbar halus untuk menu */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #2D1E18; }
        ::-webkit-scrollbar-thumb { background: #4A352B; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 flex min-h-screen">

    <aside class="w-64 bg-[#362219] text-white flex flex-col justify-between shadow-2xl fixed h-full z-20 border-r border-black/10">
        
        <div class="p-5 border-b border-black/20 flex items-center space-x-3 bg-black/30">
    <div class="w-9 h-9 bg-[#59483E] rounded-xl flex items-center justify-center text-white text-xs shadow-md border border-white/5 font-black tracking-wider">
        ADM
    </div>
    <div>
        <h2 class="text-[10px] font-bold uppercase tracking-widest text-amber-100/40">Pusat Data</h2>
        <h1 class="text-sm font-black text-white truncate w-40">SDN 118198</h1>
    </div>
</div>

            <div class="p-5 border-b border-black/20 bg-black/10 flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-[#4A352B] flex items-center justify-center text-xs border border-white/10 shadow-inner">
                    👤
                </div>
                <div class="overflow-hidden">
                    <p class="text-[10px] font-medium text-amber-100/60 uppercase tracking-wider">Administrator</p>
                    <h3 class="text-xs font-bold text-white truncate w-44">{{ Auth::user()->name ?? 'Admin Sistem' }}</h3>
                </div>
            </div>

            <nav class="p-4 space-y-1.5 overflow-y-auto h-[calc(100vh-220px)]">
                
                <span class="block px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-amber-100/40">Menu Utama</span>

                <a href="/admin" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie text-base w-5 text-center {{ Request::is('admin') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Dashboard</span>
                </a>

                <span class="block px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-amber-100/40">Kependidikan</span>

                <a href="/admin/siswa" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/siswa*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-user-graduate text-base w-5 text-center {{ Request::is('admin/siswa*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Data Siswa</span>
                </a>

                <a href="/admin/guru" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/guru*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-chalkboard-user text-base w-5 text-center {{ Request::is('admin/guru*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Kelola Guru</span>
                </a>

                <a href="/admin/orangtua" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/orangtua*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-users text-base w-5 text-center {{ Request::is('admin/orangtua*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Orang Tua</span>
                </a>

                <span class="block px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-amber-100/40">Rekap & Laporan</span>

                <a href="/admin/dashboard-stats" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/dashboard-stats*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-chart-line text-base w-5 text-center {{ Request::is('admin/dashboard-stats*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Statistik Absensi</span>
                </a>

                <a href="/admin/kalender-tahun" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/kalender-tahun*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-calendar text-base w-5 text-center {{ Request::is('admin/kalender-tahun*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Kalender Akademik</span>
                </a>

                <a href="/admin/laporan/kelas" 
                   class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-all duration-150 group
                          {{ Request::is('admin/laporan/kelas*') ? 'bg-white text-[#362219] shadow-md font-extrabold' : 'text-amber-50/70 hover:bg-white/10 hover:text-white' }}">
                    <i class="fa-solid fa-file-invoice text-base w-5 text-center {{ Request::is('admin/laporan/kelas*') ? 'text-[#362219]' : 'text-amber-100/40 group-hover:text-amber-100' }}"></i>
                    <span>Laporan Kelas</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-black/20 bg-black/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl text-xs font-bold text-rose-300 hover:text-white bg-rose-500/10 hover:bg-rose-600 transition-all duration-150 cursor-pointer border border-rose-500/10 shadow-sm">
                    <i class="fa-solid fa-power-off text-xs"></i>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 ml-64 p-8 min-h-screen">
        @yield('content')
    </main>

</body>
</html>