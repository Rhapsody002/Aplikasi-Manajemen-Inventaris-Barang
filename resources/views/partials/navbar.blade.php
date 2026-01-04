<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">

    {{-- LEFT --}}
    <div class="m-header d-flex align-items-center gap-2">
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <span></span>
        </a>

        <span class="fw-bold text-dark ms-2">
            @yield('title', 'Dashboard')
        </span>
    </div>

    {{-- RIGHT --}}
    @auth
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-center gap-3">

            {{-- NOTIFICATION --}}
            <li class="nav-item dropdown">
                <a class="nav-link"
                    href="#"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="feather icon-bell"></i>

                    @if(($notifTasks ?? 0) + ($stokKritis ?? 0) > 0)
                    <span class="badge badge-danger badge-dot">
                        {{ ($notifTasks ?? 0) + ($stokKritis ?? 0) }}
                    </span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <h6 class="dropdown-header">Notifikasi</h6>

                    @if(($notifTasks ?? 0) > 0)
                    <a class="dropdown-item" href="{{ route('tasks.my') }}">
                        <i class="feather icon-clipboard me-2"></i>
                        {{ $notifTasks }} tugas pending
                    </a>
                    @endif

                    @if(($stokKritis ?? 0) > 0)
                    <a class="dropdown-item" href="{{ route('barang.index') }}">
                        <i class="feather icon-alert-circle me-2"></i>
                        {{ $stokKritis }} stok kritis
                    </a>
                    @endif

                    @if(($notifTasks ?? 0) === 0 && ($stokKritis ?? 0) === 0)
                    <div class="dropdown-item text-muted small text-center">
                        Tidak ada notifikasi
                    </div>
                    @endif
                </div>
            </li>

            {{-- USER --}}
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center gap-2"
                    href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle"
                        width="36"
                        height="36"
                        style="object-fit:cover">
                    <span class="fw-semibold">{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="feather icon-user me-2"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="feather icon-log-out me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>
    @endauth

</header>