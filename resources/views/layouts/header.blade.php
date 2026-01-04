<header class="navbar pcoded-header navbar-expand-lg headerpos-fixed">

    {{-- LEFT --}}
    <div class="d-flex align-items-center gap-3">

        {{-- TOGGLE SIDEBAR --}}
        <a class="mobile-menu" id="mobile-collapse" href="#!">
            <span></span>
        </a>

        <span class="fw-bold fs-5">
            @yield('page-title', 'Dashboard')
        </span>
    </div>

    {{-- RIGHT --}}
    <ul class="navbar-nav ms-auto align-items-center gap-3">

        {{-- 🔔 NOTIFICATION --}}
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-bs-toggle="dropdown">
                <i class="feather icon-bell fs-5"></i>

                @if(($notifTasks ?? 0) + ($stokKritis ?? 0) > 0)
                <span class="badge bg-danger badge-dot">
                    {{ ($notifTasks ?? 0) + ($stokKritis ?? 0) }}
                </span>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-end p-0" style="width:280px">

                <div class="p-3 border-bottom fw-semibold">
                    Notifikasi
                </div>

                {{-- TASK --}}
                @if(($notifTasks ?? 0) > 0)
                <a class="dropdown-item d-flex justify-content-between"
                    href="{{ route('tasks.index') }}">
                    Tugas Pending
                    <span class="badge bg-warning">{{ $notifTasks }}</span>
                </a>
                @endif

                {{-- STOK --}}
                @if(($stokKritis ?? 0) > 0)
                <a class="dropdown-item d-flex justify-content-between"
                    href="{{ route('barang.index') }}">
                    Stok Kritis
                    <span class="badge bg-danger">{{ $stokKritis }}</span>
                </a>
                @endif

                @if(($notifTasks ?? 0) + ($stokKritis ?? 0) === 0)
                <div class="dropdown-item text-muted text-center py-3">
                    Tidak ada notifikasi
                </div>
                @endif
            </div>
        </li>

        {{-- 👤 USER --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                href="#"
                data-bs-toggle="dropdown">

                <img src="{{ auth()->user()->foto_profil
                    ? asset('storage/'.auth()->user()->foto_profil)
                    : asset('assets/images/user/default.png') }}"
                    class="rounded-circle"
                    width="36"
                    height="36"
                    style="object-fit:cover">

                <span class="fw-semibold">
                    {{ auth()->user()->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                <div class="profile-box">
                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle mb-2"
                        width="60" height="60">

                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                    <small class="text-muted text-capitalize">
                        {{ auth()->user()->role }}
                    </small>
                </div>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST" class="px-3 pb-2">
                    @csrf
                    <button class="btn btn-danger w-100">
                        <i class="feather icon-log-out"></i> Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>
</header>