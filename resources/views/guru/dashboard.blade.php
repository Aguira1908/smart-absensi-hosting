@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-chalkboard-user mr-1.5"></i>Lembar Ikhtisar
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Selamat Datang di Dashboard Guru</h1>
                <p class="text-emerald-100/70 text-xs mt-0.5">Pemantauan log aktivitas kehadiran harian anak didik Anda hari ini.</p>
            </div>
            
            <div class="shrink-0 text-left sm:text-right">
                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest block">Periode Tugas</span>
                <span class="text-sm font-bold text-white tracking-tight">
                    <i class="fa-regular fa-calendar-days mr-1.5 text-emerald-400"></i>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        
        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex flex-col justify-between group hover:border-emerald-700/20 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Total Siswa</span>
                <div class="w-7 h-7 bg-slate-50 text-slate-500 rounded-lg flex items-center justify-center text-xs shadow-inner"><i class="fa-solid fa-users"></i></div>
            </div>
            <h3 class="text-2xl font-black text-slate-800 mt-3">{{ $totalSiswa }} <span class="text-xs text-slate-400 font-bold">Anak</span></h3>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex flex-col justify-between group hover:border-emerald-700/20 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Hadir</span>
                <div class="w-7 h-7 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <h3 class="text-2xl font-black text-emerald-600 mt-3">{{ $hadir }} <span class="text-xs text-emerald-400 font-bold">Anak</span></h3>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex flex-col justify-between group hover:border-emerald-700/20 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Izin</span>
                <div class="w-7 h-7 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-envelope-open-text"></i></div>
            </div>
            <h3 class="text-2xl font-black text-amber-600 mt-3">{{ $izin }} <span class="text-xs text-slate-400 font-bold">Anak</span></h3>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex flex-col justify-between group hover:border-emerald-700/20 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Sakit</span>
                <div class="w-7 h-7 bg-sky-50 text-sky-600 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-file-medical"></i></div>
            </div>
            <h3 class="text-2xl font-black text-sky-600 mt-3">{{ $sakit }} <span class="text-xs text-slate-400 font-bold">Anak</span></h3>
        </div>

        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex flex-col justify-between group hover:border-emerald-700/20 transition-all col-span-2 md:col-span-1">
            <div class="flex items-center justify-between">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Alpa</span>
                <div class="w-7 h-7 bg-rose-50 text-rose-600 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-circle-xmark"></i></div>
            </div>
            <h3 class="text-2xl font-black text-rose-600 mt-3">{{ $alpha }} <span class="text-xs text-slate-400 font-bold">Anak</span></h3>
        </div>

    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-sm space-y-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-700 text-xs"><i class="fa-solid fa-chart-line"></i></span>
                <h4 class="text-xs font-black text-slate-700 uppercase tracking-wider">Progress Kehadiran Kelas</h4>
            </div>
            <span class="text-xs font-black text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-lg border border-emerald-100/50 shadow-inner">
                {{ $progress }}% Selesai
            </span>
        </div>
        
        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden p-0.5 border border-slate-200/50">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-2 rounded-full text-[9px] font-bold text-white flex items-center justify-end pr-2 transition-all duration-500" 
                 style="width: {{ $progress }}%">
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-slate-500 text-xs"><i class="fa-solid fa-list-check"></i></span>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">Absensi Hari Ini</h3>
            </div>
            <span class="text-[10px] font-bold text-slate-400 italic">*Urutan nama ter-input</span>
        </div>

        @if($data->isEmpty())
            <div class="p-16 text-center space-y-2">
                <div class="text-slate-300 text-4xl"><i class="fa-solid fa-clipboard-list"></i></div>
                <p class="text-slate-400 font-bold text-sm">Belum ada rekaman presensi.</p>
                <p class="text-slate-400 text-xs">Silakan pilih menu 'Input Absensi' di bilah menu samping untuk memulai.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 px-6" style="width: 65%">Nama Lengkap Siswa</th>
                            <th class="py-3.5 px-6 text-right" style="width: 35%">Status Log Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                        @foreach($data as $d)
                            @php 
                                $st = strtolower($d->status); 
                            @endphp
                            <tr class="hover:bg-slate-50/40 transition-colors duration-150 {{ $st == 'alpha' ? 'bg-rose-50/30' : '' }}">
                                
                                <td class="py-3.5 px-6 font-extrabold text-slate-800">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs shadow-inner
                                            {{ $st == 'alpha' ? 'bg-rose-50 text-rose-600' : 'bg-slate-100 text-slate-500' }}">
                                            {{ strtoupper(substr($d->nama, 0, 1)) }}
                                        </div>
                                        <span class="{{ $st == 'alpha' ? 'text-rose-900' : '' }}">{{ $d->nama }}</span>
                                    </div>
                                </td>
                                
                                <td class="py-3.5 px-6 text-right">
                                    @if($st == 'hadir')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> HADIR
                                        </span>
                                    @elseif($st == 'sakit' || $st == 'izin')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span> {{ strtoupper($d->status) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100 animate-pulse">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span> ALPHA
                                        </span>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection