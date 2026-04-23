@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="page-header">
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun dan keamanan Anda</p>
    </div>

    <div class="row g-4">

        {{-- Left: Avatar & Info Singkat --}}
        <div class="col-lg-4">
            <div class="card text-center" style="padding: 32px 24px;">
                {{-- Avatar --}}
                <div style="width: 80px; height: 80px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 32px; font-weight: 800; color: #fff;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <h5 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                    {{ auth()->user()->name }}
                </h5>
                <p style="font-size: 13px; color: #64748b; margin-bottom: 16px;">
                    {{ auth()->user()->email }}
                </p>

                <span style="display: inline-block; background: #dbeafe; color: #1d4ed8; font-size: 12px; font-weight: 600; padding: 4px 14px; border-radius: 50px; text-transform: capitalize;">
                    <i class="fas fa-shield-alt" style="margin-right: 4px;"></i>
                    {{ auth()->user()->role }}
                </span>

                <hr style="border-color: #f1f5f9; margin: 24px 0;">

                <div style="text-align: left;">
                    <div style="font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">Info Akun</div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px;">
                        <span style="color: #64748b;">NIM</span>
                        <span style="font-weight: 600; color: #0f172a;">
                            @if(auth()->user()->mahasiswa)
                                {{ auth()->user()->mahasiswa->nim }}
                            @else
                                #{{ auth()->user()->id }}
                            @endif
                        </span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px;">
                        <span style="color: #64748b;">Role</span>
                        <span style="font-weight: 600; color: #0f172a; text-transform: capitalize;">{{ auth()->user()->role }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px;">
                        <span style="color: #64748b;">Terdaftar</span>
                        <span style="font-weight: 600; color: #0f172a;">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Form --}}
        <div class="col-lg-8">

            {{-- Informasi Profil --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <div style="width: 36px; height: 36px; background: #eff6ff; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: #3b82f6; font-size: 14px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 700; color: #0f172a;">Informasi Profil</div>
                            <div style="font-size: 12px; color: #94a3b8;">Perbarui nama dan alamat email Anda</div>
                        </div>
                    </div>

                    @if(session('success') && !session('pass_success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update-info') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Alamat Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Ubah Password --}}
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <div style="width: 36px; height: 36px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-lock" style="color: #d97706; font-size: 14px;"></i>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 700; color: #0f172a;">Ubah Password</div>
                            <div style="font-size: 12px; color: #94a3b8;">Pastikan menggunakan password yang kuat dan unik</div>
                        </div>
                    </div>

                    @if(session('pass_success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('pass_success') }}
                        </div>
                    @endif

                    @if($errors->has('current_password'))
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle"></i> {{ $errors->first('current_password') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update-password') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password"
                                placeholder="Masukkan password saat ini">
                            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    name="new_password"
                                    placeholder="Min. 6 karakter">
                                @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password"
                                    class="form-control"
                                    name="new_password_confirmation"
                                    placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div style="background: #f8fafc; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; font-size: 12.5px; color: #64748b;">
                            <i class="fas fa-info-circle" style="color: #3b82f6; margin-right: 4px;"></i>
                            Password minimal 6 karakter dan harus diisi ulang untuk konfirmasi.
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Perbarui Password
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
