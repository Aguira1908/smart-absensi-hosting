@extends('layouts.orangtua')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto animate-fade-in">
    
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 rounded-2xl p-8 text-white shadow-lg border border-slate-700/50">
        <div class="relative z-10 max-w-2xl space-y-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 mr-2 animate-pulse"></span>Portal Orang Tua
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight">Selamat Datang Kembali, {{ Auth::user()->name }} 👋</h1>
            <p class="text-slate-300 text-sm md:text-base font-medium">Sistem Informasi Presensi Digital Mandiri — <span class="text-blue-400 font-semibold">SDN 118198 Sei Piandang</span>.</p>
        </div>
        <div class="absolute right-6 bottom-2 text-white/5 text-9xl font-black select-none pointer-events-none hidden md:block">
            🏫
        </div>
    </div>

    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div class="flex items-center space-x-3">
            <div class="p-2.5 bg-slate-900 text-white rounded-xl shadow-md"><i class="fa-solid fa-chart-pie text-sm"></i></div>
            <div>
                <h2 class="text-lg font-bold text-slate-800 tracking-tight">Status & Ringkasan Siswa</h2>
                <p class="text-xs text-slate-400">Persentase akumulasi kehadiran siswa aktif.</p>
            </div>
        </div>
    </div>

    @if($data->isEmpty())
        <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center shadow-sm">
            <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-slate-100"><i class="fa-solid fa-folder-open"></i></div>
            <p class="text-slate-500 font-bold text-base">Belum ada data anak yang tertaut</p>
            <p class="text-slate-400 text-xs mt-1">Silakan hubungi Admin SDN 118198 Sei Piandang untuk verifikasi data.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $d)
                <div class="bg-white border border-slate-100/80 rounded-2xl shadow-sm hover:shadow-md transition-all duration-350 overflow-hidden group flex flex-col justify-between">
                    <div class="h-1.5 bg-blue-600 w-full group-hover:bg-indigo-600 transition-colors"></div>
                    
                    <div class="p-6 space-y-5">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <h3 class="font-extrabold text-slate-800 text-lg tracking-tight group-hover:text-blue-600 transition-colors">{{ $d->nama }}</h3>
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-extrabold bg-blue-50 text-blue-700 border border-blue-100/50">
                                    Kelas {{ $d->kelas }}
                                </div>
                            </div>
                            <div class="w-11 h-11 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-slate-400 text-xl shadow-inner">
                                🧑‍🎓
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-y border-slate-50 py-4 text-center">
                            <div class="bg-slate-50/50 rounded-xl p-2.5 border border-slate-100">
                                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Hadir</span>
                                <span class="text-base font-black text-emerald-600 mt-0.5 block">{{ $d->hadir }} Hari</span>
                            </div>
                            <div class="bg-slate-50/50 rounded-xl p-2.5 border border-slate-100">
                                <span class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Lembaga</span>
                                <span class="text-xs font-bold text-slate-700 mt-1 block truncate">SDN 118198</span>
                            </div>
                        </div>

                        <div class="space-y-2 pt-1">
                            <div class="flex justify-between items-center text-xs font-bold">
                                <span class="text-slate-400">Rasio Kehadiran</span>
                                <span class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded">{{ $d->progress }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden p-[1px]">
                                <div class="bg-gradient-to-r from-blue-600 to-emerald-500 h-full rounded-full transition-all duration-700 shadow-sm" style="width: {{ $d->progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection