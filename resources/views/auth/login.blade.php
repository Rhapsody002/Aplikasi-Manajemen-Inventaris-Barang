@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-box">
    <h2>Login</h2>
    <p>Silakan login untuk masuk ke sistem gudang</p>

    {{-- Error login --}}
    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <input
            type="text"
            name="username"
            placeholder="Username"
            value="{{ old('username') }}"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit" class="btn">Log In</button>
    </form>
</div>
@endsection
