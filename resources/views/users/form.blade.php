<div class="row">

    {{-- ERROR SUMMARY --}}
    @if ($errors->any())
    <div class="col-12 mb-3">
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- NAMA --}}
    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Nama</label>
        <input type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name ?? '') }}"
            required>

        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- USERNAME --}}
    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Username</label>
        <input type="text"
            name="username"
            class="form-control @error('username') is-invalid @enderror"
            value="{{ old('username', $user->username ?? '') }}"
            required>

        @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- PASSWORD --}}
    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Password</label>
        <input type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : '' }}"
            {{ isset($user) ? '' : 'required' }}>

        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- ROLE --}}
    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Role</label>
        <select name="role"
            class="form-control @error('role') is-invalid @enderror"
            required>
            <option value="">-- Pilih Role --</option>
            <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>
                Admin
            </option>
            <option value="petugas" {{ old('role', $user->role ?? '') === 'petugas' ? 'selected' : '' }}>
                Petugas
            </option>
            <option value="manajer" {{ old('role', $user->role ?? '') === 'manajer' ? 'selected' : '' }}>
                Manajer
            </option>
        </select>

        @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- FOTO PROFIL --}}
    <div class="col-12 mb-4">
        <label class="fw-semibold">Foto Profil</label>

        <div class="d-flex align-items-center gap-4 mt-2">

            {{-- PREVIEW --}}
            <div class="user-form-avatar">
                <div class="user-avatar-bg {{ $user->role ?? '' }}">
                    <img id="preview-avatar"
                        src="{{ isset($user) && $user->foto_profil
                            ? asset('storage/'.$user->foto_profil)
                            : asset('assets/images/user/default.png') }}"
                        class="user-avatar-img">
                </div>
            </div>

            {{-- INPUT --}}
            <div class="flex-grow-1">
                <input type="file"
                    name="foto_profil"
                    class="form-control @error('foto_profil') is-invalid @enderror"
                    accept="image/*"
                    onchange="previewAvatar(this)">

                <small class="text-muted d-block mt-1">
                    JPG / PNG · Maksimal 2MB
                </small>

                @error('foto_profil')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>
    </div>

</div>