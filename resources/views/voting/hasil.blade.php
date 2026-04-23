@extends('layouts.app')

@section('title', 'Hasil Voting')

@section('css')
<style>
    /* ===== COMPACT & PREMIUM HERO ===== */
    .hasil-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.1);
    }
    .hasil-hero-text h1 {
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .hasil-hero-text p {
        font-size: 13px;
        color: #cbd5e1;
        margin: 0;
    }
    .refresh-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .refresh-badge i {
        color: #4ade80;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0% { opacity: 1; }
        50% { opacity: 0.4; }
        100% { opacity: 1; }
    }

    /* ===== COMPACT STAT CARDS ===== */
    .stat-compact {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: transform 0.2s;
    }
    .stat-compact:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .stat-compact .icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .stat-compact .icon.blue { background: linear-gradient(135deg, #eff6ff, #dbeafe); color: #3b82f6; }
    .stat-compact .icon.purple { background: linear-gradient(135deg, #f5f3ff, #ede9fe); color: #8b5cf6; }
    
    .stat-compact .info h4 {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 2px 0;
        line-height: 1;
    }
    .stat-compact .info p {
        font-size: 12px;
        color: #64748b;
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== COMPACT CHARTS ===== */
    .chart-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        height: 100%;
    }
    .chart-card h5 {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .chart-card h5 i {
        color: #3b82f6;
    }

    /* ===== TABLE STYLES ===== */
    .table-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .table-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-card-header h5 {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .table-card-header i {
        color: #8b5cf6;
    }
    .table-compact th, .table-compact td {
        padding: 12px 20px;
        font-size: 13px;
        vertical-align: middle;
    }
    .table-compact th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
    }
    .winner-row {
        background: linear-gradient(90deg, #fffbeb, transparent);
    }
    .progress-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .progress-bar-custom {
        height: 6px;
        background: #f1f5f9;
        border-radius: 10px;
        flex-grow: 1;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        border-radius: 10px;
        transition: width 1s ease-in-out;
    }
    .progress-text {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        min-width: 40px;
        text-align: right;
    }
</style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="hasil-hero">
        <div class="hasil-hero-text">
            <h1><i class="fas fa-chart-pie" style="color: #60a5fa;"></i> Hasil Voting Sementara</h1>
            <p>Data diperbarui secara otomatis dan real-time.</p>
        </div>
        <div class="refresh-badge">
            <i class="fas fa-circle"></i> Live Update (30s)
        </div>
    </div>

    {{-- Stats Section (Lebih Compact) --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-compact">
                <div class="icon blue">
                    <i class="fas fa-check-to-slot"></i>
                </div>
                <div class="info">
                    <h4>{{ $totalSuara }}</h4>
                    <p>Total Suara Masuk</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-compact">
                <div class="icon purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="info">
                    <h4>{{ count($kandidats) }}</h4>
                    <p>Kandidat Terdaftar</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section (Lebih Compact, height dikurangi) --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-7">
            <div class="chart-card">
                <h5><i class="fas fa-chart-bar"></i> Grafik Perolehan Suara</h5>
                <div style="height: 220px; position: relative;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="chart-card">
                <h5><i class="fas fa-chart-pie"></i> Distribusi Persentase</h5>
                <div style="height: 220px; position: relative;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Detail Table (Lebih Compact dan Elegan) --}}
    <div class="table-card">
        <div class="table-card-header">
            <i class="fas fa-list-ol"></i>
            <h5>Rincian Hasil Pemilihan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-compact mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="35%">Kandidat</th>
                        <th width="15%">Suara Masuk</th>
                        <th width="45%">Persentase Suara</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalVoting = $kandidats->sum('voting_count'); @endphp
                    @foreach ($kandidats as $kandidat)
                        @php
                            $persentase = $totalVoting > 0
                                ? round(($kandidat->voting_count / $totalVoting) * 100, 1)
                                : 0;
                            $isWinner = ($loop->iteration == 1 && $totalVoting > 0);
                        @endphp
                        <tr class="{{ $isWinner ? 'winner-row' : '' }}">
                            <td class="text-center" style="color: #64748b; font-weight: 600;">{{ $loop->iteration }}</td>
                            <td>
                                <div style="font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                    @if ($isWinner)
                                        <i class="fas fa-crown" style="color: #f59e0b; font-size: 14px;" title="Perolehan Tertinggi"></i>
                                    @else
                                        <div style="width: 14px;"></div>
                                    @endif
                                    {{ $kandidat->nama_kandidat }}
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: {{ $isWinner ? '#3b82f6' : '#94a3b8' }}; padding: 6px 12px; font-size: 12px;">
                                    {{ $kandidat->voting_count }} Suara
                                </span>
                            </td>
                            <td>
                                <div class="progress-wrapper">
                                    <div class="progress-bar-custom">
                                        <div class="progress-fill" style="width: {{ $persentase }}%; background: {{ $isWinner ? 'linear-gradient(90deg, #f59e0b, #fbbf24)' : 'linear-gradient(90deg, #3b82f6, #60a5fa)' }};"></div>
                                    </div>
                                    <span class="progress-text">{{ $persentase }}%</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kandidatNames = @json($kandidats->pluck('nama_kandidat'));
            const votingCounts  = @json($kandidats->pluck('voting_count'));
            
            // Premium color palette
            const colors = [
                '#3b82f6', // Blue
                '#8b5cf6', // Purple
                '#0ea5e9', // Sky
                '#f59e0b', // Amber
                '#10b981', // Emerald
                '#f43f5e'  // Rose
            ];

            // Setup Bar Chart
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        label: 'Suara',
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderRadius: 6,
                        barThickness: 'flex',
                        maxBarThickness: 32
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            titleFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" },
                            bodyFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" },
                            displayColors: false
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: { precision: 0, font: { size: 11 } }, 
                            grid: { color: '#f1f5f9', drawBorder: false } 
                        },
                        x: { 
                            ticks: { font: { size: 11 } }, 
                            grid: { display: false, drawBorder: false } 
                        }
                    }
                }
            });

            // Setup Pie Chart
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderWidth: 0,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { 
                                padding: 16, 
                                usePointStyle: true, 
                                pointStyle: 'circle', 
                                font: { size: 11, family: "'Plus Jakarta Sans', sans-serif" } 
                            }
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            bodyFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" }
                        }
                    }
                }
            });

            // Auto-refresh every 30 seconds
            setTimeout(() => location.reload(), 30000);
        });
    </script>
@endsection
