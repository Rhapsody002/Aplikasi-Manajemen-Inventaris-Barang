<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">

    {{-- LEFT: LOGO --}}
    <div class="m-header d-flex align-items-center">
        <div class="logo-box d-flex align-items-center">
            <img src="{{ asset('assets/images/logo.png') }}"
                alt="Mega Manunggal"
                style="height:40px">
        </div>
    </div>

    <div class="collapse navbar-collapse">

        {{-- PAGE TITLE --}}
        <div class="navbar-page-info d-none d-md-flex align-items-center ms-3">
            <h6 class="mb-0 fw-bold">
                @yield('title', 'Dashboard')
            </h6>
        </div>

        {{-- RIGHT SIDE --}}
        <ul class="navbar-nav ms-auto align-items-center">

            {{-- DATE --}}
            <li class="nav-item d-none d-lg-flex me-3">
                <span class="badge bg-light text-dark border px-3 py-2">
                    <i class="feather icon-calendar me-1"></i>
                    {{ now()->format('d M Y') }}
                </span>
            </li>

            {{-- NOTIFICATION (DUMMY) --}}
            <li class="nav-item dropdown me-3">
                <a class="nav-link position-relative" href="#">
                    <i class="feather icon-bell fs-5"></i>

                    {{-- BADGE --}}
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        2
                    </span>
                </a>
            </li>

            {{-- USER DROPDOWN --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 profile-trigger"
                    href="#"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">

                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle"
                        width="36"
                        height="36"
                        style="object-fit:cover">

                    <span class="fw-semibold d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                {{-- DROPDOWN MENU --}}
                <div class="dropdown-menu dropdown-menu-right profile-dropdown shadow">

                    {{-- PROFILE TOP --}}
                    <div class="profile-box text-center p-3">
                        <div class="avatar-wrapper mb-2">
                            <img src="{{ auth()->user()->foto_profil
                                ? asset('storage/'.auth()->user()->foto_profil)
                                : asset('assets/images/user/default.png') }}"
                                class="rounded-circle"
                                width="72"
                                height="72"
                                style="object-fit:cover">
                        </div>

                        <h6 class="fw-bold mb-0">
                            {{ auth()->user()->name }}
                        </h6>
                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    <div class="dropdown-divider"></div>

                    {{-- LOGIN INFO --}}
                    <div class="px-3 py-2 small text-muted">
                        <div>Login Terakhir</div>
                        <strong>
                            {{ auth()->user()->last_login_at
                                ? auth()->user()->last_login_at->format('d M Y, H:i')
                                : '-' }}
                        </strong>
                    </div>

                    <div class="dropdown-divider"></div>

                    {{-- LOGOUT --}}
                    <div class="p-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger w-100">
                                <i class="feather icon-log-out me-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </li>

        </ul>
    </div>
</header>