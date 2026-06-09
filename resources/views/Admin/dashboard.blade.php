@extends('layouts.admin')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    
    <div class="relative overflow-hidden bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 md:p-8 text-white shadow-md border border-black/10">
        <div class="relative z-10 max-w-3xl space-y-2">
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 border border-white/10 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 mr-2 animate-pulse"></span>Pusat Kendali Admin
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">Dashboard Ringkasan</h1>
            <p class="text-amber-100/80 text-xs md:text-sm font-medium leading-relaxed">
                Sistem Informasi Presensi & Manajemen Data Otoritas <span class="text-white font-bold underline decoration-amber-400/50 decoration-2">SDN 118198 Sei Piandang</span>.
            </p>
        </div>
        <div class="absolute right-8 bottom-0 text-white/5 text-8xl font-black select-none pointer-events-none hidden lg:block">
            🏫
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex items-center justify-between hover:border-blue-200 hover:shadow-md transition-all duration-200 group">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Siswa</span>
                <h3 class="text-4xl font-black tracking-tight text-slate-800 group-hover:text-blue-600 transition-colors">
                    {{ $totalSiswa }}<span class="text-xs font-bold text-slate-400 ml-1.5 tracking-normal">Siswa Aktif</span>
                </h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg border border-blue-100/50 shadow-inner shrink-0">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex items-center justify-between hover:border-emerald-200 hover:shadow-md transition-all duration-200 group">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Kelas</span>
                <h3 class="text-4xl font-black tracking-tight text-slate-800 group-hover:text-emerald-600 transition-colors">
                    {{ $totalKelas }}<span class="text-xs font-bold text-slate-400 ml-1.5 tracking-normal">Rombel</span>
                </h3>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center text-lg border border-emerald-100/50 shadow-inner shrink-0">
                <i class="fa-solid fa-school"></i>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex items-center justify-between hover:border-purple-200 hover:shadow-md transition-all duration-200 group">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Pengguna</span>
                <h3 class="text-4xl font-black tracking-tight text-slate-800 group-hover:text-purple-600 transition-colors">
                    {{ $totalUser }}<span class="text-xs font-bold text-slate-400 ml-1.5 tracking-normal">Akun Terdaftar</span>
                </h3>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center text-lg border border-purple-100/50 shadow-inner shrink-0">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
            <div class="flex items-center space-x-2 border-b border-slate-50 pb-3">
                <span class="text-amber-500"><i class="fa-solid fa-bolt-lightning text-sm"></i></span>
                <h3 class="text-sm font-bold text-slate-700">Pusat Kendali Tindakan</h3>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="/admin/siswa" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-[#362219] hover:bg-[#4A352B] text-white text-xs font-bold shadow-sm hover:shadow transition-all cursor-pointer">
                    <i class="fa-solid fa-folder-open text-xs"></i>
                    <span>Buka Data Siswa</span>
                </a>
                <a href="/admin/siswa/create" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm hover:shadow transition-all cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Registrasi Siswa Baru</span>
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-50 to-slate-100/50 border border-slate-200/50 rounded-2xl p-5 shadow-inner flex flex-col justify-between">
            <div class="space-y-1.5">
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pemberitahuan Sistem</h4>
                <p class="text-xs text-slate-400 leading-relaxed">Semua log aktivitas perubahan data siswa, guru, dan absensi diatur dan dipantau sepenuhnya dari panel ini.</p>
            </div>
            <div class="text-[10px] font-bold text-slate-400 mt-4 pt-3 border-t border-slate-200/60 flex justify-between">
                <span>Versi Aplikasi</span>
                <span class="text-slate-600">v3.0 - Premium</span>
            </div>
        </div>
    </div>

</div>
@endsection