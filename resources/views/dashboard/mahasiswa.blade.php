@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="page-header">
        <h1>Beranda</h1>
        <p>Selamat datang, {{ auth()->user()->name }}. Berikut informasi pemilihan terkini.</p>
    </div>

    {{-- Info & Status --}}
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Informasi Pemilihan</h5>
                    <div style="background: #f8fafc; border-radius: 8px; padding: 20px; margin-bottom: 16px;">
                        <div style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                            Pemilihan Ketua Senat Fakultas {{ date('Y') }}
                        </div>
                        <p style="font-size: 13px; color: #64748b; margin: 0;">
                            Gunakan hak pilih Anda untuk menentukan Ketua Senat yang akan mewakili aspirasi mahasiswa.
                        </p>
                    </div>
                    <div class="row text-center">
                        <div class="col-6">
                            <div style="padding: 16px; background: #eff6ff; border-radius: 8px;">
                                <div style="font-size: 28px; font-weight: 700; color: #2563eb;">{{ $totalKandidat }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Kandidat</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="padding: 16px; background: #f0fdf4; border-radius: 8px;">
                                <div style="font-size: 28px; font-weight: 700; color: #16a34a;">{{ $totalSuara }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">Suara Masuk</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Status Anda</h5>
                    <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-center text-center">
                        @if ($hasVoted)
                            <div style="width: 56px; height: 56px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                                <i class="fas fa-check" style="color: #16a34a; font-size: 22px;"></i>
                            </div>
                            <div style="font-weight: 700; font-size: 15px; color: #0f172a; margin-bottom: 4px;">Sudah Memilih</div>
                            <p style="font-size: 12.5px; color: #64748b; margin-bottom: 16px;">Terima kasih telah menggunakan hak suara Anda.</p>
                            <a href="{{ route('voting.hasil') }}" class="btn btn-primary btn-sm" style="padding: 8px 20px;">
                                Lihat Hasil
                            </a>
                        @else
                            <div style="width: 56px; height: 56px; background: #fef3c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                                <i class="fas fa-exclamation" style="color: #d97706; font-size: 22px;"></i>
                            </div>
                            <div style="font-weight: 700; font-size: 15px; color: #0f172a; margin-bottom: 4px;">Belum Memilih</div>
                            <p style="font-size: 12.5px; color: #64748b; margin-bottom: 16px;">Segera gunakan hak suara Anda.</p>
                            <a href="{{ route('voting.index') }}" class="btn btn-primary btn-sm" style="padding: 8px 20px;">
                                <i class="fas fa-vote-yea"></i> Voting Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h5 class="card-title mb-0">Grafik Perolehan Suara</h5>
                        <span style="font-size: 11px; color: #94a3b8; background: #f1f5f9; padding: 4px 10px; border-radius: 5px;">Real-time</span>
                    </div>
                    <div style="height: 250px; position: relative;">
                        <canvas id="mahasiswaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Kandidat --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Kandidat</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Suara</th>
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
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $persentase }}%;"></div>
                                        </div>
                                        <span style="font-size: 12px; color: #64748b; min-width: 40px;">{{ $persentase }}%</span>
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
            const colors = ['#3b82f6', '#8b5cf6', '#06b6d4', '#f59e0b', '#ef4444', '#22c55e'];

            new Chart(document.getElementById('mahasiswaChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: kandidatNames,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: votingCounts,
                        backgroundColor: colors.slice(0, kandidatNames.length),
                        borderRadius: 6,
                        barThickness: 'flex',
                        maxBarThickness: 40
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
                            ticks: { font: { size: 12, family: 'Plus Jakarta Sans' } },
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            ticks: { font: { size: 12, family: 'Plus Jakarta Sans' } },
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
@endsection
