<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 1. Seed Admin
    User::forceCreate([
      'name' => 'Admin Smart Absensi',
      'email' => 'admin@sekolah.com',
      'password' => Hash::make('password123'),
      'role' => 'admin',
      'email_verified_at' => now(),
    ]);

    // 2. Seed Guru (Teachers) - 6 Guru
    for ($i = 1; $i <= 6; $i++) {
      User::forceCreate([
        'name' => 'Guru Kelas ' . $i,
        'email' => 'guru' . $i . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'guru',
        'email_verified_at' => now(),
      ]);
    }

    // 3. Seed Orang Tua (Parents) - 6 Parents
    for ($i = 1; $i <= 6; $i++) {
      User::forceCreate([
        'name' => 'Orang Tua Siswa ' . $i,
        'email' => 'ortu' . $i . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'orang_tua',
        'email_verified_at' => now(),
      ]);
    }
  }
}
