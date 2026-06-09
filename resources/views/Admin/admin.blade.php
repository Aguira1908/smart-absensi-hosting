@extends('layouts.admin')

@section('content')

<h2 style="margin-bottom:20px;">📊 Dashboard Admin</h2>

<style>
.grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
    gap:15px;
    margin-bottom:25px;
}

.card {
    padding:20px;
    border-radius:12px;
    color:white;
    font-weight:bold;
    text-align:center;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.blue { background:#3498db; }
.green { background:#2ecc71; }
.yellow { background:#f1c40f; color:black; }
.purple { background:#9b59b6; }

.actions {
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}

.btn {
    padding:10px 15px;
    border-radius:8px;
    color:white;
    text-decoration:none;
    font-weight:bold;
    transition:0.2s;
}

.btn:hover {
    opacity:0.85;
}

.btn-blue { background:#3498db; }
.btn-green { background:#2ecc71; }
.btn-yellow { background:#f1c40f; color:black; }
.btn-purple { background:#9b59b6; }

.info {
    margin-top:20px;
    padding:15px;
    background:#ecf0f1;
    border-radius:10px;
}
</style>

<!-- 🔥 CARD RINGKAS -->
<div class="grid">

    <div class="card blue">
        👨‍🎓 Data Siswa
    </div>

    <div class="card green">
        👨‍🏫 Data Guru
    </div>

    <div class="card yellow">
        📋 Absensi
    </div>

    <div class="card purple">
        📊 Laporan
    </div>

</div>

<!-- 🔥 ACTION BUTTON -->
<div class="actions">

    <a href="{{ url('/admin/siswa') }}" class="btn btn-blue">
        Data Siswa
    </a>

    <a href="{{ url('/admin/siswa/create') }}" class="btn btn-green">
        + Tambah Siswa
    </a>

    <a href="{{ url('/admin/absensi') }}" class="btn btn-yellow">
        Data Absensi
    </a>

    <a href="{{ url('/admin/laporan/kelas') }}" class="btn btn-purple">
        Laporan Kelas
    </a>

</div>

<!-- 🔥 INFO -->
<div class="info">
    <p><strong>📌 Info:</strong></p>
    <p>Dashboard ini digunakan untuk mengelola seluruh data sekolah seperti siswa, guru, dan absensi.</p>
</div>

@endsection