        {{-- NAV --}}
        <div class="nav-header">
            <a class="brand-logo">
                <img class="logo-abbr" src="{{ asset('admin/assets_2/images/logo_nganjuk.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('admin/assets_2/images/dinsos.png') }}" alt="">
                <img class="brand-title" src="{{ asset('admin/assets_2/images/dinsos.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell mdi-24px"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Alex</strong> Mengirim Laporan
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link d-flex align-items-center" href="#" role="button"
                                    data-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-lg"></i>
                                    <span class="custom-font">Admin</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('resetpw') }}" class="dropdown-item">
                                        <i class="fas fa-key"></i>
                                        <span class="ml-2">Reset Password</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}"
                                        onsubmit="return confirm('Apakah Anda yakin ingin logout?');">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span class="ml-2">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
