<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'kelas_id',
        'orangtua_id',
        'foto',
        'qr_code',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function orangtua()
    {
        return $this->belongsTo(User::class, 'orangtua_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function poin()
    {
        return $this->hasOne(Poin::class);
    }
}