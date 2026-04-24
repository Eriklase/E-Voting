@extends('layouts.app')

@section('title', 'Data Kandidat')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div class="page-header" style="margin-bottom: 0;">
            <h1>Data Kandidat</h1>
            <p>Kelola data kandidat pemilihan</p>
        </div>
        <a href="{{ route('kandidat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kandidat
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Search --}}
            <form method="GET" action="{{ route('kandidat.index') }}" style="margin-bottom: 20px;">
                <div style="display: flex; gap: 8px; max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama kandidat..."
                        value="{{ $search }}">
                    <button type="submit" class="btn btn-primary" style="white-space: nowrap;">
                        <i class="fas fa-search"></i>
                    </button>
                    @if ($search)
                        <a href="{{ route('kandidat.index') }}" class="btn btn-outline-secondary" style="white-space: nowrap;">
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
                            <th>Foto</th>
                            <th>Nama Kandidat</th>
                            <th>Visi</th>
                            <th>Suara</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kandidats as $kandidat)
                            <tr>
                                <td>{{ ($kandidats->currentPage() - 1) * $kandidats->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if ($kandidat->foto)
                                        <img src="{{ asset('storage/' . $kandidat->foto) }}"
                                            alt="{{ $kandidat->nama_kandidat }}"
                                            style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px; border: 2px solid #f1f5f9;">
                                    @else
                                        <div style="width: 42px; height: 42px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user" style="color: #cbd5e1; font-size: 16px;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td style="font-weight: 600;">{{ $kandidat->nama_kandidat }}</td>
                                <td style="color: #64748b; max-width: 250px;">{{ Str::limit($kandidat->visi, 60) }}</td>
                                <td><span class="badge bg-primary">{{ $kandidat->voting_count }}</span></td>
                                <td>
                                    <div style="display: flex; gap: 6px;">
                                        <a href="{{ route('kandidat.edit', $kandidat->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('kandidat.destroy', $kandidat->id) }}"
                                            style="display: inline;"
                                            onsubmit="return confirm('Hapus kandidat ini?');">
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
                                <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                                    <i class="fas fa-inbox" style="font-size: 28px; display: block; margin-bottom: 8px;"></i>
                                    Tidak ada data kandidat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $kandidats->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
