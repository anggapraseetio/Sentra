@extends('frontend.template')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-3">Layanan Konsultasi dan Edukasi</h2>
    <p class="text-center text-muted">Kami menyediakan berbagai layanan konsultasi dan edukasi untuk meningkatkan pengetahuan dan kesejahteraan masyarakat.</p>

    <div class="row mt-4">
        <!-- Konsultasi Psikologi -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-emoji-smile text-primary"></i> Konsultasi Psikologi</h5>
                    <p class="card-text text-muted">Layanan konseling untuk kesehatan mental dan emosional, termasuk stres, kecemasan, dan permasalahan pribadi.</p>
                </div>
            </div>
        </div>

        <!-- Edukasi Kesehatan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-heart-pulse text-danger"></i> Edukasi Kesehatan</h5>
                    <p class="card-text text-muted">Memberikan informasi dan pelatihan tentang pola hidup sehat, nutrisi, dan pencegahan penyakit.</p>
                </div>
            </div>
        </div>

        <!-- Konsultasi Hukum -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-shield-check text-warning"></i> Konsultasi Hukum</h5>
                    <p class="card-text text-muted">Membantu masyarakat memahami hak dan kewajiban hukum mereka serta memberikan pendampingan dalam permasalahan hukum.</p>
                </div>
            </div>
        </div>

        <!-- Edukasi Keuangan -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-cash-stack text-success"></i> Edukasi Keuangan</h5>
                    <p class="card-text text-muted">Memberikan pelatihan manajemen keuangan, perencanaan anggaran, dan strategi investasi yang bijak.</p>
                </div>
            </div>
        </div>

        <!-- Konsultasi Karir dan Pengembangan Diri -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-workspace text-info"></i> Konsultasi Karir</h5>
                    <p class="card-text text-muted">Membantu individu mengembangkan keterampilan, merencanakan karir, dan meningkatkan peluang kerja.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/index" class="btn btn-primary btn-lg"><i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda</a>
    </div>
</div>
@endsection
