<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua kelas dan wali murid
        $kelas = Kelas::orderBy('id')->get();
        $parents = User::where('role', 'orang_tua')->orderBy('id')->get();

        if ($kelas->isEmpty() || $parents->isEmpty()) {
            return;
        }

        // Daftar nama siswa untuk demo data yang rapi dan realistis
        $studentNames = [
            'Ahmad Ridho',
            'Bunga Citra',
            'Candra Wijaya',
            'Dinda Kirana',
            'Eko Prasetyo',
            'Fitri Handayani',
            'Gilang Dirga',
            'Hani Rahmawati',
            'Indra Herlambang',
            'Julia Perez',
            'Kevin Sanjaya',
            'Larasati Indah',
        ];

        foreach ($studentNames as $index => $name) {
            // Distribusikan: 2 siswa per kelas, dan 2 siswa per orang tua
            $classIndex = floor($index / 2) % $kelas->count();
            $parentIndex = floor($index / 2) % $parents->count();

            $currentKelas = $kelas->get($classIndex);
            $currentParent = $parents->get($parentIndex);
            
            $nis = '1234567' . str_pad($index + 1, 2, '0', STR_PAD_LEFT);

            // Buat siswa
            $siswa = Siswa::create([
                'nama' => $name,
                'nis' => $nis,
                'kelas_id' => $currentKelas->id,
                'orangtua_id' => $currentParent->id,
                'foto' => null,
                'qr_code' => 'QR-' . $nis,
            ]);

            // Hubungkan di tabel pivot parent_student
            DB::table('parent_student')->insert([
                'user_id' => $currentParent->id,
                'siswa_id' => $siswa->id,
            ]);
        }
    }
}
