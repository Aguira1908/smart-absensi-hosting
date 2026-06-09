<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrangTuaController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        $user = Auth::user();
        $userId = $user->id;

        $anak = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nis',
                'kelas.nama_kelas as kelas'
            )
            ->where('siswa.orangtua_id', $userId)
            ->get();

        $data = $anak->map(function ($s) {

            $hadir = DB::table('ABSENSI')
                ->where('siswa_id', $s->id)
                ->where('status', 'hadir')
                ->count();

            $izin = DB::table('ABSENSI')
                ->where('siswa_id', $s->id)
                ->where('status', 'izin')
                ->count();

            $sakit = DB::table('ABSENSI')
                ->where('siswa_id', $s->id)
                ->where('status', 'sakit')
                ->count();

            $alpha = DB::table('ABSENSI')
                ->where('siswa_id', $s->id)
                ->where('status', 'alpha')
                ->count();

            $total = $hadir + $izin + $sakit + $alpha;

            return (object)[
                'id' => $s->id,
                'nama' => $s->nama,
                'nis' => $s->nis,
                'kelas' => $s->kelas,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpha' => $alpha,
                'progress' => $total > 0 ? round(($hadir / $total) * 100) : 0
            ];
        });

        return view('orangtua.dashboard', compact('data', 'user'));
    }

    // =========================
    // BERANDA (🔥 INI YANG TADI HILANG)
    // =========================
    public function beranda()
    {
        $userId = Auth::id();

        $data = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nis',
                'kelas.nama_kelas as kelas'
            )
            ->where('siswa.orangtua_id', $userId)
            ->get();

        return view('orangtua.beranda', compact('data'));
    }

    // =========================
    // RIWAYAT
    // =========================
    public function riwayat()
    {
        $userId = Auth::id();

        $data = DB::table('ABSENSI')
            ->join('siswa', 'ABSENSI.siswa_id', '=', 'siswa.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('siswa.orangtua_id', $userId)
            ->select(
                'siswa.nama',
                'kelas.nama_kelas as kelas',
                'ABSENSI.status',
                'ABSENSI.created_at'
            )
            ->orderBy('ABSENSI.created_at', 'desc')
            ->get();

        return view('orangtua.riwayat', compact('data'));
    }

    // =========================
    // ADMIN CRUD ORANG TUA
    // =========================
    public function index()
    {
        $data = DB::table('users')
            ->where('role', 'orang_tua')
            ->orderBy('name')
            ->get();

        return view('admin.orangtua.index', compact('data'));
    }

    public function create()
    {
        return view('admin.orangtua.create');
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
            'role' => 'orang_tua',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/orangtua')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.orangtua.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,$id"
        ]);

        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ]);

        return redirect('/admin/orangtua')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:5|confirmed'
        ]);

        DB::table('users')->where('id', Auth::id())->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
}