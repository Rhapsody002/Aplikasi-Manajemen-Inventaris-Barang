@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header mb-4">
    <h4 class="page-title d-flex align-items-center gap-2">
        <i class="feather icon-user text-primary"></i>
        Edit User
    </h4>
    <span class="text-muted">
        Perbarui data akun pengguna
    </span>
</div>

<div class="card category-card">
    <div class="card-body">

        <form action="{{ route('users.update', $user->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('users.form')

            <div class="d-flex gap-2">
                <button class="btn btn-success px-4">
                    <i class="feather icon-save"></i>
                    Update
                </button>
                <a href="{{ route('users.index') }}"
                    class="btn btn-secondary px-4">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-avatar').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush


@endsection