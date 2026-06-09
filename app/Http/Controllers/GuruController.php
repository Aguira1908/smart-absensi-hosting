<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GuruController extends Controller
{
    // =========================
    // DASHBOARD GURU
    // =========================
    public function dashboard()
    {
        $today = Carbon::today();
        $guruId = Auth::id();

        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        // default value (anti error)
        $siswa = collect();
        $data = collect();
        $totalSiswa = 0;
        $hadir = 0;
        $izin = 0;
        $sakit = 0;
        $alpha = 0;
        $progress = 0;

        if ($kelas) {

            // ambil siswa
            $siswa = DB::table('siswa')
                ->where('kelas_id', $kelas->id)
                ->get();

            $totalSiswa = $siswa->count();

            // ambil absensi hari ini
            $absensi = DB::table('absensi')
                ->whereDate('tanggal', $today)
                ->whereIn('siswa_id', $siswa->pluck('id'))
                ->get()
                ->keyBy('siswa_id');

            $hadir = $absensi->where('status', 'hadir')->count();
            $izin  = $absensi->where('status', 'izin')->count();
            $sakit = $absensi->where('status', 'sakit')->count();

            $alpha = $totalSiswa - ($hadir + $izin + $sakit);

            $data = $siswa->map(function ($s) use ($absensi) {
                return (object)[
                    'nama' => $s->nama,
                    'status' => $absensi[$s->id]->status ?? 'alpha'
                ];
            });

            $progress = $totalSiswa > 0
                ? round(($hadir / $totalSiswa) * 100)
                : 0;
        }

        return view('guru.dashboard', compact(
            'kelas',
            'data',
            'totalSiswa',
            'hadir',
            'izin',
            'sakit',
            'alpha',
            'progress'
        ));
    }

    // =========================
    // LIST GURU (ADMIN)
    // =========================
    public function index()
    {
        $guru = DB::table('users')
            ->where('role', 'guru')
            ->get();

        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru'
        ]);

        return redirect('/admin/guru')->with('success', 'Guru berhasil ditambah');
    }

    public function edit($id)
    {
        $guru = DB::table('users')->where('id', $id)->first();
        $kelas = DB::table('kelas')->get();

        return view('admin.guru.edit', compact('guru', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        // reset kelas lama
        DB::table('kelas')->where('guru_id', $id)->update([
            'guru_id' => null
        ]);

        // set kelas baru
        if ($request->kelas_id) {
            DB::table('kelas')
                ->where('id', $request->kelas_id)
                ->update([
                    'guru_id' => $id
                ]);
        }

        return redirect('/admin/guru')->with('success', 'Data guru diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/admin/guru')->with('success', 'Guru dihapus');
    }

    // =========================
    // MENU LAPORAN
    // =========================
    public function laporan()
    {
        return view('guru.laporan');
    }

    // =========================
    // LAPORAN BULANAN
    // =========================
    public function laporanBulanan(Request $request)
    {
        $guruId = Auth::id();

        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        $bulan = $request->bulan;

        $data = collect();

        if ($kelas && $bulan) {
            $data = DB::table('absensi')
                ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
                ->where('siswa.kelas_id', $kelas->id)
                ->whereMonth('absensi.tanggal', $bulan)
                ->select('siswa.nama', 'absensi.status', 'absensi.tanggal')
                ->orderBy('absensi.tanggal', 'desc')
                ->get();
        }

        return view('guru.laporan_bulanan', compact('data', 'bulan'));
    }

    // =========================
    // LAPORAN PER SISWA
    // =========================
    public function laporanSiswa(Request $request)
    {
        $guruId = Auth::id();

        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        $siswa = collect();
        $data = collect();

        if ($kelas) {
            $siswa = DB::table('siswa')
                ->where('kelas_id', $kelas->id)
                ->orderBy('nama')
                ->get();
        }

        if ($request->siswa_id) {
            $data = DB::table('absensi')
                ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
                ->where('siswa.id', $request->siswa_id)
                ->orderBy('tanggal', 'desc')
                ->get();
        }

        return view('guru.laporan_siswa', compact('siswa', 'data'));
    }
}