<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header">
        <div class="logo-box">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Mega Manunggal">
        </div>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto align-items-center">

            {{-- USER DROPDOWN --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center profile-trigger"
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

                    <span class="fw-semibold">{{ auth()->user()->name }}</span>
                </a>

                {{-- DROPDOWN --}}
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                    {{-- TOP PROFILE --}}
                    <div class="profile-box">
                        <div class="avatar-wrapper">
                            <img src="{{ auth()->user()->foto_profil
                                ? asset('storage/'.auth()->user()->foto_profil)
                                : asset('assets/images/user/default.png') }}">
                        </div>

                        <h6 class="mt-3 mb-0 fw-bold">{{ auth()->user()->name }}</h6>
                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    <div class="profile-divider"></div>

                    {{-- LOGIN INFO --}}
                    <div class="profile-meta">
                        <span class="meta-label">Login Terakhir</span>
                        <div class="meta-value">
                            {{ auth()->user()->last_login_at
                                ? auth()->user()->last_login_at->format('d M Y, H:i')
                                : '-' }}
                        </div>
                    </div>

                    <div class="profile-divider"></div>

                    {{-- LOGOUT --}}
                    <div class="p-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger w-100">
                                <i class="feather icon-log-out mr-2"></i> Logout
                            </button>

                        </form>
                    </div>

                </div>
            </li>

        </ul>
    </div>
</header>