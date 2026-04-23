@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, {{ auth()->user()->name }}. Berikut ringkasan pemilihan.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <h3>{{ $totalMahasiswa }}</h3>
                <p>Total Mahasiswa Terdaftar</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>{{ $totalKandidat }}</h3>
                <p>Kandidat Aktif</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>{{ $totalSuara }}</h3>
                <p>Suara Masuk</p>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h5 class="card-title mb-0">Perolehan Suara</h5>
                        <span style="font-size: 11px; color: #94a3b8; background: #f1f5f9; padding: 4px 10px; border-radius: 5px;">Data terkini</span>
                    </div>
                    <div style="position: relative; flex-grow: 1; min-height: 300px;">
                        <canvas id="votingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-4">Distribusi Suara</h5>
                    <div style="position: relative; flex-grow: 1; min-height: 300px; display: flex; justify-content: center; align-items: center;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h5 class="card-title mb-0">Rekapitulasi Perolehan Suara</h5>
                <a href="{{ route('laporan.index') }}" style="font-size: 13px; color: #3b82f6; text-decoration: none; font-weight: 600;">
                    Lihat Laporan <i class="fas fa-arrow-right" style="font-size: 11px;"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Suara</th>
                            <th>Persentase</th>
                            <th style="min-width: 200px;">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalSuaraAll = $kandidats->sum('voting_count');
                        @endphp
                        @foreach ($kandidats as $kandidat)
                            @php
                                $persentase = $totalSuaraAll > 0 ? round(($kandidat->voting_count / $totalSuaraAll) * 100, 1) : 0;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="font-weight: 600;">{{ $kandidat->nama_kandidat }}</td>
                                <td><span class="badge bg-primary">{{ $kandidat->voting_count }}</span></td>
                                <td>{{ $persentase }}%</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $persentase }}%;"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kandidatNames = @json($kandidats->pluck('nama_kandidat'));
            const votingCounts = @json($kandidats->pluck('voting_count'));
            const colors = ['#3b82f6', '#8b5cf6', '#06b6d4', '#f59e0b', '#ef4444', '#22c55e', '#ec4899'];

            // Bar Chart
            new Chart(document.getElementById('votingChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderRadius: 6,
                        borderSkipped: false,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, font: { size: 12, family: 'Plus Jakarta Sans' } },
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            ticks: { font: { size: 12, family: 'Plus Jakarta Sans' } },
                            grid: { display: false }
                        }
                    }
                }
            });

            // Pie Chart
            new Chart(document.getElementById('pieChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderColor: '#fff',
                        borderWidth: 3,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 16,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: { size: 12, family: 'Plus Jakarta Sans' }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
