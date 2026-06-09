@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-md border border-black/10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-calendar-days mr-2"></i>Agenda Akademik
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Kalender Akademik {{ $tahun }}</h1>
                <p class="text-amber-100/70 text-xs mt-0.5">Penetapan hari efektif dan libur nasional <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kalender.tahun', ['tahun' => $tahun - 1]) }}" 
                   class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all border border-white/10">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span>{{ $tahun - 1 }}</span>
                </a>
                <a href="{{ route('admin.kalender.tahun', ['tahun' => $tahun + 1]) }}" 
                   class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/20 hover:bg-white/30 text-white text-xs font-bold transition-all border border-white/20 shadow-sm">
                    <span>{{ $tahun + 1 }}</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @for ($bulan = 1; $bulan <= 12; $bulan++)
            @php
                $firstDay = \Carbon\Carbon::create($tahun, $bulan, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startDay = $firstDay->dayOfWeek;
            @endphp

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden flex flex-col group hover:border-[#362219]/20 transition-all">
                <div class="bg-slate-50/80 border-b border-slate-100 p-3 text-center">
                    <h4 class="text-xs font-black uppercase tracking-widest text-[#362219]">
                        {{ $firstDay->translatedFormat('F') }}
                    </h4>
                </div>

                <div class="p-3">
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        @foreach(['M','S','S','R','K','J','S'] as $h)
                            <div class="text-[10px] font-black {{ $h == 'M' ? 'text-rose-500' : 'text-slate-300' }} text-center">{{ $h }}</div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-7 gap-1">
                        {{-- Spasi Awal Bulan --}}
                        @for ($i = 0; $i < $startDay; $i++)
                            <div class="h-8"></div>
                        @endfor

                        {{-- Loop Utama Tanggal --}}
                        @for ($d = 1; $d <= $daysInMonth; $d++)
                            @php
                                $date = \Carbon\Carbon::create($tahun, $bulan, $d);
                                $tanggalFull = $date->format('Y-m-d');
                                $isMinggu = $date->dayOfWeek == 0;
                                $isLibur = isset($libur[$tanggalFull]);
                                $isToday = $date->isToday();
                            @endphp

                            <div class="relative group/day">
                                <a href="{{ route('admin.kalender.detail', $tanggalFull) }}" 
                                   class="h-8 flex flex-col items-center justify-center rounded-lg text-[11px] font-bold transition-all relative
                                   {{ $isMinggu ? 'text-rose-600 font-black' : 'text-slate-600' }}
                                   {{ $isLibur ? 'bg-rose-50 text-rose-700 border border-rose-200 shadow-sm' : 'hover:bg-slate-100' }}
                                   {{ $isToday ? 'bg-amber-100 text-amber-800 border border-amber-300 shadow-inner' : '' }}">
                                    
                                    {{ $d }}

                                    {{-- Titik Merah Notifikasi untuk Libur Nasional --}}
                                    @if($isLibur)
                                        <span class="absolute top-1 right-1 flex h-1.5 w-1.5">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-rose-600"></span>
                                        </span>
                                        
                                        <div class="absolute bottom-full mb-2 hidden group-hover/day:block z-50">
                                            <div class="bg-slate-800 text-white text-[9px] px-2 py-1 rounded shadow-xl whitespace-nowrap font-sans font-medium">
                                                {{ $libur[$tanggalFull]->keterangan }}
                                            </div>
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex flex-wrap gap-6 items-center">
        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mr-2">Indikator Kalender:</span>
        
        <div class="flex items-center gap-2">
            <div class="w-5 h-5 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-[10px] font-black text-rose-600 shadow-sm">M</div>
            <span class="text-xs font-bold text-slate-600">Hari Minggu (Libur Pekan)</span>
        </div>

        <div class="flex items-center gap-2">
            <div class="w-5 h-5 rounded-lg bg-rose-50 border border-rose-200 flex items-center justify-center relative shadow-sm">
                <span class="text-[9px] font-bold text-rose-700">7</span>
                <span class="absolute top-0.5 right-0.5 flex h-1 w-1 rounded-full bg-rose-600"></span>
            </div>
            <span class="text-xs font-bold text-slate-600">Libur Nasional / Cuti Bersama</span>
        </div>

        <div class="flex items-center gap-2">
            <div class="w-5 h-5 rounded-lg bg-amber-100 border border-amber-300 flex items-center justify-center shadow-inner">
                <span class="text-[9px] font-black text-amber-800">18</span>
            </div>
            <span class="text-xs font-bold text-slate-600 tracking-tight">Hari Ini (Tanggal Berjalan)</span>
        </div>
    </div>

</div>
@endsection