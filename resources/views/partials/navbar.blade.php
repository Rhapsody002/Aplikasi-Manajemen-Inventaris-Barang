<header class="app-header">

    {{-- LEFT --}}
    <div class="header-left">
        <h5 class="page-title">
            @yield('title', 'Dashboard')
        </h5>
    </div>

    {{-- RIGHT --}}
    <div class="header-right">

        {{-- 🔔 NOTIFICATION --}}
        <div class="dropdown">
            <a href="#" class="header-icon" data-toggle="dropdown">
                <i class="feather icon-bell"></i>

                @if(($notifTasks ?? 0) > 0 || ($stokKritis ?? 0) > 0)
                    <span class="badge-dot bg-danger"></span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-right notification-dropdown">

                <h6 class="dropdown-header">Notifikasi</h6>

                {{-- TUGAS --}}
                @if(($notifTasks ?? 0) > 0)
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ auth()->user()->role === 'petugas'
                                ? route('tasks.my')
                                : route('tasks.index') }}">
                        <i class="feather icon-clipboard text-warning mr-2"></i>
                        <div>
                            <strong>{{ $notifTasks }}</strong> tugas pending
                        </div>
                    </a>
                @endif

                {{-- STOK KRITIS --}}
                @if(($stokKritis ?? 0) > 0)
                    <a class="dropdown-item d-flex align-items-center"
                       href="{{ route('barang.index') }}">
                        <i class="feather icon-alert-circle text-danger mr-2"></i>
                        <div>
                            <strong>{{ $stokKritis }}</strong> stok kritis
                        </div>
                    </a>
                @endif

                {{-- EMPTY --}}
                @if(($notifTasks ?? 0) === 0 && ($stokKritis ?? 0) === 0)
                    <div class="dropdown-item text-muted text-center small">
                        Tidak ada notifikasi
                    </div>
                @endif

            </div>
        </div>

        {{-- 👤 USER --}}
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
