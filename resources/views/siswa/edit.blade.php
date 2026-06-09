<h2>Edit Siswa</h2>

<form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama" value="{{ $siswa->nama }}"><br>
    <input type="text" name="nis" value="{{ $siswa->nis }}"><br>

    <select name="kelas_id">
        @foreach($kelas as $k)
            <option value="{{ $k->id }}"
                {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kelas }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>