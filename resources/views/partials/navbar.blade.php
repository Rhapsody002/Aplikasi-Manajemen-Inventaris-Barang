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
                <a class="nav-link position-relative notif-trigger"
                    href="#"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">

                    <i class="feather icon-bell"></i>

                    @if(($notifTasks ?? 0) + ($stokKritis ?? 0) > 0)
                    <span class="badge-dot">
                        {{ ($notifTasks ?? 0) + ($stokKritis ?? 0) }}
                    </span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-right notification-dropdown">

                    <div class="notif-header">
                        Notifikasi
                    </div>

                    {{-- TASK --}}
                    @if(($notifTasks ?? 0) > 0)
                    <a class="notif-item"
                        href="{{ auth()->user()->role === 'petugas'
                                ? route('tasks.my')
                                : route('tasks.index') }}">

                        <div class="notif-icon warning">
                            <i class="feather icon-clipboard"></i>
                        </div>

                        <div class="notif-content">
                            <div class="notif-title">Tugas Pending</div>
                            <div class="notif-desc">
                                {{ $notifTasks }} tugas menunggu
                            </div>
                        </div>

                        <span class="notif-badge warning">
                            {{ $notifTasks }}
                        </span>
                    </a>
                    @endif

                    {{-- STOK KRITIS --}}
                    @if(($stokKritis ?? 0) > 0)
                    <a class="notif-item" href="{{ route('barang.index') }}">
                        <div class="notif-icon danger">
                            <i class="feather icon-alert-circle"></i>
                        </div>

                        <div class="notif-content">
                            <div class="notif-title">Stok Kritis</div>
                            <div class="notif-desc">
                                {{ $stokKritis }} barang hampir habis
                            </div>
                        </div>

                        <span class="notif-badge danger">
                            {{ $stokKritis }}
                        </span>
                    </a>
                    @endif

                    {{-- EMPTY --}}
                    @if(($notifTasks ?? 0) + ($stokKritis ?? 0) === 0)
                    <div class="notif-empty">
                        <i class="feather icon-check-circle"></i>
                        <p>Tidak ada notifikasi</p>
                    </div>
                    @endif

                </div>
            </li>

            {{-- 👤 USER --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center profile-trigger"
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

                    <div class="profile-box">
                        <div class="avatar-wrapper">
                            <img src="{{ auth()->user()->foto_profil
                                ? asset('storage/'.auth()->user()->foto_profil)
                                : asset('assets/images/user/default.png') }}">
                        </div>

                        <h6 class="mt-2 mb-0 fw-bold">
                            {{ auth()->user()->name }}
                        </h6>

                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    <div class="profile-divider"></div>

                    <div class="profile-meta">
                        <span class="meta-label">Login Terakhir</span>
                        <div class="meta-value">
                            {{ auth()->user()->last_login_at
                                ? auth()->user()->last_login_at->format('d M Y, H:i')
                                : '-' }}
                        </div>
                    </div>

                    <div class="profile-divider"></div>

                    <form action="{{ route('logout') }}" method="POST" class="p-3">
                        @csrf
                        <button class="btn btn-danger w-100">
                            <i class="feather icon-log-out mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>

</header>