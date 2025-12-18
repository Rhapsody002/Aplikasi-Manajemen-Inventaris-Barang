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
        <!-- <div class="sidebar-user text-center mt-3 mb-4">

            <img src="{{ auth()->user()->avatar 
        ? asset('storage/'.auth()->user()->avatar) 
        : asset('assets/images/user/default.png') }}"
                class="rounded-circle mb-2"
                width="60"
                height="60"
                style="object-fit:cover">

            <div class="fw-semibold text-white">
                {{ auth()->user()->name }}
            </div>

            <small class="text-white-50">
                {{ auth()->user()->role }}
            </small>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-sm btn-outline-light w-100">
                    <i class="feather icon-log-out"></i> Logout
                </button>
            </form>

        </div> -->

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