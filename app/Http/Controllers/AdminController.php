<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function index()
    {
        if (!Auth::check()) return redirect('/login');

        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $totalSiswa = DB::table('siswa')->count();
        $totalKelas = DB::table('kelas')->count();
        $totalUser  = DB::table('users')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalKelas',
            'totalUser'
        ));
    }

public function dashboardStats()
{
    $today = Carbon::today();
    $bulan = date('m');
    $tahun = date('Y');

    // 🔥 PER HARI (hari ini)
    $harian = DB::table('absensi')
        ->select('status', DB::raw('COUNT(*) as total'))
        ->whereDate('tanggal', $today)
        ->groupBy('status')
        ->pluck('total', 'status');

    // 🔥 PER BULAN (per hari dalam 1 bulan)
    $bulanan = DB::table('absensi')
        ->select(
            DB::raw('EXTRACT(DAY FROM tanggal) as hari'),
            DB::raw("COUNT(CASE WHEN status='hadir' THEN 1 END) as hadir")
        )
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->groupBy(DB::raw('EXTRACT(DAY FROM tanggal)'))
        ->orderBy('hari')
        ->get();

    return view('admin.dashboard_stats', [
        'harian' => $harian,
        'bulanan' => $bulanan
    ]);
}

    // =========================
    // 📅 KALENDER TAHUNAN
    // =========================
    public function kalenderTahunan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        // 🔥 sementara kosong biar gak error
        $libur = collect();

        return view('admin.kalender_tahun', compact('tahun', 'libur'));
    }

    // =========================
    // 📅 DETAIL TANGGAL
    // =========================
    public function detailTanggal($tanggal)
    {
        $data = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.nama',
                'kelas.nama_kelas',
                'absensi.status',
                'absensi.jam_masuk'
            )
            ->whereDate('absensi.tanggal', $tanggal)
            ->orderBy('kelas.nama_kelas')
            ->orderBy('siswa.nama')
            ->get();

        return view('admin.detail_tanggal', compact('data', 'tanggal'));
    }

    // =========================
    // 🏆 SISWA RAJIN
    // =========================
    public function siswaRajin()
    {
        $data = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.nama',
                'kelas.nama_kelas',
                DB::raw("COUNT(CASE WHEN absensi.status = 'hadir' THEN 1 END) as hadir"),
                DB::raw("COUNT(*) as total"),
                DB::raw("
                    CASE 
                        WHEN COUNT(*) = 0 THEN 0
                        ELSE ROUND((COUNT(CASE WHEN absensi.status = 'hadir' THEN 1 END) / COUNT(*)) * 100, 2)
                    END as persen
                ")
            )
            ->groupBy('siswa.nama','kelas.nama_kelas')
            ->orderByDesc('persen')
            ->limit(10)
            ->get();

        return view('admin.siswa_rajin', compact('data'));
    }

    // =========================
    // 🐌 SISWA MALAS
    // =========================
    public function siswaMalas()
    {
        $data = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.nama',
                'kelas.nama_kelas',
                DB::raw("COUNT(CASE WHEN absensi.status != 'hadir' THEN 1 END) as tidak_hadir"),
                DB::raw("COUNT(*) as total"),
                DB::raw("
                    CASE 
                        WHEN COUNT(*) = 0 THEN 0
                        ELSE ROUND((COUNT(CASE WHEN absensi.status != 'hadir' THEN 1 END) / COUNT(*)) * 100, 2)
                    END as persen
                ")
            )
            ->groupBy('siswa.nama','kelas.nama_kelas')
            ->orderByDesc('persen')
            ->limit(10)
            ->get();

        return view('admin.siswa_malas', compact('data'));
    }
}