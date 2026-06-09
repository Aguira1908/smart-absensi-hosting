<h2>Tambah Siswa</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/admin/siswa') }}" method="POST">
    @csrf

    <p>Nama:</p>
    <input type="text" name="nama" required>

    <p>NIS:</p>
    <input type="text" name="nis" required>

    <p>Kelas:</p>
    <select name="kelas_id" required>
        <option value="">-- Pilih Kelas --</option>
        @foreach($kelas as $k)
            <option value="{{ $k->id }}">
                {{ $k->nama_kelas }}
            </option>
        @endforeach
    </select>

    <label>Orang Tua</label>
<select name="orangtua_id" required>
    <option value="">-- Pilih Orang Tua --</option>
    @foreach($orangtua as $o)
        <option value="{{ $o->id }}">{{ $o->name }}</option>
    @endforeach
</select>

    <br><br>

    <button type="submit">Simpan</button>
</form>