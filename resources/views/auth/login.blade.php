<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sesi — SDN 118198 Sei Piandang</title>
    
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
<body class="bg-[#F1F5F9] font-sans antialiased min-h-screen flex flex-col justify-between text-slate-700 relative">

    <div class="absolute top-6 left-6 z-20">
        <a href="/" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-teal-600 transition-colors bg-white px-3 py-2 rounded-xl border border-slate-200 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <main class="flex-1 flex items-center justify-center p-4 relative z-10">
        <div class="w-full max-w-md bg-white border border-slate-200 rounded-3xl p-8 shadow-xl space-y-6">
            
            <div class="text-center space-y-1">
                <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-lg border border-teal-100 shadow-inner mx-auto mb-3">
                    <i class="fa-solid fa-school"></i>
                </div>
                <h1 class="text-[10px] font-black text-teal-600 uppercase tracking-widest">Sistem Presensi</h1>
                <h2 class="text-xl font-extrabold tracking-tight text-slate-800">Login Pengguna</h2>
                <p class="text-slate-400 text-xs">Silakan masuk menggunakan akun sekolah Anda.</p>
            </div>

            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 rounded-xl p-3 text-xs font-semibold text-rose-600 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <p><i class="fa-solid fa-circle-exclamation mr-1.5"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               placeholder="nama@sekolah.com"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-600/5 transition-all">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-teal-600 hover:underline">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full bg-slate-50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-600/5 transition-all">
                    </div>
                </div>

                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 bg-slate-50 text-teal-600 shadow-sm focus:ring-teal-500/20 w-4 h-4 cursor-pointer">
                        <span class="ms-2 text-[11px] font-bold text-slate-500">Ingat sesi saya di komputer ini</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center space-x-2 px-4 py-3 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-black text-xs uppercase tracking-wider shadow-md shadow-teal-600/10 transition-all cursor-pointer">
                        <i class="fa-solid fa-right-to-bracket text-xs"></i>
                        <span>Masuk Aplikasi</span>
                    </button>
                </div>

            </form>

        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center shadow-inner text-[10px] font-bold text-slate-400 tracking-wider">
        &copy; 2026 SDN 118198 Sei Piandang. All Rights Reserved.
    </footer>

</body>
</html>