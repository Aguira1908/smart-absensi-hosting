<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Orang Tua - SDN 118198 Sei Piandang</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Nunito', sans-serif; 
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex min-h-screen">

    <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between shadow-xl fixed h-full z-20 border-r border-slate-800">
        
        <div>
            <div class="p-5 border-b border-slate-800 flex items-center space-x-3 bg-slate-950/40">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center text-white text-sm shadow-md font-extrabold">
                    SP
                </div>
                <div>
                    <h2 class="text-xs font-black uppercase tracking-wider text-slate-400">Portal Absensi</h2>
                    <h1 class="text-sm font-extrabold text-slate-200 truncate w-40">SDN 118198</h1>
                </div>
            </div>

            <div class="p-5 border-b border-slate-800 bg-slate-950/20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-slate-800 border-2 border-blue-500/30 flex items-center justify-center text-lg shadow-inner">
                        👋
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-tight">Orang Tua</p>
                        <h3 class="text-sm font-bold text-white truncate w-40">{{ Auth::user()->name }}</h3>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-1.5 mt-4">
                <a href="{{ route('orangtua.dashboard') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold tracking-tight transition-all duration-200 
                          {{ Request::routeIs('orangtua.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-house text-base w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('orangtua.beranda') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold tracking-tight transition-all duration-200 
                          {{ Request::routeIs('orangtua.beranda') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-children text-base w-5 text-center"></i>
                    <span>Data Anak</span>
                </a>

                <a href="{{ route('orangtua.riwayat') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-bold tracking-tight transition-all duration-200 
                          {{ Request::routeIs('orangtua.riwayat') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-calendar-days text-base w-5 text-center"></i>
                    <span>Riwayat Presensi</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-950/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl text-sm font-bold text-rose-400 hover:text-white bg-rose-500/10 hover:bg-rose-600 border border-rose-500/20 hover:border-rose-600 shadow-sm transition-all duration-200 cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 ml-64 p-8 min-h-screen">
        @yield('content')
    </main>

</body>
</html>