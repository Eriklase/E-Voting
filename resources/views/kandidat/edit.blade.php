@extends('layouts.app')

@section('title', 'Edit Kandidat')

@section('content')
    <div class="page-header">
        <h1>Edit Kandidat</h1>
        <p>Perbarui data kandidat &mdash; <strong>{{ $kandidat->nama_kandidat }}</strong></p>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('kandidat.update', $kandidat->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Kandidat</label>
                            <input type="text" class="form-control @error('nama_kandidat') is-invalid @enderror"
                                name="nama_kandidat"
                                value="{{ old('nama_kandidat', $kandidat->nama_kandidat) }}" required>
                            @error('nama_kandidat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Visi</label>
                            <textarea class="form-control @error('visi') is-invalid @enderror"
                                name="visi" rows="4" required>{{ old('visi', $kandidat->visi) }}</textarea>
                            @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Misi</label>
                            <textarea class="form-control @error('misi') is-invalid @enderror"
                                name="misi" rows="4" required>{{ old('misi', $kandidat->misi) }}</textarea>
                            @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Foto Kandidat</label>
                            @if ($kandidat->foto)
                                <div style="margin-bottom: 10px;">
                                    <img src="{{ asset('storage/' . $kandidat->foto) }}"
                                        alt="{{ $kandidat->nama_kandidat }}"
                                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #e2e8f0;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                id="foto" name="foto" accept="image/*">
                            <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Biarkan kosong jika tidak ingin mengubah foto.</div>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div id="preview" style="margin-top: 10px;"></div>
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
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
                        '<img src="' + event.target.result + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #e2e8f0;">';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
