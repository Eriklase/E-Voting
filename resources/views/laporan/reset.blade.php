@extends('layouts.app')

@section('title', 'Konfirmasi Reset')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-lg-5 col-md-7">
            <div class="card" style="border: 1.5px solid #fca5a5;">
                <div class="card-body" style="padding: 32px;">
                    <div style="text-align: center; margin-bottom: 24px;">
                        <div style="width: 56px; height: 56px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                            <i class="fas fa-exclamation-triangle" style="color: #ef4444; font-size: 22px;"></i>
                        </div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Konfirmasi Reset Voting</h4>
                        <p style="font-size: 13px; color: #64748b;">Tindakan ini akan menghapus <strong>semua data voting</strong> yang sudah diinput dan tidak dapat dibatalkan.</p>
                    </div>

                    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 14px; margin-bottom: 20px; font-size: 13px; color: #92400e;">
                        <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i>
                        <strong>Peringatan:</strong> Semua suara yang sudah masuk akan dihapus permanen.
                    </div>

                    <form method="POST" action="{{ route('laporan.confirm-reset') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Password Admin (untuk konfirmasi)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autofocus placeholder="Masukkan password Anda">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-danger flex-grow-1">
                                <i class="fas fa-redo"></i> Ya, Reset Data
                            </button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary flex-grow-1">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
