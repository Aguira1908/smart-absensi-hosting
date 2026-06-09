<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang — SDN 118198 Sei Piandang</title>
    
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
<body class="font-sans antialiased min-h-screen flex flex-col justify-between text-slate-800 relative overflow-x-hidden bg-cover bg-[center_bottom_25%] bg-no-repeat bg-fixed" 
      style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.35)), url('{{ asset('image/background_sekolah.jpeg') }}');">

    <header class="bg-white/90 backdrop-blur-md border-b border-slate-200 relative z-10 py-4 px-6 md:px-12 flex items-center justify-between shadow-sm">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center border border-teal-100 shadow-inner">
                <i class="fa-solid fa-school-flag text-sm"></i>
            </div>
            <div>
                <h1 class="text-[10px] font-black text-teal-600 uppercase tracking-widest">Sistem Presensi</h1>
                <h2 class="text-sm font-extrabold tracking-tight text-slate-800 uppercase -mt-0.5">SDN 118198 Sei Piandang</h2>
            </div>
        </div>
        
        <div class="hidden sm:block text-[11px] font-bold text-slate-700 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200 shadow-sm">
            <i class="fa-regular fa-clock mr-1.5 text-teal-600"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </header>

    <main class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 md:px-12 relative z-10">
        <div class="max-w-4xl w-full text-center space-y-8">
            
            <div class="space-y-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-900 text-white shadow-sm">
                    ✨ SELAMAT DATANG — AKSES RESMI
                </span>
                <h1 class="text-2xl md:text-4xl font-extrabold text-[#E5C158] tracking-tight leading-tight max-w-3xl mx-auto drop-shadow-[0_4px_6px_rgba(0,0,0,0.9)]">
                    Selamat Datang di Portal Presensi Digital <br>
                    <span class="text-white drop-shadow-[0_4px_6px_rgba(0,0,0,0.9)]">SDN 118198 Sei Piandang</span>
                </h1>
                <p class="text-white text-xs md:text-sm max-w-xl mx-auto font-bold leading-relaxed drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                    Akses layanan pencatatan kehadiran harian civitas akademika. <br>Silakan pilih gerbang masuk sesuai dengan hak akses akun terdaftar Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto pt-2">
                
                <a href="/login" class="bg-[#111827]/90 backdrop-blur-md border border-slate-700/50 rounded-2xl p-5 shadow-2xl hover:border-amber-500 transition-all duration-200 group flex flex-col justify-between text-left relative z-20">
                    <div class="space-y-3">
                        <div class="w-10 h-10 bg-amber-500/10 text-amber-400 rounded-xl flex items-center justify-center text-sm border border-amber-500/20 shadow-inner group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-black text-amber-400 uppercase tracking-tight">Portal Admin</h3>
                            <p class="text-[11px] text-slate-300 mt-1 font-medium leading-normal">Pengelolaan penuh basis data master institusi dan rombongan belajar.</p>
                        </div>
                    </div>
                    <div class="mt-5 pt-2.5 pb-2.5 rounded-xl bg-slate-800/80 border border-slate-700/40 group-hover:bg-amber-600 group-hover:text-white text-[11px] font-black text-amber-400 group-hover:border-amber-600 transition-all text-center">
                        <span>Masuk Sesi</span>
                    </div>
                </a>

                <a href="/login" class="bg-[#111827]/90 backdrop-blur-md border border-slate-700/50 rounded-2xl p-5 shadow-2xl hover:border-emerald-500 transition-all duration-200 group flex flex-col justify-between text-left relative z-20">
                    <div class="space-y-3">
                        <div class="w-10 h-10 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center text-sm border border-emerald-500/20 shadow-inner group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-black text-emerald-400 uppercase tracking-tight">Portal Guru</h3>
                            <p class="text-[11px] text-slate-300 mt-1 font-medium leading-normal">Lembar kerja pengajar untuk pencatatan log presensi massal kelas.</p>
                        </div>
                    </div>
                    <div class="mt-5 pt-2.5 pb-2.5 rounded-xl bg-slate-800/80 border border-slate-700/40 group-hover:bg-teal-600 group-hover:text-white text-[11px] font-black text-emerald-400 group-hover:border-teal-600 transition-all text-center">
                        <span>Masuk Sesi</span>
                    </div>
                </a>

                <a href="/login" class="bg-[#111827]/90 backdrop-blur-md border border-slate-700/50 rounded-2xl p-5 shadow-2xl hover:border-blue-400 transition-all duration-200 group flex flex-col justify-between text-left relative z-20">
                    <div class="space-y-3">
                        <div class="w-10 h-10 bg-blue-500/10 text-blue-400 rounded-xl flex items-center justify-center text-sm border border-blue-500/20 shadow-inner group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-children"></i>
                        </div>
                        <div>
                            <h3 class="text-xs font-black text-blue-400 uppercase tracking-tight">Wali Murid</h3>
                            <p class="text-[11px] text-slate-300 mt-1 font-medium leading-normal">Pemantauan rekam jejak jurnal kehadiran berkala anak didik.</p>
                        </div>
                    </div>
                    <div class="mt-5 pt-2.5 pb-2.5 rounded-xl bg-slate-800/80 border border-slate-700/40 group-hover:bg-blue-600 group-hover:text-white text-[11px] font-black text-blue-400 group-hover:border-blue-600 transition-all text-center">
                        <span>Masuk Sesi</span>
                    </div>
                </a>

            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-[10px] font-bold text-slate-600 tracking-wider relative z-10">
        &copy; 2026 SDN 118198 Sei Piandang. All Rights Reserved.
    </footer>

</body>
</html>