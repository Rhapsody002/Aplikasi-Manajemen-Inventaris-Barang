<header class="navbar pcoded-header navbar-expand-lg headerpos-fixed">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#">
            <span></span>
        </a>
    </div>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto align-items-center">

            {{-- NOTIF TUGAS --}}
            @if($notifTasks > 0)
            <li class="nav-item">
                <a class="nav-link position-relative" href="{{ route('tasks.my') }}">
                    <i class="feather icon-bell"></i>
                    <span class="badge badge-danger badge-dot">
                        {{ $notifTasks }}
                    </span>
                </a>
            </li>
            @endif

            {{-- STOK KRITIS --}}
            @if($stokKritis > 0)
            <li class="nav-item">
                <a class="nav-link position-relative" href="{{ route('barang.index') }}">
                    <i class="feather icon-alert-circle text-danger"></i>
                    <span class="badge badge-danger badge-dot">
                        {{ $stokKritis }}
                    </span>
                </a>
            </li>
            @endif

            {{-- USER --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                    data-toggle="dropdown"
                    href="#">

                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle mr-2"
                        width="36"
                        height="36"
                        style="object-fit:cover">

                    <span class="fw-semibold">
                        {{ auth()->user()->name }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="feather icon-user mr-2"></i> Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item text-danger">
                            <i class="feather icon-log-out mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>
</header>