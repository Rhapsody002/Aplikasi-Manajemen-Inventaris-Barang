<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Flash Able CSS --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="pcoded">

{{-- Loader --}}
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>

<div class="pcoded-wrapper">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Header (Flash Able) --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const toggle = document.getElementById("mobile-collapse");

    if (localStorage.getItem("sidebar") === "collapsed") {
        body.classList.add("navbar-collapsed");
    }

    toggle.addEventListener("click", function () {
        setTimeout(() => {
            if (body.classList.contains("navbar-collapsed")) {
                localStorage.setItem("sidebar", "collapsed");
            } else {
                localStorage.setItem("sidebar", "open");
            }
        }, 200);
    });
});
</script>

<script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>


</body>
</html>
