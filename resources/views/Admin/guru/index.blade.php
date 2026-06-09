@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-sm border border-black/5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 px-2 py-0.5 rounded border border-white/5">Fungsionaris Sekolah</span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Kelola Data Guru</h1>
                <p class="text-amber-100/70 text-xs mt-0.5">Daftar tenaga pendidik aktif di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="shrink-0">
                <a href="{{ url('/admin/guru/create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black shadow-sm hover:shadow transition-all duration-150 cursor-pointer">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>+ Tambah Guru</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 8%">No</th>
                        <th class="py-4 px-6" style="width: 42%">Nama Pengajar</th>
                        <th class="py-4 px-6" style="width: 30%">Alamat Email</th>
                        <th class="py-4 px-6 text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($guru as $g)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">
                                {{ $loop->iteration }}
                            </td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-amber-50 text-amber-800 rounded-lg flex items-center justify-center font-black text-xs border border-amber-200/30 shadow-inner">
                                        {{ strtoupper(substr($g->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $g->name }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-slate-500 font-semibold truncate max-w-xs">
                                <i class="fa-regular fa-envelope mr-1.5 text-slate-400"></i>{{ $g->email }}
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    
                                    <a href="/admin/guru/{{ $g->id }}/edit" class="p-2 bg-amber-50 text-amber-700 hover:bg-amber-500 hover:text-white rounded-xl border border-amber-200/40 transition-all text-xs" title="Edit Profil Guru">
                                        <i class="fa-solid fa-user-pen"></i>
                                    </a>

                                    <form action="/admin/guru/{{ $g->id }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')" class="p-2 bg-rose-50 text-rose-700 hover:bg-rose-600 hover:text-white rounded-xl border border-rose-200/40 transition-all text-xs cursor-pointer" title="Hapus Data">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 px-6 text-center">
                                <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-chalkboard-user"></i></div>
                                <p class="text-slate-400 font-bold text-sm">Belum ada data guru terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection