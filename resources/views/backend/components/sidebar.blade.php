<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
    
            <li>
                <a href="javascript:void()" aria-expanded="false">
                    <i class="icon icon-app-store"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon icon-layout-25"></i><span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('laporan_proses')}}">Diproses</a></li>
                    <li><a href="table-datatable-basic.html">Selesai</a></li>
                </ul>
            </li>
    
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon icon-app-store"></i><span class="nav-text">Informasi</span>
                </a>
            </li>
    
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon icon-layout-25"></i><span class="nav-text">Rekapan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                    <li><a href="table-datatable-basic.html">Datatable</a></li>
                </ul>
            </li>
    

            <li class="mt-3 logout-btn-container">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning logout-btn d-flex align-items-center justify-content-center">
                        <span class="logout-text ms-2">Logout</span>
                    </button>
                </form>
            </li>
            
        </ul>
    </div>    

</div>
