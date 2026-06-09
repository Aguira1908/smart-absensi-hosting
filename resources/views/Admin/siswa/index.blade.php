@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-sm border border-black/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 px-2 py-0.5 rounded border border-white/5">Database Sekolah</span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">DATA SISWA</h1>
                <p class="text-amber-100/70 text-xs mt-0.5">
                    @if($kelasAktif)
                        Menampilkan Data: <span class="font-bold text-white">{{ $kelasAktif->nama_kelas }}</span> — 
                    @else
                        Semua Kelas — 
                    @endif
                    <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.
                </p>
            </div>
            
            <div class="shrink-0">
                <a href="/admin/siswa/create" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black shadow-sm hover:shadow transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>+ Tambah Siswa</span>
                </a>
            </div>
        </div>
    </div>

    <form action="{{ request()->url() }}" method="GET" class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm flex items-center space-x-3">
        <div class="text-slate-400 text-sm"><i class="fa-solid fa-filter"></i></div>
        <div class="relative w-48">
            <select name="kelas_id" onchange="this.form.submit()"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-700 py-2.5 pl-3 pr-10 rounded-xl text-xs font-bold focus:outline-none focus:border-[#362219] transition-all cursor-pointer appearance-none">
                
                <option value="">-- Semua Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400 text-[10px]">
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <span class="text-[10px] font-bold text-slate-400 italic hidden sm:inline">*Pilih untuk menyaring data otomatis</span>
    </form>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 8%">No</th>
                        <th class="py-4 px-6" style="width: 35%">Nama</th>
                        <th class="py-4 px-6" style="width: 22%">NIS</th>
                        <th class="py-4 px-6 text-center" style="width: 15%">Kelas</th>
                        <th class="py-4 px-6 text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($siswa as $i => $s)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">{{ $i + 1 }}</td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-slate-100 text-slate-500 rounded-lg flex items-center justify-center font-bold text-xs shadow-inner">
                                        {{ strtoupper(substr($s->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $s->nama }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-slate-550 font-mono tracking-wider">{{ $s->nis }}</td>
                            
                            <td class="py-4 px-7 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100/50">
                                    {{ $s->nama_kelas ?? 'Belum Set' }}
                                </span>
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="/admin/siswa/{{ $s->id }}/edit" class="p-2 bg-amber-50 text-amber-700 hover:bg-amber-500 hover:text-white rounded-xl border border-amber-200/40 transition-all text-xs" title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="/admin/siswa/{{ $s->id }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
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
                                <p class="text-slate-400 font-bold text-sm">Tidak ada data siswa ditemukan.</p>
                                <p class="text-slate-400 text-xs mt-0.5">Belum ada siswa terdaftar atau tidak cocok dengan filter kelas terpilih.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection