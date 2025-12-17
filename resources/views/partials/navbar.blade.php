<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header">

        <!-- TOGGLE
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <span></span> -->
        </a>
         {{-- LOGO --}}
                <div class="logo-box">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
                </div>
        <!-- BRAND -->
        <!-- <a href="{{ route('dashboard') }}" class="b-brand">
            <div class="logo-box-header">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
            </div>
            <span class="b-title">Mega Manunggal</span>
        </a> -->
    </div>


    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <i class="feather icon-user"></i> {{ auth()->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-danger"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
