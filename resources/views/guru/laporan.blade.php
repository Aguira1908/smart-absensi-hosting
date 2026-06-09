@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div>
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                <i class="fa-solid fa-file-invoice mr-1.5"></i>Pusat Dokumen
            </span>
            <h1 class="text-xl font-extrabold tracking-tight mt-1">Laporan & Rekapitulasi</h1>
            <p class="text-emerald-100/70 text-xs mt-0.5">Ekspor berkas rekap absensi berkala untuk keperluan arsip administrasi kelas <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        
        <a href="{{ route('guru.laporan.bulanan') }}" 
           class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-700/20 transition-all group relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 text-slate-100/40 text-7xl font-black pointer-events-none group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            
            <div class="space-y-4 relative z-10">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center text-lg border border-emerald-100/50 shadow-inner group-hover:bg-[#091F1A] group-hover:text-emerald-400 transition-colors">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Rekap Bulanan Kelas</h3>
                    <p class="text-xs text-slate-400 mt-1 leading-relaxed">Ekspor dokumen rekapitulasi kehadiran serentak seluruh siswa per kelas berdasarkan rentang bulan yang Anda pilih.</p>
                </div>
            </div>
            
            <div class="mt-8 pt-4 border-t border-slate-50 flex items-center justify-between text-xs font-black text-emerald-700 group-hover:text-[#091F1A] transition-colors relative z-10">
                <span>Buka Lembar Rekap</span>
                <i class="fa-solid fa-arrow-right-long tracking-normal group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

        <a href="{{ route('guru.laporan.siswa') }}" 
           class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-emerald-700/20 transition-all group relative overflow-hidden">
            <div class="absolute -right-6 -bottom-6 text-slate-100/40 text-7xl font-black pointer-events-none group-hover:scale-110 transition-transform duration-300">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            
            <div class="space-y-4 relative z-10">
                <div class="w-12 h-12 bg-amber-50 text-amber-700 rounded-2xl flex items-center justify-center text-lg border border-amber-100/50 shadow-inner group-hover:bg-[#091F1A] group-hover:text-emerald-400 transition-colors">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">Riwayat Per Siswa</h3>
                    <p class="text-xs text-slate-400 mt-1 leading-relaxed">Lihat dan cetak kartu rekam jejak riwayat kehadiran mendalam dari satu siswa secara individual dari awal semester.</p>
                </div>
            </div>
            
            <div class="mt-8 pt-4 border-t border-slate-50 flex items-center justify-between text-xs font-black text-emerald-700 group-hover:text-[#091F1A] transition-colors relative z-10">
                <span>Buka Lembar Riwayat</span>
                <i class="fa-solid fa-arrow-right-long tracking-normal group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>

    </div>

</div>
@endsection