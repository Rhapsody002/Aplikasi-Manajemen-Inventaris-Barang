<header class="navbar navbar-expand-lg bg-white shadow-sm px-4">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        {{-- LEFT --}}
        <div class="d-flex align-items-center gap-3">
            <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
        </div>

        {{-- RIGHT --}}
        <div class="d-flex align-items-center gap-4">

            {{-- 🔔 NOTIF TUGAS --}}
            @if($notifTasks > 0)
            <a href="{{ auth()->user()->role === 'petugas'
                        ? route('tasks.my')
                        : route('tasks.index') }}"
                class="position-relative text-dark">
                <i class="feather icon-bell fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $notifTasks }}
                </span>
            </a>
            @endif

            {{-- ⚠️ STOK KRITIS --}}
            @if(($stokKritis ?? 0) > 0 && auth()->user()->role !== 'petugas')
            <a href="{{ route('barang.index') }}"
                class="position-relative text-dark">
                <i class="feather icon-alert-circle fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    {{ $stokKritis }}
                </span>
            </a>
            @endif

            {{-- USER --}}
            <div class="dropdown">
                <a class="d-flex align-items-center gap-2 dropdown-toggle"
                    href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->foto_profil
                        ? asset('storage/'.auth()->user()->foto_profil)
                        : asset('assets/images/user/default.png') }}"
                        class="rounded-circle"
                        width="36"
                        height="36">
                    <span class="fw-semibold">{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end p-3">
                    <div class="text-center mb-2">
                        <strong>{{ auth()->user()->name }}</strong><br>
                        <small class="text-muted text-capitalize">
                            {{ auth()->user()->role }}
                        </small>
                    </div>

                    <hr>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger w-100">
                            <i class="feather icon-log-out"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>