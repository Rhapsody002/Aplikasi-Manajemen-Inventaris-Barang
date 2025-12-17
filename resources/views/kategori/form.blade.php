<div class="form-group mb-3">
    <label class="fw-semibold">Nama Kategori</label>
    <input type="text" name="name_kategori"
        class="form-control"
        value="{{ old('name_kategori', $kategori->name_kategori ?? '') }}"
        required>
</div>

<div class="form-group mb-4">
    <label class="form-label fw-semibold">Gambar Kategori</label>

    <div class="image-upload-box">
        <img id="preview"
            src="{{ isset($kategori) && $kategori->image 
                ? asset('storage/'.$kategori->image) 
                : asset('assets/images/upload-placeholder.png') }}">

        <input type="file"
            name="image"
            accept="image/*"
            onchange="previewImage(this)">
    </div>

    <small class="text-muted d-block mt-2">
        JPG / PNG · Maksimal 2MB
    </small>
</div>