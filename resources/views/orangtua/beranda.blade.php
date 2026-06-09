@extends('layouts.orangtua')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    
    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">Data Profil Siswa</h1>
            <p class="text-xs text-slate-400 mt-0.5">Daftar siswa terdaftar di bawah pengawasan Anda pada sistem sekolah.</p>
        </div>
        <div class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200/50">
            <i class="fa-solid fa-school mr-1"></i> SDN 118198 Sei Piandang
        </div>
    </div>

    @if($data->isEmpty())
        <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center shadow-sm">
            <div class="text-slate-300 text-5xl mb-3"><i class="fa-solid fa-user-slash"></i></div>
            <p class="text-slate-500 font-bold">Tidak ada data anak aktif ditemukan.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($data as $d)
                <div class="bg-white border border-slate-100/70 rounded-2xl p-5 flex flex-col sm:flex-row items-center justify-between shadow-sm hover:border-slate-300/80 transition-all duration-200 gap-4">
                    <div class="flex items-center space-x-4 w-full sm:w-auto">
                        <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200/60 border border-slate-200 rounded-xl flex items-center justify-center text-2xl shadow-inner shrink-0">
                            👨‍🎓
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-extrabold text-slate-800 tracking-tight text-base leading-snug">{{ $d->nama }}</h3>
                            <div class="flex flex-wrap items-center gap-2 text-xs font-bold">
                                <span class="text-blue-600 bg-blue-50 border border-blue-100/50 px-2 py-0.5 rounded-md">Kelas {{ $d->kelas }}</span>
                                <span class="text-slate-300">•</span>
                                <span class="text-slate-400"><i class="fa-solid fa-graduation-cap mr-1"></i>Siswa Aktif</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-50">
                        <div class="text-left sm:text-right sm:mr-4">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Instansi Akademik</span>
                            <span class="text-xs font-extrabold text-slate-700">SDN 118198 Sei Piandang</span>
                        </div>
                        <div class="w-8 h-8 bg-slate-50 rounded-lg flex items-center justify-center text-slate-400 border border-slate-100">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection