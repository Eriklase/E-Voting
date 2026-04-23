@extends('layouts.app')

@section('title', 'Laporan & Rekap')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div class="page-header" style="margin-bottom: 0;">
            <h1>Laporan & Rekap Voting</h1>
            <p>Ringkasan hasil pemilihan Ketua Senat Fakultas</p>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('laporan.export') }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Export CSV
            </a>
            <a href="{{ route('laporan.reset') }}"
               class="btn btn-outline-danger"
               onclick="return confirm('Yakin ingin mereset semua data voting? Tindakan ini tidak dapat dibatalkan!')">
                <i class="fas fa-redo"></i> Reset Voting
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>{{ $totalSuara }}</h3>
                <p>Total Suara Masuk</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>{{ $totalKandidat }}</h3>
                <p>Jumlah Kandidat</p>
            </div>
        </div>
    </div>

    {{-- Tabel Perolehan Suara --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Perolehan Suara Kandidat</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Total Suara</th>
                            <th>Persentase</th>
                            <th>Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalVoting = $kandidats->sum('voting_count'); @endphp
                        @foreach ($kandidats as $kandidat)
                            @php
                                $persentase = $totalVoting > 0
                                    ? round(($kandidat->voting_count / $totalVoting) * 100, 1)
                                    : 0;
                            @endphp
                            <tr @if($loop->iteration == 1) style="background: #fffbeb;" @endif>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($loop->iteration == 1)
                                        <span style="font-weight: 700; color: #0f172a;">
                                            <i class="fas fa-crown" style="color: #f59e0b; margin-right: 6px;"></i>
                                            {{ $kandidat->nama_kandidat }}
                                        </span>
                                    @else
                                        <span style="font-weight: 600;">{{ $kandidat->nama_kandidat }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary" style="font-size: 13px; padding: 5px 12px;">
                                        {{ $kandidat->voting_count }}
                                    </span>
                                </td>
                                <td style="font-weight: 600;">{{ $persentase }}%</td>
                                <td>
                                    @if ($loop->iteration == 1)
                                        <span style="background: #fef3c7; color: #92400e; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 5px;">🥇 Pertama</span>
                                    @elseif ($loop->iteration == 2)
                                        <span style="background: #f1f5f9; color: #475569; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 5px;">🥈 Kedua</span>
                                    @elseif ($loop->iteration == 3)
                                        <span style="background: #fff7ed; color: #c2410c; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 5px;">🥉 Ketiga</span>
                                    @else
                                        <span style="background: #f8fafc; color: #94a3b8; font-size: 12px; padding: 3px 10px; border-radius: 5px;">Ke-{{ $loop->iteration }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Grafik Perolehan Suara</h5>
            <canvas id="laporanChart" height="100"></canvas>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kandidatNames = @json($kandidats->pluck('nama_kandidat'));
            const votingCounts  = @json($kandidats->pluck('voting_count'));
            const colors = ['#3b82f6', '#8b5cf6', '#06b6d4', '#f59e0b', '#ef4444', '#22c55e'];

            new Chart(document.getElementById('laporanChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderRadius: 6,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 12 } }, grid: { color: '#f1f5f9' } },
                        x: { ticks: { font: { size: 12 } }, grid: { display: false } }
                    }
                }
            });
        });
    </script>
@endsection
