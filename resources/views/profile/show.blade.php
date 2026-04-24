@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="page-header">
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun dan keamanan Anda</p>
    </div>

    <div class="row justify-content-center g-4">

        {{-- Centered: Avatar & Info Singkat --}}
        <div class="col-lg-6 col-md-8">
            <div class="card p-4 shadow-sm">
                <div class="text-center">
                    <div class="mx-auto rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:96px;height:96px;font-size:36px;color:#fff;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <h4 class="mt-3 mb-0 fw-bold text-dark">{{ auth()->user()->name }}</h4>
                    <div class="text-muted small">{{ auth()->user()->email }}</div>

                    <div class="mt-3">
                        <span class="badge bg-info text-dark" style="text-transform:capitalize;"> <i class="fas fa-shield-alt me-1"></i> {{ auth()->user()->role }}</span>
                    </div>
                </div>

                <hr class="my-4">

                <div class="row gx-2 gy-2">
                    <div class="col-6 text-muted small">NIM</div>
                    <div class="col-6 text-end fw-bold">
                        @if(auth()->user()->mahasiswa)
                            {{ auth()->user()->mahasiswa->nim }}
                        @else
                            #{{ auth()->user()->id }}
                        @endif
                    </div>

                    <div class="col-6 text-muted small">Role</div>
                    <div class="col-6 text-end fw-bold text-capitalize">{{ auth()->user()->role }}</div>

                    <div class="col-6 text-muted small">Terdaftar</div>
                    <div class="col-6 text-end fw-bold">{{ auth()->user()->created_at->format('d M Y') }}</div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary btn-sm" disabled>Hubungi Admin</button>
                </div>
            </div>
        </div>
    </div>
@endsection
