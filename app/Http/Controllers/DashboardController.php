<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔥 REDIRECT ADMIN KE ADMIN PANEL
        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        // 🔥 DASHBOARD ORANG TUA
        $siswa = DB::table('parent_student')
            ->join('siswa', 'parent_student.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('parent_student.user_id', $user->id)
            ->select([
                'siswa.*',
                'kelas.nama_kelas as kelas'
            ])
            ->get();

        return view('dashboard', compact('siswa'));
    }

    public function detail(int $id)
    {
        $siswa = DB::table('siswa')->where('id', $id)->first();

        $absensi = DB::table('absensis')
            ->where('siswa_id', $id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siswa.detail', compact('siswa', 'absensi'));
    }
}