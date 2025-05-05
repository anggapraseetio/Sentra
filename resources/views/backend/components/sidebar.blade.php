<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
    
            <li>
                <a href="{{route('dashboard')}}" aria-expanded="false">
                    <i class="icon icon-app-store"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon ti-book"></i><span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('laporan_proses')}}">Diproses</a></li>
                    <li><a href="{{route('selesai')}}">Selesai</a></li>
                </ul>
            </li>
    
            <li>
                <a href="{{route('informasi')}}" aria-expanded="false">
                    <i class="icon ti-info-alt"></i><span class="nav-text">Informasi</span>
                </a>
            </li>
            <li>
                <a href="{{route('notifikasi')}}" aria-expanded="false">
                    <i class="icon ti-bell"></i><span class="nav-text">Notifikasi</span>
                </a>
            </li>
            <li>
                <a href="{{route('rekapan')}}" aria-expanded="false">
                    <i class="icon ti-folder"></i><span class="nav-text">Rekapan</span>
                </a>
            </li>       
        </ul>
    </div>    

</div>
