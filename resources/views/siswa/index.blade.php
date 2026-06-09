@extends('layouts.admin')

@section('content')

<h2 style="margin-bottom:20px;">👨‍🎓 Data Siswa</h2>

<a href="{{ route('siswa.create') }}" 
   style="background:#2ecc71;color:white;padding:10px 15px;border-radius:8px;text-decoration:none;">
   + Tambah Siswa
</a>

<br><br>

<table border="1" cellpadding="10" style="width:100%; border-collapse:collapse;">
    <tr style="background:#2c3e50;color:white;">
        <th>No</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

    @foreach($siswa as $i => $s)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->nis }}</td>
        <td>{{ $s->nama_kelas ?? '-' }}</td>

        <td>
            <a href="{{ route('siswa.edit', $s->id) }}"
               style="background:#3498db;color:white;padding:5px 10px;border-radius:5px;text-decoration:none;">
               Edit
            </a>

            <form action="{{ route('siswa.destroy', $s->id) }}" 
                  method="POST" 
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit"
                    style="background:#e74c3c;color:white;padding:5px 10px;border:none;border-radius:5px;">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection