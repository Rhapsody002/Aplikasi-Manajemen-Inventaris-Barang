<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="pcoded">

    <div class="pcoded-wrapper">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Navbar --}}
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

    {{-- JS CORE --}}
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- DELETE CONFIRM KATEGORI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;

                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: `Kategori "${name}" akan dihapus permanen`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#9ca3af',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });
                });
            });
        });
    </script>

    {{-- IMAGE PREVIEW --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{-- DELETE CONFIRM LOKASI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const name = this.dataset.name;

                    Swal.fire({
                        title: 'Hapus Lokasi?',
                        html: `<b>${name}</b> akan dihapus permanen`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#9ba4ad',
                        confirmButtonText: '<i class="feather icon-trash"></i> Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        focusCancel: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });

                });
            });

        });
    </script>


    {{-- DELETE CONFIRM BARANG --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const name = this.dataset.name;

                    Swal.fire({
                        title: 'Hapus Barang?',
                        text: `Barang "${name}" akan dihapus permanen`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e3342f',
                        cancelButtonColor: '#9ba4ad',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });

                });
            });

        });
    </script>

    <script>
        feather.replace()
    </script>

</body>

</html>