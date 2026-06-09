<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Kelas extends Model
{
    // 🔥 Field yang boleh diisi
    protected $fillable = [
        'nama_kelas',
        'wali_kelas'
    ];

    // 🔗 Relasi: 1 kelas punya banyak siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}