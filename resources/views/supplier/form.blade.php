{{-- NAMA SUPPLIER --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Nama Supplier</label>
    <input type="text"
        name="nama_supplier"
        class="form-control"
        value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}"
        required>
</div>

{{-- TELEPON --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Telepon</label>
    <input type="text"
        name="telepon"
        class="form-control"
        value="{{ old('telepon', $supplier->telepon ?? '') }}">
</div>

{{-- ALAMAT --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Alamat</label>
    <textarea name="alamat"
        class="form-control"
        rows="3">{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
</div>

{{-- LOGO --}}
<div class="form-group mb-4">
    <label class="fw-semibold">Logo Supplier</label>

    <div class="image-upload-box">
        <img id="preview"
            src="{{ isset($supplier) && $supplier->logo_supplier
                    ? asset('storage/'.$supplier->logo_supplier)
                    : asset('assets/images/upload-placeholder.png') }}">

        <input type="file"
            name="logo_supplier"
            accept="image/*"
            onchange="previewImage(this)">
    </div>

    <small class="text-muted d-block mt-2">
        JPG / PNG · Maksimal 2MB
    </small>
</div>