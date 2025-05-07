<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first text-uppercase fs-6 fw-bold text-white">Main Menu</li>

            <li>
                <a href="{{route('dashboard')}}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="fa-solid fa-home me-2 fa-lg"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow d-flex align-items-center fs-5" href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-book me-2 fa-lg"></i>
                    <span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('laporan_proses')}}" class="fs-6">Diproses</a></li>
                    <li><a href="{{route('laporan_selesai')}}" class="fs-6">Selesai</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('informasi')}}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="fa-solid fa-circle-info me-2 fa-lg"></i>
                    <span class="nav-text">Informasi</span>
                </a>
            </li>

            <li>
                <a href="{{route('rekapan')}}" aria-expanded="false" class="d-flex align-items-center fs-5">
                    <i class="fa-solid fa-folder-open me-2 fa-lg"></i>
                    <span class="nav-text">Rekapan</span>
                </a>
            </li>
        </ul>
    </div>
</div>
