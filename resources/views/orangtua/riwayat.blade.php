@extends('layouts.orangtua')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    
    <div>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Riwayat Presensi</h1>
        <p class="text-xs text-slate-400 mt-0.5">Lembar rekapitulasi kehadiran harian siswa terperinci secara real-time.</p>
    </div>

    @if($data->isEmpty())
        <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center shadow-sm">
            <div class="text-slate-300 text-5xl mb-3"><i class="fa-solid fa-calendar-xmark"></i></div>
            <p class="text-slate-500 font-bold">Belum ada catatan kehadiran bulan ini.</p>
        </div>
    @else
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">
                            <th class="py-4 px-6">Nama Lengkap Siswa</th>
                            <th class="py-4 px-6">Tanggal & Waktu Catat</th>
                            <th class="py-4 px-6 text-right">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                        @foreach($data as $d)
                            <tr class="hover:bg-slate-50/60 transition-colors duration-150">
                                <td class="py-4 px-6 font-extrabold text-slate-800">{{ $d->nama }}</td>
                                
                                <td class="py-4 px-6 text-slate-500">
                                    <span class="inline-flex items-center bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg text-xs font-semibold border border-slate-200/40">
                                        <i class="fa-regular fa-clock mr-1.5 text-slate-400"></i>
                                        {{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d F Y - H:i') }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-6 text-right">
                                    @php $status = strtolower($d->status); @endphp
                                    
                                    @if($status == 'hadir')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span> Hadir
                                        </span>
                                    @elseif($status == 'sakit' || $status == 'izin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2"></span> {{ ucfirst($d->status) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-2"></span> Alpa
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection