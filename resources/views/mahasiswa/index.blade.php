@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div class="page-header" style="margin-bottom: 0;">
            <h1>Data Mahasiswa</h1>
            <p>Kelola data mahasiswa yang terdaftar dalam sistem</p>
        </div>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Mahasiswa
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Search --}}
            <form method="GET" action="{{ route('mahasiswa.index') }}" style="margin-bottom: 20px;">
                <div style="display: flex; gap: 8px; max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari NIM atau nama..."
                        value="{{ $search }}">
                    <button type="submit" class="btn btn-primary" style="white-space: nowrap;">
                        <i class="fas fa-search"></i>
                    </button>
                    @if ($search)
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary" style="white-space: nowrap;">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() + $loop->iteration }}</td>
                                <td><code style="font-size: 12px; background: #f1f5f9; padding: 2px 8px; border-radius: 4px;">{{ $mahasiswa->nim }}</code></td>
                                <td style="font-weight: 600;">{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->jurusan }}</td>
                                <td><span class="badge bg-light text-dark" style="border: 1px solid #e2e8f0;">{{ $mahasiswa->angkatan }}</span></td>
                                <td style="color: #64748b;">{{ $mahasiswa->user->email }}</td>
                                <td>
                                    <div style="display: flex; gap: 6px;">
                                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Hapus data mahasiswa ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                                    <i class="fas fa-inbox" style="font-size: 28px; display: block; margin-bottom: 8px;"></i>
                                    Tidak ada data mahasiswa
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $mahasiswas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
