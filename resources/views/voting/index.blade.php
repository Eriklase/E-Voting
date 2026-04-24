@extends('layouts.app')

@section('title', 'Voting')

@section('css')
<style>
    /* ===== VOTING HERO BANNER ===== */
    .voting-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e3a5f 100%);
        border-radius: 16px;
        padding: 36px 40px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .voting-hero::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(59,130,246,0.25) 0%, transparent 70%);
        border-radius: 50%;
    }

    .voting-hero::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: 30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .voting-hero-text h1 {
        font-size: 26px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
        letter-spacing: -0.3px;
    }

    .voting-hero-text p {
        color: rgba(255,255,255,0.65);
        font-size: 14px;
        margin: 0;
        line-height: 1.6;
        max-width: 480px;
    }

    .voting-hero-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(59,130,246,0.18);
        border: 1px solid rgba(59,130,246,0.35);
        color: #93c5fd;
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 12.5px;
        font-weight: 600;
        margin-top: 14px;
        width: fit-content;
    }

    .voting-hero-badge .dot {
        width: 7px;
        height: 7px;
        background: #22c55e;
        border-radius: 50%;
        box-shadow: 0 0 0 3px rgba(34,197,94,0.25);
        animation: pulse-dot 1.8s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { box-shadow: 0 0 0 3px rgba(34,197,94,0.25); }
        50% { box-shadow: 0 0 0 6px rgba(34,197,94,0.12); }
    }

    .voting-hero-icon {
        font-size: 72px;
        color: rgba(59,130,246,0.25);
        position: relative;
        z-index: 1;
        flex-shrink: 0;
        display: none;
    }

    @media (min-width: 768px) {
        .voting-hero-icon { display: block; }
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #64748b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    /* ===== CANDIDATE CARDS ===== */
    .candidate-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .candidate-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 48px rgba(59,130,246,0.12);
        border-color: #93c5fd;
    }

    /* Number badge */
    .candidate-number {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 10;
        width: 36px;
        height: 36px;
        background: rgba(15,23,42,0.75);
        backdrop-filter: blur(6px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 800;
        font-size: 14px;
        border: 2px solid rgba(255,255,255,0.2);
    }

    /* Photo area */
    .candidate-photo {
        height: 210px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
    }

    .candidate-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .candidate-card:hover .candidate-photo img {
        transform: scale(1.04);
    }

    .candidate-photo-placeholder {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .candidate-photo-placeholder i {
        font-size: 52px;
        color: #cbd5e1;
    }

    .candidate-photo-placeholder span {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Gradient overlay on photo */
    .candidate-photo::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: linear-gradient(to top, rgba(255,255,255,0.9), transparent);
        pointer-events: none;
    }

    /* Body */
    .candidate-body {
        padding: 20px 22px 22px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .candidate-name {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .candidate-divider {
        width: 36px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #6366f1);
        border-radius: 99px;
        margin: 10px 0 16px;
    }

    .candidate-section-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #94a3b8;
        margin-bottom: 5px;
    }

    .candidate-section-label i {
        font-size: 10px;
        color: #3b82f6;
    }

    .candidate-text {
        font-size: 13px;
        color: #475569;
        line-height: 1.65;
        margin: 0 0 14px;
    }

    /* Vote button */
    .btn-vote {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        width: 100%;
        padding: 13px 20px;
        background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: auto;
        letter-spacing: 0.2px;
        font-family: inherit;
        position: relative;
        overflow: hidden;
    }

    .btn-vote::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.5s ease;
    }

    .btn-vote:hover::before {
        left: 100%;
    }

    .btn-vote:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 24px rgba(59,130,246,0.4);
    }

    .btn-vote:active {
        transform: translateY(0);
        box-shadow: none;
    }

    /* ===== MODAL STYLES ===== */
    .modal-confirm .modal-content {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 30px 80px rgba(0,0,0,0.2);
    }

    .modal-confirm .modal-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: none;
        padding: 24px 28px 20px;
    }

    .modal-confirm .modal-title {
        color: #fff;
        font-size: 17px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-confirm .modal-title i {
        color: #60a5fa;
    }

    .modal-confirm .btn-close {
        filter: invert(1) opacity(0.6);
    }

    .modal-confirm .modal-body {
        padding: 28px;
    }

    .modal-candidate-preview {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }

    .modal-candidate-avatar {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .modal-candidate-name {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 3px;
    }

    .modal-candidate-sub {
        font-size: 12px;
        color: #64748b;
    }

    .modal-warning {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        color: #92400e;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .modal-warning i {
        color: #f59e0b;
        margin-top: 1px;
        flex-shrink: 0;
    }

    .modal-confirm .modal-footer {
        padding: 16px 28px 24px;
        border: none;
        gap: 10px;
    }

    .btn-confirm-vote {
        flex: 1;
        padding: 12px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        border: none;
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .btn-confirm-vote:hover {
        box-shadow: 0 6px 20px rgba(59,130,246,0.4);
        transform: translateY(-1px);
    }

    .btn-cancel-vote {
        flex: 1;
        padding: 12px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .btn-cancel-vote:hover {
        background: #e2e8f0;
        color: #475569;
    }

    /* Already voted state */
    .voted-banner {
        background: linear-gradient(135deg, #064e3b, #065f46);
        border-radius: 14px;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
        border: 1px solid rgba(34,197,94,0.3);
    }

    .voted-banner-icon {
        width: 56px;
        height: 56px;
        background: rgba(34,197,94,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4ade80;
        font-size: 24px;
        flex-shrink: 0;
    }

    .voted-banner h4 {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .voted-banner p {
        color: rgba(255,255,255,0.65);
        font-size: 13px;
        margin: 0;
    }

    /* Disabled card when voted */
    .candidate-card.voted-disabled {
        opacity: 0.6;
        pointer-events: none;
        filter: grayscale(30%);
    }

    .candidate-card.voted-chosen {
        opacity: 1;
        pointer-events: none;
        border-color: #22c55e;
        box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
    }

    .chosen-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 10;
        background: #22c55e;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>
@endsection

@section('content')

{{-- ===== VOTING HERO ===== --}}
<div class="voting-hero">
    <div class="voting-hero-text">
        <h1>🗳️ Pilih Kandidatmu</h1>
        <p>Pemilihan — Berikan suaramu untuk masa depan yang lebih baik. Setiap suara sangat berarti.</p>
        <div class="voting-hero-badge">
            <span class="dot"></span>
            Pemilihan Sedang Berlangsung
        </div>
    </div>
    <div class="voting-hero-icon">
        <i class="fas fa-vote-yea"></i>
    </div>
</div>

{{-- ===== ALREADY VOTED NOTICE ===== --}}
@if(session('sudah_voting') || isset($sudahVoting) && $sudahVoting)
<div class="voted-banner">
    <div class="voted-banner-icon">
        <i class="fas fa-check-double"></i>
    </div>
    <div>
        <h4>Suaramu Telah Tercatat!</h4>
        <p>Terima kasih telah berpartisipasi dalam pemilihan. Anda hanya bisa memilih satu kali.</p>
    </div>
</div>
@endif

{{-- ===== CANDIDATES GRID ===== --}}
<div class="section-title">
    <i class="fas fa-users" style="color:#3b82f6;"></i>
    Daftar Kandidat &mdash; {{ $kandidats->count() }} Kandidat
</div>

<div class="row g-4">
    @foreach ($kandidats as $index => $kandidat)
        <div class="col-lg-6 col-xl-4">
            <div class="candidate-card">

                {{-- Number Badge --}}
                <div class="candidate-number">{{ $index + 1 }}</div>

                {{-- Chosen badge (when user has voted for this one) --}}
                @if(isset($pilihanKandidat) && $pilihanKandidat == $kandidat->id)
                    <div class="chosen-badge"><i class="fas fa-check"></i> Pilihan Anda</div>
                @endif

                {{-- Photo --}}
                <div class="candidate-photo">
                    <a href="{{ route('kandidat.public.show', $kandidat->id) }}" style="display:block; height:100%; color:inherit; text-decoration:none;">
                        @if ($kandidat->foto)
                            <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="{{ $kandidat->nama_kandidat }}">
                        @else
                            <div class="candidate-photo-placeholder">
                                <i class="fas fa-user-tie"></i>
                                <span>Foto Kandidat</span>
                            </div>
                        @endif
                    </a>
                </div>

                {{-- Body --}}
                <div class="candidate-body">
                    <div class="candidate-name"><a href="{{ route('kandidat.public.show', $kandidat->id) }}" style="color:inherit; text-decoration:none;">{{ $kandidat->nama_kandidat }}</a></div>
                    <div class="candidate-divider"></div>

                    <div class="candidate-section-label">
                        <i class="fas fa-eye"></i> Visi
                    </div>
                    <p class="candidate-text">{{ $kandidat->visi }}</p>

                    <div class="candidate-section-label">
                        <i class="fas fa-bullseye"></i> Misi
                    </div>
                    <p class="candidate-text">{{ $kandidat->misi }}</p>

                    {{-- Vote Button --}}
                    @if(!isset($sudahVoting) || !$sudahVoting)
                        <button class="btn-vote mt-2"
                            onclick="openConfirmModal({{ $kandidat->id }}, '{{ addslashes($kandidat->nama_kandidat) }}')">
                            <i class="fas fa-check-circle"></i>
                            Pilih Kandidat Ini
                        </button>
                    @else
                        <button class="btn-vote mt-2" disabled
                            style="background: #94a3b8; cursor: not-allowed; box-shadow: none; transform: none;">
                            <i class="fas fa-lock"></i>
                            Voting Selesai
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- ===== CONFIRMATION MODAL ===== --}}
<div class="modal fade modal-confirm" id="confirmVoteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-shield-alt"></i>
                    Konfirmasi Pilihan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:14px; color:#64748b; margin-bottom:20px;">
                    Anda akan memilih kandidat berikut:
                </p>

                <div class="modal-candidate-preview">
                    <div class="modal-candidate-avatar" id="modalAvatarInitial">A</div>
                    <div>
                        <div class="modal-candidate-name" id="modalCandidateName">Nama Kandidat</div>
                        <div class="modal-candidate-sub">Kandidat</div>
                    </div>
                </div>

                <div class="modal-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Pilihan <strong>tidak dapat diubah</strong> setelah dikonfirmasi. Pastikan Anda sudah memilih dengan tepat.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel-vote" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="voteForm" method="POST" action="{{ route('voting.store') }}" style="flex:1; display:flex;">
                    @csrf
                    <input type="hidden" name="kandidat_id" id="voteKandidatId">
                    <button type="submit" class="btn-confirm-vote">
                        <i class="fas fa-vote-yea"></i> Ya, Pilih Sekarang!
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    function openConfirmModal(kandidatId, kandidatName) {
        document.getElementById('voteKandidatId').value = kandidatId;
        document.getElementById('modalCandidateName').textContent = kandidatName;
        document.getElementById('modalAvatarInitial').textContent = kandidatName.charAt(0).toUpperCase();
        var modal = new bootstrap.Modal(document.getElementById('confirmVoteModal'));
        modal.show();
    }
</script>
@endsection
