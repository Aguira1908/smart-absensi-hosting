<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // =========================
    // LIST DATA ABSENSI
    // =========================
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'guru') {
            // Guru hanya bisa melihat rekap absensi dari kelas yang dibawakannya (Wali Kelas)
            $data = DB::table('ABSENSI')
                ->join('SISWA', 'ABSENSI.siswa_id', '=', 'SISWA.id')
                ->join('KELAS', 'SISWA.kelas_id', '=', 'KELAS.id')
                ->where('KELAS.guru_id', $user->id)
                ->select(
                    'ABSENSI.tanggal',
                    'ABSENSI.status',
                    'ABSENSI.jam_masuk',
                    'SISWA.nama as nama_siswa',
                    'KELAS.nama_kelas'
                )
                ->orderBy('SISWA.nama')
                ->get();

        } else {
            // Admin atau role lain bisa melihat semua
            $data = DB::table('ABSENSI')
                ->join('SISWA', 'ABSENSI.siswa_id', '=', 'SISWA.id')
                ->join('KELAS', 'SISWA.kelas_id', '=', 'KELAS.id')
                ->select(
                    'ABSENSI.tanggal',
                    'ABSENSI.status',
                    'ABSENSI.jam_masuk',
                    'SISWA.nama as nama_siswa',
                    'KELAS.nama_kelas'
                )
                ->orderBy('KELAS.nama_kelas')
                ->get();
        }

        return view('absensi.index', compact('data'));
    }

    // =========================
    // FORM INPUT ABSENSI (1 SISWA)
    // =========================
    public function create()
    {
        abort_unless(Auth::user()->role === 'guru', 403);

        $guruId = auth()->id();

        // Ambil kelas yang dibawakan oleh guru ini (Wali Kelas)
        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        $siswa = [];

        // Hanya tampilkan siswa yang menjadi anak didiknya di kelas tersebut
        if ($kelas) {
            $siswa = Siswa::where('kelas_id', $kelas->id)
                ->orderBy('nama')
                ->get();
        }

        return view('absensi.create', compact('siswa'));
    }

    // =========================
    // SIMPAN ABSENSI (1 SISWA)
    // =========================
    public function store(Request $request)
    {
        abort_unless(Auth::user()->role === 'guru', 403);

        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha,terlambat'
        ]);

        $tanggalInput = Carbon::parse($request->tanggal)->format('Y-m-d');
        $guruId = auth()->id();

        // 🔒 PROTEKSI 1: Cek apakah siswa ini benar-benar milik kelas yang dibawakan guru tersebut
        $isWaliKelas = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('siswa.id', $request->siswa_id)
            ->where('kelas.guru_id', $guruId)
            ->exists();

        if (!$isWaliKelas) {
            return back()->with('error', 'Anda bukan Wali Kelas dari siswa ini! Akses ditolak.');
        }

        // 🔒 PROTEKSI 2: Cek kuota harian (1 siswa hanya bisa absen 1 kali per hari)
        $sudahAbsen = Absensi::where('siswa_id', $request->siswa_id)
            ->whereDate('tanggal', $tanggalInput)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Siswa ini sudah melakukan absensi hari ini. Tidak boleh double absen!');
        }

        // Simpan data jika lolos semua proteksi
        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $tanggalInput,
            'status' => $request->status,
            'jam_masuk' => now(),
        ]);

        return redirect()->route('guru.absensi.index')
            ->with('success', 'Absensi siswa berhasil ditambahkan');
    }

    // =========================
    // FORM ABSENSI PER KELAS
    // =========================
    public function formKelas()
    {
        $guruId = auth()->id();

        // Hanya ambil kelas milik guru yang login
        $kelas = DB::table('kelas')
            ->where('guru_id', $guruId)
            ->first();

        $siswa = collect();

        if ($kelas) {
            $siswa = DB::table('siswa')
                ->where('kelas_id', $kelas->id)
                ->orderBy('nama')
                ->get();
        }

        return view('absensi.kelas', compact('kelas', 'siswa'));
    }

    // =========================
    // SIMPAN ABSENSI PER KELAS (MASSAL)
    // =========================
    public function storeKelas(Request $request)
    {
        abort_unless(Auth::user()->role === 'guru', 403);

        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|array'
        ]);

        $tanggalInput = Carbon::parse($request->tanggal)->format('Y-m-d');
        $guruId = auth()->id();

        DB::beginTransaction();

        try {
            foreach ($request->status as $siswa_id => $status) {

                // 🔒 PROTEKSI 1: Validasi ulang kepemilikan Wali Kelas saat looping massal
                $isWaliKelas = DB::table('siswa')
                    ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                    ->where('siswa.id', $siswa_id)
                    ->where('kelas.guru_id', $guruId)
                    ->exists();

                // Jika ada selundupan siswa dari kelas lain, lewati langsung
                if (!$isWaliKelas) {
                    continue; 
                }

                // 🔒 PROTEKSI 2: Cek kuota harian massal (jika hari ini sudah absen, skip data ganda)
                $sudahAbsen = Absensi::where('siswa_id', $siswa_id)
                    ->whereDate('tanggal', $tanggalInput)
                    ->exists();

                if ($sudahAbsen) {
                    continue; 
                }

                Absensi::create([
                    'siswa_id' => $siswa_id,
                    'tanggal' => $tanggalInput,
                    'status' => $status,
                    'jam_masuk' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('guru.absensi.index')
                ->with('success', 'Absensi kelas berhasil diproses. (Siswa yang sudah absen hari ini otomatis dilewati)');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan absensi kelas');
        }
    }

    // =========================
    // KALENDER TAHUN & DETAIL
    // =========================
    public function kalenderTahun(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        $libur = DB::table('LIBUR')
            ->whereYear('tanggal', $tahun)
            ->get()
            ->keyBy(function ($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d');
            });

        return view('admin.kalender_tahun', compact('tahun', 'libur'));
    }

    public function detailTanggal($tanggal)
    {
        $data = DB::table('absensi')
            ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
            ->whereDate('tanggal', $tanggal)
            ->select('siswa.nama', 'absensi.status')
            ->get();

        return view('admin.kalender_detail', compact('data', 'tanggal'));
    }

    // =========================
    // ADMIN - LAPORAN
    // =========================
    public function laporanKelas(Request $request)
    {
        $kelasId = $request->kelas_id;
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $semuaKelas = DB::table('kelas')
            ->orderBy('nama_kelas')
            ->get();

        $data = collect();

        if ($kelasId) {
            $data = DB::table('absensi')
                ->join('siswa', 'absensi.siswa_id', '=', 'siswa.id')
                ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                ->select(
                    'siswa.nama',
                    'kelas.nama_kelas',
                    'absensi.status',
                    'absensi.tanggal'
                )
                ->where('kelas.id', $kelasId)
                ->whereMonth('absensi.tanggal', $bulan)
                ->whereYear('absensi.tanggal', $tahun)
                ->orderBy('absensi.tanggal', 'desc')
                ->get();
        }

        return view('admin.laporan_kelas', compact(
            'data',
            'semuaKelas',
            'kelasId',
            'bulan',
            'tahun'
         ));
    }
}