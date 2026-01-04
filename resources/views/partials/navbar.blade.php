<header class="app-header">

    {{-- LEFT: PAGE TITLE --}}
    <div class="header-left">
        <h5 class="page-title">
            @yield('title', 'Dashboard')
        </h5>
    </div>

    {{-- RIGHT --}}
    <div class="header-right">

        {{-- NOTIFICATION --}}
        <div class="dropdown">
            <a href="#" class="header-icon" data-toggle="dropdown">
                <i class="feather icon-bell"></i>

                @if(($notifTasks ?? 0) > 0 || ($stokKritis ?? 0) > 0)
                <span class="badge-dot"></span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-right notification-dropdown">

                <h6 class="dropdown-header">Notifikasi</h6>

                @if(($notifTasks ?? 0) > 0)
                <a class="dropdown-item"
                    href="{{ auth()->user()->role === 'petugas'
                                ? route('tasks.my')
                                : route('tasks.index') }}">
                    <i class="feather icon-clipboard text-warning mr-2"></i>
                    {{ $notifTasks }} tugas pending
                </a>
                @endif

                @if(($stokKritis ?? 0) > 0)
                <a class="dropdown-item" href="{{ route('barang.index') }}">
                    <i class="feather icon-alert-circle text-danger mr-2"></i>
                    {{ $stokKritis }} stok kritis
                </a>
                @endif

                @if(($notifTasks ?? 0) === 0 && ($stokKritis ?? 0) === 0)
                <div class="dropdown-item text-muted small text-center">
                    Tidak ada notifikasi
                </div>
                @endif

            </div>
        </div>

        {{-- USER --}}
        <div class="dropdown">
            <a href="#" class="user-trigger" data-toggle="dropdown">
                <img src="{{ auth()->user()->foto_profil
                    ? asset('storage/'.auth()->user()->foto_profil)
                    : asset('assets/images/user/default.png') }}">
                <span>{{ auth()->user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.index') }}" class="dropdown-item">
                    <i class="feather icon-user"></i> Profile
                </a>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger">
                        <i class="feather icon-log-out"></i> Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>