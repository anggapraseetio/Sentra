@extends('frontend.template')

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Layanan Perlindungan Anak</h2>
    <p class="text-center text-muted">Kami berkomitmen untuk melindungi hak dan kesejahteraan anak-anak melalui berbagai program unggulan</p>

    <div class="row mt-4">
        <!-- Pendampingan Anak Korban kekerasan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-shield-fill-exclamation text-danger"></i> Pendampingan Anak Korban Kekerasan</h5>
                    <p class="card-text text-muted">Memberikan perlindungan dan pendampingan bagi anak-anak yang mengalami kekerasan fisik maupun psikis.</p>
                </div>
            </div>
        </div>

        <!-- Edukasi Hak Anak -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-book-fill text-primary"></i> Edukasi Hak Anak</h5>
                    <p class="card-text text-muted">Meningkatkan kesadaran tentang hak-hak anak melalui edukasi bagi anak-anak,
                        orang tua, dan komunitas.</p>
                </div>
            </div>
        </div>

        <!-- Layanan Konseling Keluarga -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-chat-left-heart-fill text-success"></i> Layanan Konseling Keluarga</h5>
                    <p class="card-text text-muted">Menyediakan konseling bagi keluarga untuk menciptakan lingkungan yang aman dan nyaman bagi anak.</p>
                </div>
            </div>
        </div>

        <!-- Program Anak Berprestasi -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-award-fill text-warning"></i> Program Anak Berprestasi</h5>
                    <p class="card-text text-muted">Memberikan dukungan bagi anak-anak berbakat agar berkembang dan mencapai prestasi terbaiknya.</p>
                </div>
            </div>
        </div>

        <!-- Respon Cepat Kasus Darurat -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-bell-fill text-info"></i> Respon Cepat Kasus Darurat</h5>
                    <p class="card-text text-muted">Tim kami siap merespons cepat dalam menangani kasus darurat yang membahayakan anak-anak.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/index" class="btn btn-primary btn-lg"><i class="bi bi-arrow-left-circle"></i>Kembali ke Beranda</a>
    </div>
</div>
@endsection