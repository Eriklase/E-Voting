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
                <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">Silakan masukkan email dan password Anda</p>

                {{-- Google prefill/login-as removed when Google login disabled --}}

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

                {{-- Google login button removed --}}

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
