<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">

    {{-- LEFT : PAGE TITLE --}}
    <div class="d-flex align-items-center">
        <h6 class="mb-0 fw-bold">
            @yield('title', 'Dashboard')
        </h6>
    </div>

    {{-- RIGHT --}}
    <ul class="navbar-nav ml-auto d-flex align-items-center">

        {{-- DATE --}}
        <li class="nav-item mr-3">
            <span class="badge badge-light border px-3 py-2">
                <i class="feather icon-calendar mr-1"></i>
                {{ now()->format('d M Y') }}
            </span>
        </li>

        {{-- NOTIFICATION --}}
        <li class="nav-item dropdown mr-3">
            <a class="nav-link position-relative" href="#">
                <i class="feather icon-bell"></i>
                <span class="badge badge-danger position-absolute"
                    style="top:-4px; right:-6px;">
                    2
                </span>
            </a>
        </li>

        {{-- USER --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                data-toggle="dropdown">

                <img src="{{ auth()->user()->foto_profil
                    ? asset('storage/'.auth()->user()->foto_profil)
                    : asset('assets/images/user/default.png') }}"
                    class="rounded-circle"
                    width="36"
                    height="36"
                    style="object-fit:cover">

                <span class="ml-2 fw-semibold d-none d-md-inline">
                    {{ auth()->user()->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow">

                {{-- PROFILE --}}
                <div class="text-center p-3">
                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle mb-2"
                        width="72"
                        height="72"
                        style="object-fit:cover">

                    <h6 class="mb-0 fw-bold">
                        {{ auth()->user()->name }}
                    </h6>
                    <small class="text-muted text-capitalize">
                        {{ auth()->user()->role }}
                    </small>
                </div>

                <div class="dropdown-divider"></div>

                {{-- LOGIN INFO --}}
                <div class="px-3 small text-muted">
                    Login terakhir<br>
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
                        <button class="btn btn-danger btn-block">
                            <i class="feather icon-log-out mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </li>

    </ul>
</header>