@extends('layouts.guru')

@section('content')

<div style="max-width:1000px;margin:auto;">

<h2>👋 Halo, {{ Auth::user()->name }}</h2>
<p style="color:gray;">Pantau kehadiran anak Anda di sini</p>

<style>
.grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(150px,1fr));
    gap:10px;
    margin-bottom:20px;
}
.card {
    padding:15px;
    border-radius:10px;
    color:white;
    text-align:center;
    font-weight:bold;
}
.hadir { background:#2ecc71; }
.izin { background:#f1c40f; }
.sakit { background:#e67e22; }
.alpha { background:#e74c3c; }

.table {
    width:100%;
    border-collapse:collapse;
    background:white;
}
.table th {
    background:#2c3e50;
    color:white;
}
.table th, .table td {
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

.alpha-row {
    background:#ffe6e6;
    color:red;
    font-weight:bold;
}
</style>

@if(!$siswa)
    <p style="color:red;">Data anak tidak ditemukan</p>
@else

<!-- 🔥 DATA ANAK -->
<h3>👶 Data Anak</h3>
<p><b>Nama:</b> {{ $siswa->nama }}</p>

<br>

<!-- 🔥 STATS -->
<div class="grid">
    <div class="card hadir">Hadir<br>{{ $hadir }}</div>
    <div class="card izin">Izin<br>{{ $izin }}</div>
    <div class="card sakit">Sakit<br>{{ $sakit }}</div>
    <div class="card alpha">Alpha<br>{{ $alpha }}</div>
</div>

<!-- 🔥 RIWAYAT -->
<h3>📋 Riwayat Absensi</h3>

<table class="table">
<tr>
    <th>Tanggal</th>
    <th>Status</th>
</tr>

@foreach($riwayat as $r)
<tr class="{{ $r->status == 'alpha' ? 'alpha-row' : '' }}">
    <td>{{ $r->tanggal }}</td>
    <td>{{ strtoupper($r->status) }}</td>
</tr>
@endforeach

</table>

@endif

</div>

@endsection