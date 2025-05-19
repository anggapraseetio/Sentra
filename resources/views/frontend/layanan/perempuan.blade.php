@extends('frontend.template')

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Layanan Pemberdayaan Perempuan</h2>
    <p class="text-center text-muted">Kami berkomitmen untuk mendukung perempuan dalam meningkatkan kualitas hidup, kemandirian ekonomi, dan kesejahteraan sosial</p>

    <div class="row mt-4">
        <!-- Pelatihan Keterampilan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-tools text-primary"></i> Pelatihan Keterampilan</h5>
                    <p class="card-text text-muted">Memberikan pelatihan keterampilan bagi perempuan agar lebih mandiri dan siap bersaing di dunia kerja.</p>
                </div>
            </div>
        </div>

        <!-- Dukungan UMKM Perempuan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-shop-window text-success"></i> Dukungan UMKM Perempuan</h5>
                    <p class="card-text text-muted">Membantu perempuan dalam mengembangkan usaha kecil dan menengah (UMKM) untuk meningkatkan taraf hidup.</p>
                </div>
            </div>
        </div>

        <!-- Edukasi Kesehatan Perempuan-->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-heart-pulse-fill text-danger"></i> Edukasi Kesehatan Perempuan</h5>
                    <p class="card-text text-muted">Menyediakan edukasi kesehatan, termasuk kessehatan reproduksi dan pencegahan penyakit bagi perempuan.</p>
                </div>
            </div>
        </div>

        <!-- Perlindungan hukum dan konseling -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-shield-check text-warning"></i> Perlindungan Hukum dan konseling</h5>
                    <p class="card-text text-muted">Memberikan bantuan hukum dan layanan konseling bagi perempuan yang mengalami kekerasan atau diskriminasi.</p>
                </div>
            </div>
        </div>

        <!-- Program Kepemimpinan Perempuan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-badge-fill text-info"></i> Program Kepemimpinan Perempuan</h5>
                    <p class="card-text text-muted">Mendukung perempuan untuk berpartisiapasi dalam kepemimpinan dan pengambilan keputusan di berbagai sektor.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-success btn-lg"><i class="bi bi-arrow-left-circle"></i>Kembali ke Beranda</a>
    </div>
</div>
@endsection