@extends('layouts.admin')

@section('content')

<h2>📅 Detail Absensi Tanggal {{ $tanggal }}</h2>

<a href="/admin/kalender-tahun">⬅ Kembali</a>

<br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Status</th>
        <th>Jam Masuk</th>
    </tr>

    @forelse($data as $i => $d)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->nama_kelas }}</td>
        <td>{{ $d->status }}</td>
        <td>{{ $d->jam_masuk }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Tidak ada data absensi</td>
    </tr>
    @endforelse

</table>

@endsection