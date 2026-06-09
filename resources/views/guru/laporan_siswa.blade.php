@extends('layouts.guru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="{{ route('guru.laporan') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-emerald-400 transition-colors bg-white px-3 py-2 rounded-xl border border-slate-100 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Pusat Laporan</span>
        </a>
        <span class="text-xs font-bold text-slate-400">Arsip Personal</span>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        
        <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex items-center space-x-3">
            <div class="w-10 h-10 bg-[#091F1A] text-emerald-400 rounded-xl flex items-center justify-center text-sm shadow-md border border-emerald-900/30">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-slate-800 tracking-tight">Laporan Riwayat Per Siswa</h2>
                <p class="text-[11px] text-slate-400">Pilih salah satu anak didik untuk meninjau rangkuman log kehadiran individualnya secara mendalam.</p>
            </div>
        </div>

        <div class="p-6 bg-slate-50/30">
            <form method="GET" class="flex flex-col sm:flex-row items-end gap-4">
                
                <div class="space-y-1.5 flex-1 w-full">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">Nama Anak Didik</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs">
                            <i class="fa-solid fa-address-book"></i>
                        </span>
                        <select name="siswa_id" required
                                class="w-full bg-white border border-slate-200 text-slate-700 py-2.5 pl-10 pr-10 rounded-xl text-xs font-bold focus:outline-none focus:border-[#091F1A] focus:ring-4 focus:ring-emerald-950/5 transition-all cursor-pointer appearance-none">
                            <option value="">-- Pilih Nama Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}" {{ request('siswa_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400 text-[10px]">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl bg-[#091F1A] hover:bg-[#123E34] text-emerald-400 font-black text-xs uppercase tracking-wider shadow-md border border-emerald-900/30 transition-all cursor-pointer h-[38px]">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Tampilkan Log</span>
                </button>

            </form>
        </div>
    </div>

    @if(count($data) > 0)
        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-slate-500 text-xs"><i class="fa-solid fa-receipt"></i></span>
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">Rekam Jejak Presensi</h3>
                </div>
                <span class="text-[10px] font-black text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100/40">
                    Total: {{ count($data) }} Log record
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 px-6 text-center" style="width: 12%">No</th>
                            <th class="py-3.5 px-6 font-semibold" style="width: 53%">Tanggal Operasional KBM</th>
                            <th class="py-3.5 px-6 text-right" style="width: 35%">Status Log</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                        @foreach($data as $index => $d)
                            @php 
                                $st = strtolower($d->status); 
                            @endphp
                            <tr class="hover:bg-slate-50/30 transition-colors duration-150 {{ $st == 'alpha' ? 'bg-rose-50/10' : '' }}">
                                
                                <td class="py-3.5 px-6 text-center font-bold text-slate-400">
                                    {{ $index + 1 }}
                                </td>
                                
                                <td class="py-3.5 px-6 font-extrabold text-slate-700">
                                    <div class="flex items-center space-x-2.5">
                                        <span class="text-slate-300 text-xs"><i class="fa-regular fa-calendar"></i></span>
                                        <span>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </td>
                                
                                <td class="py-3.5 px-6 text-right">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(request('siswa_id'))
        <div class="bg-white border border-slate-100 rounded-2xl p-12 text-center space-y-2 shadow-sm">
            <div class="text-slate-300 text-3xl"><i class="fa-solid fa-folder-open"></i></div>
            <p class="text-slate-400 font-bold text-sm">Log Absensi Kosong</p>
            <p class="text-slate-400 text-xs">Siswa yang Anda pilih belum memiliki catatan log presensi di semester ini.</p>
        </div>
    @endif

</div>
@endsection