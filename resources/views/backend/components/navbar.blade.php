        {{-- NAV --}}
        <div class="nav-header">
            <a class="brand-logo">
                <img class="logo-abbr" src="{{ 'admin/assets_2/images/logo_nganjuk.png' }}" alt="">
                <img class="logo-compact" src="{{ 'admin/assets_2/images/dinsos.png' }}" alt="">
                <img class="brand-title" src="{{ 'admin/assets_2/images/dinsos.png' }}" alt="">
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
                                    <i class="mdi mdi-bell"></i>
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
                                <a class="nav-link d-flex align-items-center" href="#" role="button" data-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-lg"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form method="POST" action="{{ route('logout') }}">
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
