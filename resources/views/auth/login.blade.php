@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div style="min-height: 100vh; display: flex; font-family: 'Plus Jakarta Sans', sans-serif;">
        {{-- Left Panel --}}
        <div style="flex: 1; background: #1e293b; display: flex; flex-direction: column; justify-content: center; padding: 60px; color: #fff; position: relative; overflow: hidden;"
            class="d-none d-lg-flex">
            <div style="position: relative; z-index: 2;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 40px;">
                    <div
                        style="width: 40px; height: 40px; background: #3b82f6; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-vote-yea" style="font-size: 18px;"></i>
                    </div>
                    <span style="font-size: 18px; font-weight: 700;">E-Voting Senat</span>
                </div>

                <h1 style="font-size: 32px; font-weight: 700; line-height: 1.3; margin-bottom: 16px;">
                    Pemilihan Ketua<br>Senat Fakultas
                </h1>
                <p style="color: rgba(255,255,255,0.5); font-size: 15px; line-height: 1.7; max-width: 380px;">
                    Gunakan hak suara Anda secara bertanggung jawab. Sistem ini menjamin kerahasiaan dan transparansi
                    dalam proses pemilihan.
                </p>

                <div style="margin-top: 48px; display: flex; gap: 32px;">
                    <div>
                        <div style="font-size: 28px; font-weight: 700; color: #60a5fa;">100%</div>
                        <div style="font-size: 12px; color: rgba(255,255,255,0.4); margin-top: 4px;">Aman & Rahasia
                        </div>
                    </div>
                    <div style="width: 1px; background: rgba(255,255,255,0.1);"></div>
                    <div>
                        <div style="font-size: 28px; font-weight: 700; color: #60a5fa;">Real-time</div>
                        <div style="font-size: 12px; color: rgba(255,255,255,0.4); margin-top: 4px;">Hasil Terkini</div>
                    </div>
                </div>
            </div>

            {{-- Decorative Elements --}}
            <div
                style="position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border: 1px solid rgba(255,255,255,0.05); border-radius: 50%;">
            </div>
            <div
                style="position: absolute; bottom: -80px; right: 60px; width: 280px; height: 280px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%;">
            </div>
            <div
                style="position: absolute; top: 40%; left: -40px; width: 120px; height: 120px; background: rgba(59,130,246,0.08); border-radius: 50%; filter: blur(40px);">
            </div>
        </div>

        {{-- Right Panel - Form --}}
        <div
            style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px; background: #f8fafc;">
            <div style="width: 100%; max-width: 400px;">
                {{-- Mobile Logo --}}
                <div class="d-lg-none text-center mb-4">
                    <div style="display: inline-flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                        <div
                            style="width: 36px; height: 36px; background: #3b82f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff;">
                            <i class="fas fa-vote-yea"></i>
                        </div>
                        <span style="font-weight: 700; font-size: 16px; color: #1e293b;">E-Voting Senat</span>
                    </div>
                </div>

                <h2 style="font-size: 24px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Masuk ke Akun</h2>
                <p style="font-size: 14px; color: #64748b; margin-bottom: 28px;">Silakan masukkan email dan password
                    Anda</p>

                @if ($errors->any())
                    <div
                        style="background: #fef2f2; border-left: 3px solid #ef4444; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 13px; color: #991b1b;">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div style="margin-bottom: 18px;">
                        <label
                            style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.15s; font-family: inherit; background: #fff;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                            placeholder="contoh@email.com">
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label
                            style="display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password</label>
                        <input type="password" name="password" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.15s; font-family: inherit; background: #fff;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'"
                            placeholder="Masukkan password">
                    </div>

                    <button type="submit"
                        style="width: 100%; padding: 11px; background: #3b82f6; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.15s; font-family: inherit;"
                        onmouseover="this.style.background='#2563eb'"
                        onmouseout="this.style.background='#3b82f6'">
                        Masuk
                    </button>
                </form>

                <div style="display: flex; align-items: center; margin: 24px 0;">
                    <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
                    <div style="padding: 0 16px; font-size: 12px; font-weight: 600; color: #94a3b8; text-transform: uppercase;">ATAU</div>
                    <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
                </div>

                <a href="{{ route('google.login') }}" style="display: flex; align-items: center; justify-content: center; gap: 10px; width: 100%; padding: 11px; background: #fff; color: #334155; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.15s; font-family: inherit;"
                   onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1'"
                   onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'">
                    <svg viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Lanjutkan dengan Google
                </a>

                <div style="text-align: center; margin-top: 24px;">
                    <span style="font-size: 13px; color: #64748b;">Belum punya akun?</span>
                    <a href="{{ route('register') }}"
                        style="font-size: 13px; color: #3b82f6; text-decoration: none; font-weight: 600; margin-left: 4px;">Daftar
                        sekarang</a>
                </div>

            </div>
        </div>
    </div>
@endsection
