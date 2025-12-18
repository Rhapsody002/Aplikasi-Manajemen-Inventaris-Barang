<nav class="pcoded-navbar menupos-fixed menu-light brand-blue">
    <div class="navbar-wrapper">

        {{-- BRAND --}}
        <div class="navbar-brand header-logo">
            <a href="{{ route('dashboard') }}" class="b-brand">

                {{-- LOGO --}}
                <div class="logo-box">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
                </div>

                {{-- TEXT --}}
                <div class="brand-text">
                    <span class="b-title">Mega Manunggal

                    </span>
                </div>

                <!-- TOGGLE (INI YANG KAMU KEHILANGAN) -->
                <a class="mobile-menu" id="mobile-collapse" href="#!">
                    <span></span>
                </a>
            </a>
        </div>
        {{-- USER PROFILE --}}


        {{-- MENU --}}
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
                <li class="nav-item">
                    <a href="{{ route('barang.index') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-box"></i>
                        </span>
                        <span class="pcoded-mtext">Barang</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-layers"></i>
                        </span>
                        <span class="pcoded-mtext">Kategori</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role === 'admin' || Auth::user()->role === 'petugas')
                <li class="nav-item">
                    <a href="{{ route('lokasi.index') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-map-pin"></i>
                        </span>
                        <span class="pcoded-mtext">Lokasi</span>
                    </a>
                </li>
                @endif


                @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                        <span class="pcoded-mtext">User</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>