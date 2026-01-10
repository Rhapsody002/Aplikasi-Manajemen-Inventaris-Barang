<nav class="pcoded-navbar menupos-fixed menu-light brand-blue">
    <div class="navbar-wrapper">

        {{-- BRAND --}}
        <div class="navbar-brand header-logo">
            <a href="{{ route('dashboard') }}" class="b-brand">
                <div class="logo-box">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
                </div>
                <div class="brand-text">
                    <span class="b-title">Mega Manunggal</span>
                </div>
                <a class="mobile-menu" id="mobile-collapse" href="#!">
                    <span></span>
                </a>
            </a>
        </div>

        {{-- MENU --}}
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">

                {{-- DASHBOARD (SEMUA ROLE) --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- ================= ADMIN & MANAJER (READ ONLY) ================= --}}
                @if(in_array(auth()->user()->role, ['admin','manajer']))

                <li class="nav-item">
                    <a href="{{ route('barang.index') }}" class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                        <span class="pcoded-mtext">Barang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                        <span class="pcoded-mtext">Kategori</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('lokasi.index') }}" class="nav-link {{ request()->routeIs('lokasi.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-map-pin"></i></span>
                        <span class="pcoded-mtext">Lokasi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                        <span class="pcoded-mtext">Supplier</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                        <span class="pcoded-mtext">Data Tugas</span>
                    </a>
                </li>
                @endif

                {{-- ================= PETUGAS ================= --}}
                @if(auth()->user()->role === 'petugas')
                <li class="nav-item">
                    <a href="{{ route('tasks.my') }}" class="nav-link {{ request()->routeIs('tasks.my') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-check-square"></i></span>
                        <span class="pcoded-mtext">Tugas Saya</span>
                    </a>
                </li>
                @endif

                {{-- ================= HISTORY (SEMUA ROLE) ================= --}}
                <li class="nav-item">
                    <a href="{{ route('history.index') }}" class="nav-link {{ request()->routeIs('history.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                        <span class="pcoded-mtext">History</span>
                    </a>
                </li>

                {{-- ================= USER (ADMIN ONLY) ================= --}}
                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">User</span>
                    </a>
                </li>
                @endif

                {{-- ================= PROFILE ================= --}}
                @if(in_array(auth()->user()->role, ['manajer','petugas']))
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Profil Saya</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>