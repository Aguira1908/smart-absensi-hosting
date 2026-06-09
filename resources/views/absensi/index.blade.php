@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-clock-rotate-left mr-1.5"></i>Arsip Kehadiran
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Riwayat Jurnal Absensi</h1>
                <p class="text-emerald-100/70 text-xs mt-0.5">Daftar rekaman log presensi harian siswa aktif di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('guru.absensi.create') }}" class="inline-flex items-center space-x-2 px-3.5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black shadow-sm transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-user-plus text-[10px]"></i>
                    <span>+ Input Absensi</span>
                </a>
                
                <a href="{{ route('guru.absensi.kelas') }}" class="inline-flex items-center space-x-2 px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-emerald-300 hover:text-white text-xs font-black border border-white/5 shadow-sm transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-table-columns text-[10px]"></i>
                    <span>+ Absensi Per Kelas</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-800 text-xs"><i class="fa-solid fa-receipt"></i></span>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">Log Lembar Kehadiran Siswa</h3>
            </div>
            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/50">
                Terintegrasi Real-time
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 7%">No</th>
                        <th class="py-4 px-6" style="width: 33%">Nama Lengkap Siswa</th>
                        <th class="py-4 px-6 text-center" style="width: 13%">Kelas</th>
                        <th class="py-4 px-6 text-center" style="width: 17%">Tanggal Log</th>
                        <th class="py-4 px-6 text-center" style="width: 15%">Jam Masuk</th>
                        <th class="py-4 px-6 text-right" style="width: 15%">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($data as $i => $d)
                        @php 
                            $st = strtolower($d->status); 
                        @endphp
                        
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150 {{ $st == 'alpha' ? 'bg-rose-50/20' : '' }}">
                            
                            <td class="py-4 px-6 text-center font-bold text-slate-400">
                                {{ $i + 1 }}
                            </td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-black text-xs shadow-inner
                                        {{ $st == 'alpha' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-slate-100 text-slate-500' }}">
                                        {{ strtoupper(substr($d->nama_siswa, 0, 1)) }}
                                    </div>
                                    <span class="{{ $st == 'alpha' ? 'text-rose-900' : '' }}">{{ $d->nama_siswa }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200/40">
                                    {{ $d->nama_kelas }}
                                </span>
                            </td>
                            
                            <td class="py-4 px-6 text-center text-slate-500 font-semibold">
                                {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            
                            <td class="py-4 px-6 text-center font-mono font-bold text-slate-500">
                                <i class="fa-regular fa-clock mr-1.5 text-slate-300"></i>{{ $d->jam_masuk ?? '--:--' }}
                            </td>
                            
                            <td class="py-4 px-6 text-right">
                                @if($st == 'hadir')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Hadir
                                    </span>
                                @elseif($st == 'sakit' || $st == 'izin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span> {{ ucfirst($d->status) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100 animate-pulse">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span> Alpha
                                    </span>
                                @endif
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 px-6 text-center">
                                <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-folder-open"></i></div>
                                <p class="text-slate-400 font-bold text-sm">Belum ada data absensi</p>
                                <p class="text-slate-400 text-xs mt-0.5">Log jurnal kehadiran harian siswa belum tercatat pada basis data sekolah.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection