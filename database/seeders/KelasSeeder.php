<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            DB::table('kelas')->insert([
                'nama_kelas' => 'Kelas ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}