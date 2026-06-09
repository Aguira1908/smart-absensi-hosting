@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-md border border-black/10">
        <div>
            <span class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 border border-white/10 backdrop-blur-sm">
                <i class="fa-solid fa-clipboard-user mr-2"></i>Sistem Gerbang Presensi
            </span>
            <h1 class="text-xl font-extrabold tracking-tight mt-1">Pusat Kendali Absensi</h1>
            <p class="text-amber-100/70 text-xs mt-0.5">Silakan pilih metode penginputan data kehadiran harian siswa <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-amber-700/20 transition-all group">
            <div class="space-y-4">
                <div class="w-12 h-12 bg-amber-50 text-[#362219] rounded-2xl flex items-center justify-center text-lg border border-amber-100/50 shadow-inner group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Input Absensi Global (Admin)</h3>
                    <p class="text-xs text-slate-400 mt-1 leading-relaxed">Fasilitas khusus manajemen admin untuk menginput atau mengubah log absensi seluruh siswa tanpa batasan rombongan belajar.</p>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-slate-50">
                <a href="{{ route('admin.absensi.create') }}" 
                   class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-[#362219] hover:bg-[#4a352b] text-white text-xs font-black shadow-sm transition-all cursor-pointer">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span>Buka Input Admin</span>
                </a>
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-700/20 transition-all group">
            <div class="space-y-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center text-lg border border-emerald-100/50 shadow-inner group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Absensi Massal Per Kelas (Guru)</h3>
                    <p class="text-xs text-slate-400 mt-1 leading-relaxed">Fasilitas lembar absen cepat per kelas khusus wali kelas/tenaga pengajar aktif untuk mengabsen anak didik secara massal.</p>
                </div>
            </div>
            
            <div class="mt-6 pt-4 border-t border-slate-50">
                <a href="{{ url('/guru/absensi/kelas') }}" 
                   class="w-full inline-flex items-center justify-center space-x-2 px-4 py-2.5 rounded-xl bg-[#114B3E] hover:bg-[#0A3229] text-white text-xs font-black shadow-sm transition-all cursor-pointer">
                    <i class="fa-solid fa-table-list text-[10px]"></i>
                    <span>Buka Lembar Kelas</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection