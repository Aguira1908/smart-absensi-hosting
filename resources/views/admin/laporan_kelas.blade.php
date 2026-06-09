@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-md border border-black/10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-file-invoice mr-2"></i>Rekapitulasi Presensi
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">
                    Laporan Bulanan: {{ \Carbon\Carbon::createFromDate($tahun, (int)$bulan, 1)->translatedFormat('F Y') }}
                </h1>
                <p class="text-amber-100/70 text-xs mt-0.5">Arsip rekap kehadiran siswa per rombongan belajar di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.laporan.kelas', ['kelas_id' => $kelasId, 'bulan' => $bulan - 1 <= 0 ? 12 : $bulan - 1, 'tahun' => $bulan - 1 <= 0 ? $tahun - 1 : $tahun]) }}" 
                   class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all border border-white/10">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span>Bulan Lalu</span>
                </a>
                <a href="{{ route('admin.laporan.kelas', ['kelas_id' => $kelasId, 'bulan' => $bulan + 1 > 12 ? 1 : $bulan + 1, 'tahun' => $bulan + 1 > 12 ? $tahun + 1 : $tahun]) }}" 
                   class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all border border-white/10">
                    <span>Bulan Depan</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm space-y-3">
        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest"><i class="fa-solid fa-layer-group mr-1"></i>Pilih Rombongan Belajar (Kelas):</span>
        <div class="flex flex-wrap gap-2">
            @foreach($semuaKelas as $k)
                <a href="{{ route('admin.laporan.kelas', ['kelas_id' => $k->id, 'bulan' => $bulan, 'tahun' => $tahun]) }}" class="inline-block">
                    <button class="px-4 py-2 rounded-xl text-xs font-black tracking-tight transition-all duration-150 cursor-pointer border
                        {{ $kelasId == $k->id 
                            ? 'bg-[#362219] text-white border-[#362219] shadow-md shadow-[#362219]/10' 
                            : 'bg-slate-50 text-slate-600 border-slate-200/60 hover:bg-slate-100' }}">
                        Kelas {{ $k->nama_kelas }}
                    </button>
                </a>
            @endforeach
        </div>
    </div>

    @if(!$kelasId)
        <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center shadow-sm">
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-amber-100/50 shadow-inner">
                <i class="fa-solid fa-arrow-pointer animate-bounce"></i>
            </div>
            <p class="text-slate-500 font-bold text-sm">Lembar Laporan Belum Terbuka</p>
            <p class="text-slate-400 text-xs mt-1">Silakan pilih salah satu tombol rombongan belajar di atas untuk menampilkan log rekap kehadiran.</p>
        </div>
    @endif

    @if($kelasId)
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-4 px-6" style="width: 35%">Nama Siswa</th>
                            <th class="py-4 px-6 text-center" style="width: 15%">Kelas</th>
                            <th class="py-4 px-6 text-center" style="width: 25%">Tanggal Absen</th>
                            <th class="py-4 px-6 text-right" style="width: 25%">Status Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                        @forelse($data as $d)
                            <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                                <td class="py-4 px-6 font-extrabold text-slate-800">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs shadow-inner">
                                            {{ strtoupper(substr($d->nama, 0, 1)) }}
                                        </div>
                                        <span>{{ $d->nama }}</span>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200/50">
                                        {{ $d->nama_kelas }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-6 text-center text-slate-500 font-mono tracking-wide">
                                    <i class="fa-regular fa-calendar-check mr-1.5 text-slate-400"></i>
                                    {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
                                </td>
                                
                                <td class="py-4 px-6 text-right">
                                    @php 
                                        $status = strtolower($d->status); 
                                    @endphp
                                    
                                    @if($status == 'hadir')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Hadir
                                        </span>
                                    @elseif($status == 'sakit' || $status == 'izin')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span> {{ ucfirst($d->status) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span> Alpa
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center">
                                    <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-clipboard-question"></i></div>
                                    <p class="text-slate-400 font-bold text-sm">Tidak ada log data presensi.</p>
                                    <p class="text-slate-400 text-xs mt-0.5">Belum ada rekaman presensi yang di-input untuk kelas ini pada periode bulan terpilih.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection