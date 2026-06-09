<!DOCTYPE html>
<html>
<head>
    <title>Laporan Siswa</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>

<h2>Laporan Data Siswa</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $key => $s)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->kelas ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>