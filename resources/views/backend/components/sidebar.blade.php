<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-uppercase fs-6 fw-bold text-white">Main Menu</li>

            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="ti-home me-2 icon-lg"></i>
                    <span class="custom-font-sidebar nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow d-flex align-items-center fs-5" href="javascript:void()" aria-expanded="false">
                    <i class="ti-agenda me-2 icon-lg"></i>
                    <span class="custom-font-sidebar nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('laporan_proses') }}" class="custom-font-sidebar fs-6">Diproses</a></li>
                    <li><a href="{{ route('selesai') }}" class="custom-font-sidebar fs-6">Selesai</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('rekapan') }}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="ti-folder me-2 icon-lg"></i>
                    <span class="custom-font-sidebar nav-text">Rekapan</span>
                </a>
            </li>

            <li>
                <a href="{{ route('informasi.index') }}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="ti-info-alt me-2 icon-lg"></i>
                    <span class="custom-font-sidebar nav-text">Informasi</span>
                </a>
            </li>
        </ul>
    </div>
</div>
