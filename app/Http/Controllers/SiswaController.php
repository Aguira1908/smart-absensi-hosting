<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    // =========================
    // 🔥 TAMPIL DATA SISWA (LOGIKA FIXED)
    // =========================
    public function index(Request $request)
    {
        // 1. Ambil ID kelas dari parameter URL filter (?kelas_id=X)
        $kelas_id = $request->kelas_id;

        // 2. Ambil semua list kelas untuk isi dropdown filter
        $kelas = DB::table('kelas')->orderBy('nama_kelas')->get();
        
        $kelasAktif = null;
        if ($kelas_id) {
            $kelasAktif = DB::table('kelas')->where('id', $kelas_id)->first();
        }

        // 3. Bangun query dasar untuk menarik data siswa beserta join-nya
        $query = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->leftJoin('users', 'siswa.orangtua_id', '=', 'users.id')
            ->select(
                'siswa.id',
                'siswa.nama',
                'siswa.nis',
                'siswa.kelas_id',
                'siswa.orangtua_id',
                'kelas.nama_kelas',
                'users.name as nama_orangtua'
            );

        // 4. JIKA ADA FILTER KELAS, saring data berdasarkan id kelas yang dikirim
        if ($kelas_id) {
            $query->where('siswa.kelas_id', $kelas_id);
        }

        // 5. Eksekusi pengasapan data ke database
        $siswa = $query->orderBy('siswa.id', 'desc')->get();

        // 6. Return view tunggal di bagian paling akhir agar semua variabel terbaca utuh
        return view('admin.siswa.index', compact('siswa', 'kelas', 'kelas_id', 'kelasAktif'));
    }

    // =========================
    // 🔥 FORM TAMBAH
    // =========================
    public function create()
    {
        $kelas = DB::table('kelas')->get();

        $orangtua = DB::table('users')
            ->where('role', 'orang_tua')
            ->get();

        return view('admin.siswa.create', compact('kelas', 'orangtua'));
    }

    // =========================
    // 🔥 STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'orangtua_id' => 'required|exists:users,id'
        ]);

        DB::table('siswa')->insert([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'orangtua_id' => $request->orangtua_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/admin/siswa')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    // =========================
    // 🔥 EDIT
    // =========================
    public function edit($id)
    {
        $siswa = DB::table('siswa')->where('id', $id)->first();
        $kelas = DB::table('kelas')->get();
        $orangtua = DB::table('users')->where('role', 'orang_tua')->get();

        return view('admin.siswa.edit', compact('siswa', 'kelas', 'orangtua'));
    }

    // =========================
    // 🔥 UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'orangtua_id' => 'required|exists:users,id'
        ]);

        DB::table('siswa')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'orangtua_id' => $request->orangtua_id,
                'updated_at' => now()
            ]);

        return redirect('/admin/siswa')
            ->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // 🔥 DELETE
    // =========================
    public function destroy($id)
    {
        DB::table('siswa')->where('id', $id)->delete();

        return redirect('/admin/siswa')
            ->with('success', 'Data berhasil dihapus');
    }
}