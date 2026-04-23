@extends('layouts.app')

@section('title', 'Edit Mahasiswa')

@section('content')
    <div class="page-header">
        <h1>Edit Data Mahasiswa</h1>
        <p>Perbarui data mahasiswa &mdash; <strong>{{ $mahasiswa->nama }}</strong></p>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $mahasiswa->nama) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIM <span style="color: #94a3b8; font-weight: 400;">(tidak dapat diubah)</span></label>
                            <input type="text" class="form-control"
                                value="{{ $mahasiswa->nim }}" disabled
                                style="background: #f8fafc; color: #94a3b8;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span style="color: #94a3b8; font-weight: 400;">(tidak dapat diubah)</span></label>
                            <input type="text" class="form-control"
                                value="{{ $mahasiswa->user->email }}" disabled
                                style="background: #f8fafc; color: #94a3b8;">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                    name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required>
                                @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Angkatan</label>
                                <input type="text" class="form-control @error('angkatan') is-invalid @enderror"
                                    name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" required>
                                @error('angkatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div style="display: flex; gap: 10px; padding-top: 8px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
