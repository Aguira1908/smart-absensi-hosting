@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-pen-to-square mr-1.5"></i>Lembar Kerja Pengajar
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Input Absensi Kelas</h1>
                <p class="text-emerald-100/70 text-xs mt-0.5">Kelola log kehadiran harian siswa secara serentak di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="shrink-0">
                <a href="/guru/absensi" class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-emerald-300 text-xs font-bold border border-white/5 transition-all">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Riwayat</span>
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('guru.absensi.storeKelas') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-slate-50 text-slate-500 rounded-xl flex items-center justify-center text-sm shadow-inner">
                    <i class="fa-regular fa-calendar-plus text-emerald-700"></i>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">Tanggal Presensi</label>
                    <span class="text-xs text-slate-500 font-medium">Tentukan hari operasional efektif sekolah</span>
                </div>
            </div>
            
            <div class="relative w-full sm:w-64">
                <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                       class="w-full bg-slate-50 border border-slate-200 text-slate-800 py-2.5 px-4 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-[#091F1A] focus:ring-4 focus:ring-emerald-950/5 transition-all cursor-pointer">
            </div>
        </div>

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-4 px-6 text-center" style="width: 10%">No</th>
                            <th class="py-4 px-6" style="width: 45%">Nama Lengkap Siswa</th>
                            <th class="py-4 px-6 text-center" style="width: 45%">Status Kehadiran Hari Ini</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                        @forelse($siswa as $index => $s)
                            <tr class="hover:bg-slate-50/20 transition-colors duration-150">
                                <td class="py-4 px-6 text-center font-bold text-slate-400">
                                    {{ $index + 1 }}
                                </td>
                                
                                <td class="py-4 px-6 font-extrabold text-slate-800">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs shadow-inner">
                                            {{ strtoupper(substr($s->nama, 0, 1)) }}
                                        </div>
                                        <span>{{ $s->nama }}</span>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center sm:justify-start gap-1.5 flex-wrap">
                                        
                                        <label class="cursor-pointer">
                                            <input type="radio" name="status[{{ $s->id }}]" value="hadir" checked class="peer hidden">
                                            <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-600 block peer-checked:bg-emerald-50 peer-checked:text-emerald-700 peer-checked:border-emerald-300 transition-all shadow-sm/50">Hadir</span>
                                        </label>

                                        <label class="cursor-pointer">
                                            <input type="radio" name="status[{{ $s->id }}]" value="izin" class="peer hidden">
                                            <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-600 block peer-checked:bg-amber-50 peer-checked:text-amber-700 peer-checked:border-amber-300 transition-all shadow-sm/50">Izin</span>
                                        </label>

                                        <label class="cursor-pointer">
                                            <input type="radio" name="status[{{ $s->id }}]" value="sakit" class="peer hidden">
                                            <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-600 block peer-checked:bg-sky-50 peer-checked:text-sky-700 peer-checked:border-sky-300 transition-all shadow-sm/50">Sakit</span>
                                        </label>

                                        <label class="cursor-pointer">
                                            <input type="radio" name="status[{{ $s->id }}]" value="alpha" class="peer