@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div class="page-header mb-4">
    <h4 class="fw-bold">Profil Saya</h4>
    <span class="text-muted">Informasi akun Anda</span>
</div>

<div class="card shadow-sm">
    <div class="card-body text-center">

        <img src="{{ $user->foto_profil
            ? asset('storage/'.$user->foto_profil)
            : asset('assets/images/user/default.png') }}"
            class="rounded-circle mb-3"
            width="120" height="120"
            style="object-fit: cover">

        <h5 class="fw-bold">{{ $user->name }}</h5>
        <span class="role-badge role-{{ $user->role }}">
            {{ strtoupper($user->role) }}
        </span>


        <hr>

        <p class="mb-1">
            <strong>Username:</strong> {{ $user->username }}
        </p>

        <p class="mb-1">
            <strong>Login Terakhir:</strong>
            {{ $user->last_login_at
                ? $user->last_login_at->format('d M Y, H:i')
                : '-' }}
        </p>

        <a href="{{ route('profile.edit') }}"
            class="btn btn-outline-primary mt-3">
            <i class="feather icon-edit"></i>
            Edit Profil
        </a>
    </div>
</div>

@endsection