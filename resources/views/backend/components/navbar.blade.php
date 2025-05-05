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
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link d-flex align-items-center" href="#" role="button" data-toggle="dropdown">
                                    <span class="mr-2 font-weight-bold">Admin</span>
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
