@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-sm border border-black/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 px-2 py-0.5 rounded border border-white/5">Database Sekolah</span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Manajemen Data Siswa</h1>
                <p class="text-amber-100/70 text-xs mt-0.5">Daftar siswa aktif terdaftar di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="shrink-0">
                <a href="{{ route('siswa.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black shadow-sm hover:shadow transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>+ Registrasi Siswa</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 8%">No</th>
                        <th class="py-4 px-6" style="width: 35%">Nama Lengkap</th>
                        <th class="py-4 px-6" style="width: 22%">Nomor Induk Siswa (NIS)</th>
                        <th class="py-4 px-6 text-center" style="width: 15%">Kelas</th>
                        <th class="py-4 px-6 text-center" style="width: 20%">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($siswa as $i => $s)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">{{ $i + 1 }}</td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs shadow-inner">
                                        {{ uppercase(substr($s->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $s->nama }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-slate-550 font-mono tracking-wider">{{ $s->nis }}</td>
                            
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100/50">
                                    Kelas {{ $s->kelas_id }}
                                </span>
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    
                                    <a href="{{ route('siswa.edit', $s->id) }}" class="p-2 bg-amber-50 text-amber-700 hover:bg-amber-500 hover:text-white rounded-xl border border-amber-200/40 transition-all text-xs" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white rounded-xl border border-rose-200/40 transition-all text-xs cursor-pointer" title="Hapus Data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center">
                                <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-users-slash"></i></div>
                                <p class="text-slate-400 font-bold text-sm">Belum ada data siswa tercatat.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection