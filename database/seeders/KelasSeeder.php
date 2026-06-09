<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua guru yang sudah di-seed
        $gurus = User::where('role', 'guru')->orderBy('id')->get();

        for ($i = 1; $i <= 6; $i++) {
            // Dapatkan guru yang bersesuaian jika ada
            $guru = $gurus->get($i - 1);

            Kelas::create([
                'nama_kelas' => 'Kelas ' . $i,
                'wali_kelas' => $guru ? $guru->name : null,
                'guru_id' => $guru ? $guru->id : null,
            ]);
        }
    }
}