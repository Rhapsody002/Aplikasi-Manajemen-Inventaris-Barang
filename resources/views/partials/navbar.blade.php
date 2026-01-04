<header class="navbar pcoded-header navbar-expand-lg headerpos-fixed">

    {{-- LEFT --}}
    <div class="m-header d-flex align-items-center">
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <span></span>
        </a>
    </div>

    {{-- RIGHT --}}
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto align-items-center">

            {{-- 🔔 NOTIFICATION --}}
            <li class="nav-item dropdown mr-3">
                <a class="nav-link position-relative"
                    href="#"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">

                    <i class="feather icon-bell"></i>

                    @if(($notifTasks ?? 0) + ($stokKritis ?? 0) > 0)
                    <span class="badge badge-danger badge-dot">
                        {{ ($notifTasks ?? 0) + ($stokKritis ?? 0) }}
                    </span>
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

                    @if(($notifTasks ?? 0) + ($stokKritis ?? 0) === 0)
                    <div class="dropdown-item text-muted small text-center">
                        Tidak ada notifikasi
                    </div>
                    @endif
                </div>
            </li>

            {{-- 👤 USER --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                    href="#"
                    data-toggle="dropdown">

                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle mr-2"
                        width="36" height="36"
                        style="object-fit:cover">

                    <span class="fw-semibold">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                    {{-- PROFILE TOP --}}
                    <div class="profile-box text-center">
                        <div class="avatar-wrapper">
                            <img src="{{ auth()->user()->foto_profil
                                ? asset('storage/'.auth()->user()->foto_profil)
                                : asset('assets/images/user/default.png') }}">
                        </div>

                        <div class="fw-bold mt-2">
                            {{ auth()->user()->name }}
                        </div>
                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    <div class="profile-divider"></div>

                    {{-- LOGIN INFO --}}
                    <div class="profile-meta">
                        <div class="meta-label">Login Terakhir</div>
                        <div class="meta-value">
                            {{ auth()->user()->last_login_at
                                ? auth()->user()->last_login_at->format('d M Y, H:i')
                                : '-' }}
                        </div>
                    </div>

                    <div class="profile-divider"></div>

                    {{-- LOGOUT --}}
                    <form action="{{ route('logout') }}" method="POST" class="p-3">
                        @csrf
                        <button class="btn btn-danger w-100">
                            <i class="feather icon-log-out mr-2"></i> Logout
                        </button>
                    </form>

                </div>
            </li>

        </ul>
    </div>

</header>