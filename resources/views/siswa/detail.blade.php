<div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-xl shadow">

    <!-- 🔥 HEADER -->
    <h2 class="text-2xl font-bold mb-4">Detail Anak</h2>

    <div class="mb-4">
        <p><b>Nama:</b> {{ $siswa->nama }}</p>
        <p><b>NIS:</b> {{ $siswa->nis }}</p>
    </div>

    <!-- 🔥 TAB BUTTON -->
    <div class="flex gap-3 mb-4">
        <button onclick="showTab('absensi')" class="px-4 py-2 bg-blue-500 text-white rounded">
            Kehadiran
        </button>
        <button onclick="showTab('nilai')" class="px-4 py-2 bg-gray-300 rounded">
            Nilai
        </button>
        <button onclick="showTab('info')" class="px-4 py-2 bg-gray-300 rounded">
            Info
        </button>
    </div>

    <!-- 🔥 TAB KEHADIRAN -->
    <div id="absensi">
        <h3 class="font-bold mb-2">Kehadiran</h3>

        <table class="w-full border">
            <tr class="bg-gray-200">
                <th class="p-2">Tanggal</th>
                <th class="p-2">Status</th>
            </tr>

            @forelse($absensi as $a)
            <tr>
                <td class="p-2">{{ $a->tanggal }}</td>
                <td class="p-2">
                    @if($a->status == 'hadir')
                        <span class="text-green-600 font-semibold">Hadir</span>
                    @elseif($a->status == 'izin')
                        <span class="text-blue-600 font-semibold">Izin</span>
                    @elseif($a->status == 'sakit')
                        <span class="text-yellow-600 font-semibold">Sakit</span>
                    @elseif($a->status == 'terlambat')
                        <span class="text-red-600 font-semibold">Terlambat</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center p-3">Belum ada data</td>
            </tr>
            @endforelse
        </table>
    </div>

    <!-- 🔥 TAB NILAI -->
    <div id="nilai" style="display:none;">
        <h3 class="font-bold mb-2">Nilai</h3>
        <p>Belum ada data nilai</p>
    </div>

    <!-- 🔥 TAB INFO -->
    <div id="info" style="display:none;">
        <h3 class="font-bold mb-2">Info Lengkap</h3>

        <p><b>Nama:</b> {{ $siswa->nama }}</p>
        <p><b>NIS:</b> {{ $siswa->nis }}</p>
        <p><b>Kelas:</b> {{ $siswa->kelas ?? '-' }}</p>
    </div>

</div>

<!-- 🔥 SCRIPT TAB -->
<script>
function showTab(tab) {
    document.getElementById('absensi').style.display = 'none';
    document.getElementById('nilai').style.display = 'none';
    document.getElementById('info').style.display = 'none';

    document.getElementById(tab).style.display = 'block';
}
</script>