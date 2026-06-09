@extends('layouts.guru')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#091F1A] to-[#123E34] rounded-2xl p-6 text-white shadow-md border border-emerald-950/20">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-white/10 text-emerald-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-address-book mr-1.5"></i>Manajemen Rombel
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">
                    Anak Didik: Kelas {{ $kelas->nama_kelas ?? '-' }}
                </h1>
                <p class="text-emerald-100/70 text-xs mt-0.5">Daftar nama dan Nomor Induk Siswa aktif di bawah bimbingan wali kelas.</p>
            </div>
            
            <div class="shrink-0">
                <span class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-white/5 text-emerald-300 text-xs font-black border border-white/5 shadow-sm">
                    <i class="fa-solid fa-graduation-cap text-xs"></i>
                    <span>Total: {{ count($siswa) }} Siswa</span>
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-800 text-xs"><i class="fa-solid fa-id-card-clip"></i></span>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">Biodata Registrasi Kelas</h3>
            </div>
            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/50">
                Tahun Ajaran 2026/2027
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 10%">No</th>
                        <th class="py-4 px-6" style="width: 55%">Nama Lengkap Siswa</th>
                        <th class="py-4 px-6" style="width: 35%">Nomor Induk Siswa (NIS)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($siswa as $i => $s)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">
                                {{ $i + 1 }}
                            </td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-emerald-50 text-emerald-700 rounded-lg flex items-center justify-center font-black text-xs border border-emerald-100/30 shadow-inner">
                                        {{ strtoupper(substr($s->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $s->nama }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-slate-500 font-mono tracking-wider font-bold">
                                <i class="fa-solid fa-fingerprint mr-1.5 text-slate-300"></i>{{ $s->nis }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-16 px-6 text-center">
                                <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-users-slash"></i></div>
                                <p class="text-slate-400 font-bold text-sm">Tidak ada siswa terdaftar.</p>
                                <p class="text-slate-400 text-xs mt-0.5">Rombongan belajar ini belum memiliki anggota siswa aktif.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection