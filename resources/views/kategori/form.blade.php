<div class="form-group">
    <label class="form-label">Nama Kategori</label>

    <input type="text"
           name="nama_kategori"
           value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
           class="form-control @error('nama_kategori') is-invalid @enderror"
           placeholder="Contoh: Elektronik">

    @error('nama_kategori')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
