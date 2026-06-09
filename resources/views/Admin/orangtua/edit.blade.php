@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <a href="/admin/orangtua" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-500 hover:text-[#362219] transition-colors bg-white px-3 py-2 rounded-xl border border-slate-100 shadow-sm">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Data Orang Tua</span>
        </a>
        <span class="text-xs font-bold text-slate-400">Pembaruan Berkas Wali</span>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        
        <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex items-center space-x-3">
            <div class="w-10 h-10 bg-[#362219] text-white rounded-xl flex items-center justify-center text-sm shadow-md">
                <i class="fa-solid fa-user-pen"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-slate-800 tracking-tight">Edit Data Orang Tua</h2>
                <p class="text-[11px] text-slate-400">Perbarui informasi nama atau alamat email relasi wali murid aktif di SDN 118198 Sei Piandang.</p>
            </div>
        </div>

        <div class="p-6 md:p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-xl flex items-start space-x-3 text-rose-700">
                    <div class="text-base mt-0.5"><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class="space-y-1">
                        <p class="text-xs font-black uppercase tracking-wider">Periksa Kembali Isian Anda:</p>
                        <ul class="list-disc list-inside text-xs font-medium space-y-0.5 opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="/admin/orangtua/{{ $data->id }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Wali / Orang Tua</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="name" value="{{ $data->name }}" required placeholder="Masukkan nama wali murid"
                                   class="w-full bg-slate-50/50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Alamat Email Sesi aktif</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 text-xs"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" value="{{ $data->email }}" required placeholder="contoh@surat.com"
                                   class="w-full bg-slate-50/50 border border-slate-200 text-slate-800 py-2.5 pl-10 pr-4 rounded-xl text-xs font-bold focus:outline-none focus:bg-white focus:border-[#362219] focus:ring-4 focus:ring-[#362219]/5 transition-all">
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5 mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-[#362219] hover:bg-[#4A352B] text-white text-xs font-black shadow-md hover:shadow-lg transition-all duration-150 cursor-pointer">
                        <i class="fa-solid fa-rotate mr-1 text-xs"></i>
                        <span>Perbarui Akun Wali</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection