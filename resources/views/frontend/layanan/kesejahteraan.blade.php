@extends('frontend.template')

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Layanan Sosial dan Bantuan Kesejahteraan</h2>
    <p class="text-center">Kami hadir untuk membantu masyarakat dalam meningkatkan kesejahteraan sosial melalui berbagai program unggulan.</p>

    <div class="row mt-4">
        <!-- Bantuan Sosial -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-heart-fill text-danger"></i> Bantuan Sosial</h5>
                    <p class="card-text">Program ini bertujuan untuk membantu keluarga prasejahtera dalam memenuhi kebutuhan dasar sehari-hari.</p>
                </div>
            </div>
        </div>

        <!-- Pelayanan Disabilitas -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-wheelchair"></i> Pelayanan Penyandang Disabilitas</h5>
                    <p class="card-text">Menyediakan layanan dan dukungan bagi penyandang disabilitas untuk meningkatkan kualitas hidup mereka.</p>
                </div>
            </div>
        </div>

        <!-- Bantuan Lansia -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-fill"></i> Santunan dan Bantuan Lansia</h5>
                    <p class="card-text">Memberikan santunan dan bantuan perawatan bagi lansia yang membutuhkan, termasuk layanan kesehatan.</p>
                </div>
            </div>
        </div>

        <!-- Rehabilitasi Sosial -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people-fill"></i> Rehabilitasi Sosial</h5>
                    <p class="card-text">Program pemulihan bagi individu atau kelompok yang mengalami masalah sosial seperti korban kekerasan dan eksploitasi.</p>
                </div>
            </div>
        </div>

        <!-- Pemberdayaan UMKM -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-briefcase-fill"></i> Pemberdayaan Ekonomi dan UMKM</h5>
                    <p class="card-text">Pelatihan untuk meningkatkan ekonomi keluarga dan mendorong kewirausahaan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-success btn-lg"><i class="bi bi-arrow-left-circle"></i>Kembali ke Beranda</a>
    </div>
</div>
@endsection