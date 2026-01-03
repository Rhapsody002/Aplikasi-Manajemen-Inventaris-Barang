@extends('layouts.app')

@section('title', 'Data User')

@section('content')

{{-- HEADER --}}
<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-users text-primary"></i>
        Data User
    </h4>
    <span class="text-muted">
        Manajemen akun pengguna sistem
    </span>
</div>

{{-- ACTION BAR --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div></div>

    <a href="{{ route('users.create') }}"
        class="btn btn-success btn-add-category d-inline-flex align-items-center gap-2 px-4 py-2 rounded-pill">
        <i class="feather icon-plus"></i>
        Tambah User
    </a>
</div>

{{-- GRID --}}
<div class="row">
    @forelse($users as $user)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card category-card h-100">
            <div class="card-body text-center">

                {{-- AVATAR --}}
                <div class="user-avatar-container mb-4">
                    <div class="user-avatar-bg {{ $user->role }}">
                        <img src="{{ $user->foto_profil
            ? asset('storage/'.$user->foto_profil)
            : asset('assets/images/user/default.png') }}"
                            class="user-avatar-img">
                    </div>
                </div>


                {{-- NAMA --}}
                <h5 class="fw-bold mb-0">
                    {{ $user->name }}
                </h5>

                {{-- USERNAME --}}
                <small class="text-muted d-block mb-2">
                    {{ '@'.$user->username }}
                </small>

                {{-- ROLE BADGE (LEBIH HALUS) --}}
                <span class="badge user-role
                {{ $user->role === 'admin' ? 'bg-danger' :
                   ($user->role === 'petugas' ? 'bg-primary' : 'bg-success') }}">
                    {{ ucfirst($user->role) }}
                </span>

                {{-- ACTION --}}
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="btn btn-outline-warning btn-sm px-3">
                        <i class="feather icon-edit"></i>Edit
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn btn-outline-danger btn-sm px-3"
                            onclick="return confirm('Hapus user ini?')">
                            <i class="feather icon-trash"></i>Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @empty
    <div class="col-12 text-center py-5">
        <i class="feather icon-users f-40 text-muted"></i>
        <p class="mt-2">Belum ada data user</p>
    </div>
    @endforelse
</div>

@if ($users->hasPages())
<div class="card mt-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

        {{-- INFO --}}
        <span class="text-muted small">
            Menampilkan
            <strong>{{ $users->firstItem() }}</strong> –
            <strong>{{ $users->lastItem() }}</strong>
            dari <strong>{{ $users->total() }}</strong> user
        </span>

        {{-- PAGINATION --}}
        <nav>
            <ul class="pagination pagination-sm mb-0 shadow-sm">

                {{-- PREV --}}
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $users->previousPageUrl() }}"
                        aria-label="Previous">
                        ‹
                    </a>
                </li>

                {{-- PAGE NUMBER --}}
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">
                        {{ $page }}
                    </a>
                </li>
                @endforeach

                {{-- NEXT --}}
                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link"
                        href="{{ $users->nextPageUrl() }}"
                        aria-label="Next">
                        ›
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</div>
@endif




@endsection