<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru — SDN 118198 Sei Piandang</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F8FAFC] font-sans antialiased flex min-h-screen text-slate-800">

    <aside class="w-64 bg-gradient-to-b from-[#091F1A] to-[#040E0B] text-white min-h-screen p-5 flex flex-col justify-between shadow-2xl shrink-0 z-20 border-r border-black">
        
        <div>
            <div class="mb-8 border-b border-white/5 pb-5 pt-2">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-9 h-9 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center border border-emerald-500/20 shadow-inner">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-[10px] font-black tracking-widest text-emerald-500/70 uppercase">PORTAL GURU</h3>
                        <h2 class="text-xs font-extrabold tracking-tight text-slate-200 uppercase mt-0.5">SDN 118198</h2>
                    </div>
                </div>
                
                <div class="bg-white/[0.02] border border-white/[0.05] rounded-xl p-3 mt-4">
                    <p class="text-xs font-extrabold text-slate-200 truncate">
                        {{ auth()->user()->name ?? '' }}
                    </p>
                    
                    @php
                        $kelas = DB::table('kelas')->where('guru_id', auth()->id())->first();
                    @endphp
                    
                    <span class="inline-flex items-center mt-1 text-[9px] font-black uppercase tracking-wider text-emerald-400 bg-emerald-950/40 px-2 py-0.5 rounded border border-emerald-900/30">
                        <i class="fa-solid fa-chalkboard mr-1.5 text-emerald-500"></i>
                        Wali {{ $kelas->nama_kelas ?? '-' }}
                    </span>
                </div>
            </div>

            <nav class="space-y-1">
                <span class="block text-[9px] font-black text-slate-500 uppercase tracking-widest px-3 mb-2">Menu Navigasi</span>
                
                <a href="{{ route('guru.dashboard') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold tracking-tight transition-all duration-150 group
                    {{ request()->routeIs('guru.dashboard') ? 'bg-emerald-950 text-emerald-400 border border-emerald-800/30 font-extrabold shadow-inner' : 'text-slate-400 hover:bg-white/[0.03] hover:text-slate-200' }}">
                    <i class="fa-solid fa-house text-xs shrink-0 w-4 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                    <span>Beranda</span>
                </a>

                <a href="{{ route('guru.siswa') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold tracking-tight transition-all duration-150 group
                    {{ request()->routeIs('guru.siswa*') ? 'bg-emerald-950 text-emerald-400 border border-emerald-800/30 font-extrabold shadow-inner' : 'text-slate-400 hover:bg-white/[0.03] hover:text-slate-200' }}">
                    <i class="fa-solid fa-users text-xs shrink-0 w-4 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                    <span>Data Siswa</span>
                </a>

                <a href="{{ route('guru.absensi.kelas') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold tracking-tight transition-all duration-150 group
                    {{ request()->routeIs('guru.absensi*') ? 'bg-emerald-950 text-emerald-400 border border-emerald-800/30 font-extrabold shadow-inner' : 'text-slate-400 hover:bg-white/[0.03] hover:text-slate-200' }}">
                    <i class="fa-solid fa-calendar-check text-xs shrink-0 w-4 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                    <span>Input Absensi</span>
                </a>

                <a href="{{ route('guru.laporan') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-bold tracking-tight transition-all duration-150 group
                    {{ request()->routeIs('guru.laporan*') ? 'bg-emerald-950 text-emerald-400 border border-emerald-800/30 font-extrabold shadow-inner' : 'text-slate-400 hover:bg-white/[0.03] hover:text-slate-200' }}">
                    <i class="fa-solid fa-file-signature text-xs shrink-0 w-4 opacity-70 group-hover:opacity-100 transition-opacity"></i>
                    <span>Laporan</span>
                </a>
            </nav>
        </div>

        <div class="border-t border-white/5 pt-4 mb-2">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda ingin keluar dari Portal Guru?')">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-rose-500/5 hover:bg-rose-950 text-rose-400 hover:text-rose-300 border border-rose-950/40 hover:border-rose-900/50 text-xs font-extrabold tracking-wide transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>🚪 Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 min-w-0 flex flex-col">
        
        <header class="bg-white border-b border-slate-100 py-3.5 px-8 flex items-center justify-between shadow-sm shrink-0">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-800 text-xs"><i class="fa-solid fa-school-flag"></i></span>
                <span class="text-[10px] font-black text-slate-400 tracking-wider uppercase">SDN 118198 Sei Piandang</span>
            </div>
            <div class="text-[10px] font-black text-slate-400 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200/60 tracking-tight">
                <i class="fa-regular fa-clock mr-1.5 text-emerald-700"></i>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </div>

    </main>

</body>
</html>