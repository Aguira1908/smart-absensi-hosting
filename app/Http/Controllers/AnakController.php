<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AnakController extends Controller
{
    public function show($id)
    {
        $user = auth()->user();

        $siswa = DB::table('parent_student')
            ->join('siswa', 'parent_student.siswa_id', '=', 'siswa.id')
            ->where('parent_student.user_id', $user->id)
            ->where('siswa.id', $id)
            ->select('siswa.*')
            ->first();

        // ❌ kalau bukan anak dia → blok akses
        if (!$siswa) {
            abort(403);
        }

        // 🔥 sementara (nanti bisa ambil dari database)
        $kehadiran = "95%";
        $nilai = "88";

        return view('anak.detail', compact('siswa', 'kehadiran', 'nilai'));
    }
}