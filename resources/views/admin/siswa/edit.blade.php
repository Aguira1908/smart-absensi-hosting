@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="/admin/siswa" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-[#362219] transition-colors bg-white px-3 py-2 rounded-xl border border-slate-100 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Data Siswa</span>
        </a>
        <span class="text-xs font-bold text-slate-400">Formulir Edit</span>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        
        <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex items-center space-x-3">
            <div class="w-10 h-10 bg-[#362219] text-white rounded-xl flex items-center justify-center text-sm shadow-md">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-slate-800 tracking-tight">Edit Data Siswa</h2>
                <p class="text-[11px] text-slate-400">Perbarui data siswa dan sesuaikan tautan dengan akun orang tua di SDN 118198 Sei Piandang.</p>
            </div>
        </div>

        <div class="p-6 md:p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-xl flex items-start space-x-3 text-rose-700">
                    <div class="text-base mt-0.5"><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class="space-y-1">
                        <p class="text-xs font-black uppercase tracking-wider">Gagal Menyimpan Data:</p>
                        <ul class="list-disc list-inside text-xs font-medium space-y-0.5 opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Lengkap Siswa</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nama" required value="{{ old('nama', $siswa->nama) }}" placeholder="Masukkan nama lengkap siswa"
                                   class="w-full bg-slate-50/50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold placeholder:text-slate-400 placeholder:font-medium focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nomor Induk Siswa (NIS)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-id-card"></i></span>
                            <input type="text" name="nis" required value="{{ old('nis', $siswa->nis) }}" placeholder="Contoh: 235290"
                                   class="w-full bg-slate-50/50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold font-mono tracking-wider placeholder:text-slate-400 placeholder:font-medium focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Pilih Rombongan Belajar (Kelas)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-school"></i></span>
                            <select name="kelas_id" required
                                    class="w-full bg-slate-50/50 border border-slate-200 text-slate-700 py-2.5 pl-10 pr-10 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all cursor-pointer appearance-none">
                                <option value="" class="font-medium text-slate-400">-- Pilih Kelas --</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>Kelas {{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400 text-[10px]">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Wali / Orang Tua Siswa</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-users"></i></span>
                            <select name="orangtua_id" required
                                    class="w-full bg-slate-50/50 border border-slate-200 text-slate-700 py-2.5 pl-10 pr-10 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all cursor-pointer appearance-none">
                                <option value="" class="font-medium text-slate-400">-- Pilih Orang Tua --</option>
                                @foreach($orangtua as $o)
                                    <option value="{{ $o->id }}" {{ old('orangtua_id', $siswa->orangtua_id) == $o->id ? 'selected' : '' }}>{{ $o->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400 text-[10px]">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5 mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-[#362219] hover:bg-[#4A352B] text-white text-xs font-black shadow-md hover:shadow-lg transition-all duration-150 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection