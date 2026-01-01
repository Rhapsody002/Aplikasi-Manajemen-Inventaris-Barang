<div class="row">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Nama</label>
        <input type="text"
            name="name"
            class="form-control"
            value="{{ old('name', $user->name ?? '') }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Username</label>
        <input type="text"
            name="username"
            class="form-control"
            value="{{ old('username', $user->username ?? '') }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Password</label>
        <input type="password"
            name="password"
            class="form-control"
            placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : '' }}"
            {{ isset($user) ? '' : 'required' }}>
    </div>

    <div class="col-md-6 mb-3">
        <label class="fw-semibold">Role</label>
        <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin"
                {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>
                Admin
            </option>
            <option value="petugas"
                {{ old('role', $user->role ?? '') === 'petugas' ? 'selected' : '' }}>
                Petugas
            </option>
            <option value="manajer"
                {{ old('role', $user->role ?? '') === 'manajer' ? 'selected' : '' }}>
                Manajer
            </option>
        </select>
    </div>

    <div class="col-12 mb-4">
        <label class="fw-semibold">Foto Profil</label>

        <div class="d-flex align-items-center gap-4">

            {{-- PREVIEW FOTO --}}
            <div class="user-form-avatar mb-2">
                <div class="user-avatar-bg {{ $user->role ?? '' }}">
                    <img id="preview-avatar"
                        src="{{ isset($user) && $user->foto_profil
                ? asset('storage/'.$user->foto_profil)
                : asset('assets/images/user/default.png') }}"
                        class="user-avatar-img">
                </div>

                {{-- INPUT FILE --}}
                <div class="flex-grow-1">
                    <input type="file"
                        name="foto_profil"
                        class="form-control"
                        accept="image/*"
                        onchange="previewAvatar(this)">

                    <small class="text-muted d-block mt-1">
                        JPG / PNG · Maksimal 2MB
                    </small>
                </div>

            </div>
        </div>


    </div>