@extends('layouts.app') {{-- Sesuaikan nama file layout utama orang tua/umum kamu --}}

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-4 sm:px-6">

    <div class="bg-gradient-to-r from-[#1E3A8A] to-[#3B82F6] rounded-2xl p-6 text-white shadow-md border border-blue-900/10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 border border-white/5 backdrop-blur-sm">
                    <i class="fa-solid fa-users-viewfinder mr-1.5"></i>Akses Orang Tua / Wali
                </span>
                <h1 class="text-xl font-extrabold tracking-tight mt-1">Dashboard Utama Wali Murid</h1>
                <p class="text-blue-100/70 text-xs mt-0.5">Pantau terus perkembangan kehadiran dan log presensi harian anak Anda di <span class="font-bold text-white">SDN 118198 Sei Piandang</span>.</p>
            </div>
            
            <div class="shrink-0 text-left sm:text-right">
                <span class="text-[9px] font-black text-amber-400 uppercase tracking-widest block">Sesi Terverifikasi</span>
                <span class="text-xs font-bold text-white/90">
                    <i class="fa-regular fa-clock mr-1.5 text-amber-400"></i>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-blue-900 text-xs"><i class="fa-solid fa-children"></i></span>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-wider">Daftar Anak Didik (Tanggungan Anda)</h3>
            </div>
            <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/50">
                Tahun Ajaran 2026/2027
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-black text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6 text-center" style="width: 8%">No</th>
                        <th class="py-4 px-6" style="width: 45%">Nama Lengkap Anak</th>
                        <th class="py-4 px-6 text-center" style="width: 17%">NIS</th>
                        <th class="py-4 px-6 text-center" style="width: 15%">Kelas</th>
                        <th class="py-4 px-6 text-center" style="width: 15%">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs sm:text-sm text-slate-600 font-medium">
                    @forelse($siswa as $index => $anak)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            
                            <td class="py-4 px-6 font-extrabold text-slate-800">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-700 rounded-lg flex items-center justify-center font-black text-xs border border-blue-100/30 shadow-inner">
                                        {{ strtoupper(substr($anak->nama, 0, 1)) }}
                                    </div>
                                    <span>{{ $anak->nama }}</span>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 text-center text-slate-500 font-mono tracking-wider font-semibold">
                                {{ $anak->nis ?? '-' }}
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100/50">
                                    {{ str_contains(strtolower($anak->kelas), 'kelas') ? $anak->kelas : 'Kelas ' . $anak->kelas }}
                                </span>
                            </td>

                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('anak.detail', $anak->id) }}" 
                                   class="inline-flex items-center space-x-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-200/60 hover:border-blue-600 rounded-xl text-xs font-black tracking-tight transition-all shadow-sm cursor-pointer">
                                    <span>Lihat Log</span>
                                    <i class="fa-solid fa-arrow-right-long text-[10px] mt-0.5"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 px-6 text-center">
                                <div class="text-slate-300 text-4xl mb-2"><i class="fa-solid fa-baby-carriage"></i></div>
                                <p class="text-slate-400 font-bold text-sm">Belum ada data anak tertaut.</p>
                                <p class="text-slate-400 text-xs mt-0.5">Silakan hubungi operator sekolah untuk mengaitkan NIK/NIS anak ke akun Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection