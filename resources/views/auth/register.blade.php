@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
    <div style="min-height: 100vh; display: flex; font-family: 'Plus Jakarta Sans', sans-serif;">
        {{-- Left Panel --}}
        <div style="flex: 0 0 380px; background: #1e293b; display: flex; flex-direction: column; justify-content: center; padding: 50px; color: #fff; position: relative; overflow: hidden;"
            class="d-none d-lg-flex">
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 40px;">
                    <div
                        style="width: 40px; height: 40px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-vote-yea" style="font-size: 18px;"></i>
                    </div>
                    <span style="font-size: 18px; font-weight: 700;">evoting</span>
                </div>

                <h2 style="font-size: 26px; font-weight: 700; line-height: 1.3; margin-bottom: 14px;">
                    Buat Akun Baru
                </h2>
                <p style="color: rgba(255,255,255,0.5); font-size: 14px; line-height: 1.7;">
                    Daftarkan diri Anda untuk berpartisipasi dalam pemilihan.
                </p>

                <div style="margin-top: 40px;">
                    <div style="display: flex; align-items: flex-start; gap: 14px; margin-bottom: 24px;">
                        <div
                            style="width: 32px; height: 32px; background: rgba(59,130,246,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                            <i class="fas fa-shield-alt" style="color: #60a5fa; font-size: 13px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px; margin-bottom: 2px;">Terverifikasi</div>
                            <div style="font-size: 12px; color: rgba(255,255,255,0.4);">Setiap akun diverifikasi
                                berdasarkan NIM</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div
                            style="width: 32px; height: 32px; background: rgba(59,130,246,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                            <i class="fas fa-lock" style="color: #60a5fa; font-size: 13px;"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px; margin-bottom: 2px;">Satu Suara</div>
                            <div style="font-size: 12px; color: rgba(255,255,255,0.4);">Setiap mahasiswa hanya bisa
                                memilih satu kali</div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                style="position: absolute; bottom: -60px; right: -60px; width: 180px; height: 180px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%;">
            </div>
        </div>

        {{-- Right Panel - Form --}}
        <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px; background: #f8fafc; overflow-y: auto;">
            <div style="width: 100%; max-width: 520px;">
                {{-- Mobile Logo --}}
                <div class="d-lg-none text-center mb-4">
                    <div style="display: inline-flex; align-items: center; gap: 10px;">
                        <div
                            style="width: 36px; height: 36px; background: #3b82f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff;">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <span style="font-weight: 700; font-size: 16px; color: #1e293b;">evoting</span>
                    </div>
                </div>

                <h2 style="font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Pendaftaran Akun</h2>
                <p style="font-size: 14px; color: #64748b; margin-bottom: 28px;">Lengkapi data di bawah ini untuk membuat akun</p>

                @if ($errors->any())
                    <div
                        style="background: #fef2f2; border-left: 3px solid #ef4444; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 13px; color: #991b1b;">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="reg-input" placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">NIM</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" required
                                class="reg-input" placeholder="Nomor Induk Mahasiswa">
                        </div>
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="reg-input" placeholder="contoh@email.com">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Jurusan</label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}" required
                                class="reg-input" placeholder="Jurusan">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Angkatan</label>
                            <input type="text" name="angkatan" value="{{ old('angkatan') }}" required
                                class="reg-input" placeholder="Tahun angkatan">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password</label>
                            <input type="password" name="password" required
                                class="reg-input" placeholder="Min. 6 karakter">
                        </div>
                        <div>
                            <label style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="reg-input" placeholder="Ulangi password">
                        </div>
                    </div>

                    <button type="submit"
                        style="width: 100%; padding: 11px; background: #3b82f6; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.15s; font-family: inherit;"
                        onmouseover="this.style.background='#2563eb'"
                        onmouseout="this.style.background='#3b82f6'">
                        Daftar Akun
                    </button>
                </form>

                <div style="text-align: center; margin-top: 20px;">
                    <span style="font-size: 13px; color: #64748b;">Sudah punya akun?</span>
                    <a href="{{ route('login') }}"
                        style="font-size: 13px; color: #3b82f6; text-decoration: none; font-weight: 600; margin-left: 4px;">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .reg-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13.5px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fff;
        }

        .reg-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        @media (max-width: 576px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
