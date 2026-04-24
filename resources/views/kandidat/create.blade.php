@extends('layouts.app')

@section('title', 'Tambah Kandidat')

@section('content')
    <div class="page-header">
        <h1>Tambah Kandidat</h1>
        <p>Isi data kandidat pemilihan di bawah ini</p>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('kandidat.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Kandidat</label>
                            <input type="text" class="form-control @error('nama_kandidat') is-invalid @enderror"
                                name="nama_kandidat" value="{{ old('nama_kandidat') }}" required
                                placeholder="Nama lengkap kandidat">
                            @error('nama_kandidat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea class="form-control @error('visi') is-invalid @enderror"
                                name="visi" rows="4" required
                                placeholder="Tuliskan visi kandidat...">{{ old('visi') }}</textarea>
                            @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea class="form-control @error('misi') is-invalid @enderror"
                                name="misi" rows="4" required
                                placeholder="Tuliskan misi kandidat...">{{ old('misi') }}</textarea>
                            @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Foto Kandidat <span style="color: #94a3b8; font-weight: 400;">(opsional)</span></label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                id="foto" name="foto" accept="image/*">
                            <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Format: JPG, PNG. Maksimal 2MB.</div>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <div id="preview" style="margin-top: 12px;"></div>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('kandidat.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('foto').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('preview').innerHTML =
                        '<img src="' + event.target.result + '" style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid #e2e8f0;">';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
