@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-pen-to-square mr-1.5"></i>Lembar Kerja Guru
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">
                    @if($kelas)
                        Input Absensi Massal: {{ $kelas->nama_kelas }}
                    @else
                        Presensi Kelas
                    @endif
                </h1>
                <p class="text-emerald-100/70 text-xs mt-0.5">Kelola log kehadiran harian seluruh siswa secara serentak di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="shrink-0">
                <a href="/guru/absensi" class="inline-flex items-center space-x-2 px-3 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-emerald-300 text-xs font-bold border border-white/5 transition-all">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Lihat Riwayat Jurnal</span>
                </a>
            </div>
        </div>
    </div>

    @if(!$kelas)
        <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center shadow-sm">
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4 border border-amber-100/50 shadow-inner">
                <i class="fa-solid fa-triangle-exclamation animate-pulse"></i>
            </div>
            <p class="text-slate-500 font-bold text-sm">Hak Akses Terbatas</p>
            <p class="text-slate-400 text-xs mt-1">Akun Anda belum terdaftar sebagai wali kelas resmi di database sistem.</p>
        </div>
    @else

        @if(count($siswa) > 0)
            <form method="POST" action="{{ route('guru.absensi.storeKelas') }}" class="space-y-6">
                @csrf

                <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-slate-50 text-slate-500 rounded-xl flex items-center justify-center text-sm shadow-inner">
                            <i class="fa-regular fa-calendar-plus text-emerald-700"></i>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">Pilih Tanggal Jurnal</label>
                            <span class="text-xs text-slate-500 font-medium">Tentukan hari operasional efektif KBM</span>
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
                                    <th class="py-4 px-6 text-center" style="width: 8%">No</th>
                                    <th class="py-4 px-6" style="width: 42%">Nama Lengkap Siswa</th>
                                    <th class="py-4 px-6 text-center" style="width: 50%">Status Kehadiran Hari Ini</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                                @foreach($siswa as $i => $s)
                                    <tr class="hover:bg-slate-50/20 transition-colors duration-150">
                                        <td class="py-4 px-6 text-center font-bold text-slate-400">
                                            {{ $i + 1 }}
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
                                                    <input type="radio" name="status[{{ $s->id }}]" value="terlambat" class="peer hidden">
                                                    <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-600 block peer-checked:bg-indigo-50 peer-checked:text-indigo-700 peer-checked:border-indigo-300 transition-all shadow-sm/50">Terlambat</span>
                                                </label>

                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status[{{ $s->id }}]" value="alpha" class="peer hidden">
                                                    <span class="px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-600 block peer-checked:bg-rose-50 peer-checked:text-rose-700 peer-checked:border-rose-300 transition-all shadow-sm/50">Alpha</span>
                                                </label>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center space-x-2 px-6 py-3 rounded-xl bg-[#091F1A] hover:bg-[#123E34] text-emerald-400 font-black text-xs uppercase tracking-wider shadow-lg border border-emerald-900/30 transition-all cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Jurnal Presensi</span>
                    </button>
                </div>

            </form>
        @else
            <div class="bg-white border border-slate-100 rounded-2xl p-16 text-center space-y-2 shadow-sm">
                <div class="text-slate-300 text-4xl"><i class="fa-solid fa-user-slash"></i></div>
                <p class="text-slate-400 font-bold text-sm">Tidak Ada Siswa Terdaftar</p>
                <p class="text-slate-400 text-xs">Rombongan belajar Anda saat ini belum memiliki data siswa yang dapat diabsen.</p>
            </div>
        @endif

    @endif

</div>
@endsection