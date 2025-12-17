<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header d-flex align-items-center gap-2">

        <!-- TOGGLE SIDEBAR -->
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <span></span>
        </a>

        <!-- LOGO -->
        <div class="logo-box-header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
        </div>

        <span class="fw-bold text-dark">
            Mega Manunggal
        </span>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    {{ auth()->user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <span class="dropdown-item-text">
                        Role: {{ auth()->user()->role }}
                    </span>
                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>
