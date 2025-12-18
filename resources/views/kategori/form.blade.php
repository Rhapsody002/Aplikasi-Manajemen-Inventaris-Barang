<div class="form-group mb-3">
    <label class="fw-semibold">Nama Kategori</label>
    <input type="text"
        name="nama_kategori"
        class="form-control"
        value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
        required>
</div>

<div class="form-group mb-3">
    <label class="fw-semibold">Keterangan</label>
    <textarea name="keterangan"
        class="form-control"
        rows="3">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
</div>

<div class="form-group mb-4">
    <label class="fw-semibold">Gambar Kategori</label>

    <div class="image-upload-box">
        <img id="preview"
            src="{{ isset($kategori) && $kategori->gambar_kategori
                ? asset('storage/'.$kategori->gambar_kategori)
                : asset('assets/images/upload-placeholder.png') }}">

        <input type="file"
            name="gambar_kategori"
            accept="image/*"
            onchange="previewImage(this)">
    </div>

    <small class="text-muted d-block mt-2">
        JPG / PNG · Maksimal 2MB
    </small>
</div>