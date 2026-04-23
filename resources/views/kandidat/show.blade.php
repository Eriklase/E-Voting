@extends('layouts.app')

@section('title', 'Detail Kandidat')

@section('css')
<style>
    .kandidat-detail-card { border-radius: 12px; overflow: hidden; }
    .kandidat-photo { width: 100%; height: 100%; object-fit: cover; border-radius: 10px; }
    .kandidat-meta { color: #475569; }
    .kandidat-sidebar { min-width: 240px; }
    @media (max-width: 767px) {
        .kandidat-sidebar { min-width: 100%; }
    }
</style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap">
        <div>
            <h1 class="mb-1" style="font-weight:800;">{{ $kandidat->nama_kandidat }}</h1>
            <p class="text-muted mb-0">Detail lengkap kandidat</p>
        </div>
        
    </div>

    <div class="card kandidat-detail-card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-4 kandidat-sidebar">
                    <div class="shadow-sm p-3 bg-white rounded">
                        @if($kandidat->foto)
                            <img src="{{ asset('storage/' . $kandidat->foto) }}" alt="{{ $kandidat->nama_kandidat }}" class="kandidat-photo w-100 mb-3">
                        @else
                            <div class="w-100" style="height:320px; background:#f1f5f9; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-user-tie" style="font-size:48px; color:#cbd5e1;"></i>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="badge bg-primary">Suara: {{ $kandidat->voting_count ?? 0 }}</span>
                            <small class="text-muted">ID: {{ $kandidat->id }}</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="p-3 bg-white shadow-sm rounded">
                        <h5 class="mb-2" style="font-weight:700;">Visi</h5>
                        <p class="kandidat-meta">{{ $kandidat->visi }}</p>

                        <h5 class="mt-4 mb-2" style="font-weight:700;">Misi</h5>
                        <p class="kandidat-meta" style="white-space:pre-line;">{{ $kandidat->misi }}</p>

                        <div class="mt-4 d-flex gap-2">
                            @if(!isset($sudahVoting) || !$sudahVoting)
                                <button class="btn btn-success" onclick="openConfirmModalDetail({{ $kandidat->id }}, '{{ addslashes($kandidat->nama_kandidat) }}')">
                                    <i class="fas fa-check-circle"></i> Pilih Kandidat Ini
                                </button>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-lock"></i> Voting Selesai
                                </button>
                            @endif

                            <a href="{{ route('voting.index') }}" class="btn btn-outline-primary">Kembali ke Voting</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function openConfirmModalDetail(kandidatId, kandidatName) {
        // create or fill detail modal
        var existing = document.getElementById('confirmVoteModalDetail');
        if (!existing) {
            var modalHtml = `
            <div class="modal fade modal-confirm" id="confirmVoteModalDetail" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-shield-alt"></i> Konfirmasi Pilihan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p style="font-size:14px; color:#64748b; margin-bottom:20px;">Anda akan memilih kandidat berikut:</p>
                            <div class="modal-candidate-preview">
                                <div class="modal-candidate-avatar" id="modalAvatarInitialDetail">A</div>
                                <div>
                                    <div class="modal-candidate-name" id="modalCandidateNameDetail">Nama Kandidat</div>
                                    <div class="modal-candidate-sub">Kandidat Ketua Senat Fakultas</div>
                                </div>
                            </div>
                            <div class="modal-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Pilihan <strong>tidak dapat diubah</strong> setelah dikonfirmasi. Pastikan Anda sudah memilih dengan tepat.</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-cancel-vote btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <form id="voteFormDetail" method="POST" action="{{ route('voting.store') }}" style="flex:1; display:flex;">
                                @csrf
                                <input type="hidden" name="kandidat_id" id="voteKandidatIdDetail">
                                <button type="submit" class="btn btn-primary">Ya, Pilih Sekarang!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>`;
            var div = document.createElement('div');
            div.innerHTML = modalHtml;
            document.body.appendChild(div);
        }

        document.getElementById('voteKandidatIdDetail').value = kandidatId;
        document.getElementById('modalCandidateNameDetail').textContent = kandidatName;
        document.getElementById('modalAvatarInitialDetail').textContent = kandidatName.charAt(0).toUpperCase();
        var modalEl = document.getElementById('confirmVoteModalDetail');
        var modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
@endsection
