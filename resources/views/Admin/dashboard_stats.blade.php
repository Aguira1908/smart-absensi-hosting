@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    
    <div class="bg-gradient-to-r from-[#362219] to-[#59483E] rounded-2xl p-6 text-white shadow-sm border border-black/5">
        <div>
            <span class="text-[10px] font-black uppercase tracking-widest bg-white/10 text-amber-300 px-2 py-0.5 rounded border border-white/5">Analitik Sekolah</span>
            <h1 class="text-xl font-extrabold tracking-tight mt-1">Statistik & Tren Absensi</h1>
            <p class="text-amber-100/70 text-xs mt-0.5">
                Visualisasi rekapitulasi presensi periode <span class="font-bold text-white">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span> — SDN 118198 Sei Piandang.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Hadir Hari Ini</span>
                <h3 class="text-2xl font-black text-emerald-600 mt-0.5">94%</h3>
            </div>
            <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-lg flex items-center justify-center text-base"><i class="fa-solid fa-circle-check"></i></div>
        </div>
        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Izin & Sakit</span>
                <h3 class="text-2xl font-black text-amber-600 mt-0.5">4%</h3>
            </div>
            <div class="w-10 h-10 bg-amber-50 text-amber-500 rounded-lg flex items-center justify-center text-base"><i class="fa-solid fa-clock"></i></div>
        </div>
        <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Tanpa Keterangan</span>
                <h3 class="text-2xl font-black text-rose-600 mt-0.5">2%</h3>
            </div>
            <div class="w-10 h-10 bg-rose-50 text-rose-500 rounded-lg flex items-center justify-center text-base"><i class="fa-solid fa-circle-xmark"></i></div>
        </div>
    </div>

    <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-slate-50 pb-3">
            <div class="flex items-center space-x-2">
                <span class="text-[#362219]"><i class="fa-solid fa-chart-bar text-sm"></i></span>
                <h3 class="text-sm font-bold text-slate-700">Grafik Kehadiran Siswa Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</h3>
            </div>
            <span class="text-[10px] font-bold text-slate-500 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">
                Data Per: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </span>
        </div>
        
        <div class="relative w-full h-72 md:h-96">
            <canvas id="absensiChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('absensiChart').getContext('2d');
        
        // Data Dummy Kelas (Bisa kamu mapping dari Eloquent query nanti)
        const dataKelas = ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'];
        const persentaseHadir = [96, 92, 95, 88, 94, 97]; 

        // Mengambil nama bulan sekarang di sisi client JavaScript untuk label data grafiknya
        const namaBulanSekarang = "{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}";

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataKelas,
                datasets: [{
                    label: 'Rata-rata Kehadiran ' + namaBulanSekarang + ' (%)',
                    data: persentaseHadir,
                    backgroundColor: 'rgba(110, 90, 78, 0.85)', 
                    borderColor: '#362219',
                    borderWidth: 1.5,
                    borderRadius: 8, 
                    borderSkipped: false,
                    hoverBackgroundColor: '#362219', 
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false 
                    },
                    tooltip: {
                        padding: 12,
                        backgroundColor: '#1E293B',
                        titleFont: { size: 12, weight: 'bold', family: 'Nunito' },
                        bodyFont: { size: 12, family: 'Nunito' },
                        callbacks: {
                            label: function(context) {
                                return ` Kehadiran: ${context.raw}%`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            font: { family: 'Nunito', size: 11, weight: 'bold' },
                            color: '#94A3B8'
                        },
                        grid: {
                            color: '#F1F5F9' 
                        }
                    },
                    x: {
                        ticks: {
                            font: { family: 'Nunito', size: 11, weight: 'bold' },
                            color: '#64748B'
                        },
                        grid: {
                            display: false 
                        }
                    }
                }
            }
        });
    });
</script>
@endsection