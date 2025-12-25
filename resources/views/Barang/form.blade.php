<div class="form-group mb-3">
    <label class="fw-semibold">Kode Barang</label>
    <input type="text"
        name="kode_barang"
        class="form-control"
        value="{{ old('kode_barang', $barang->kode_barang ?? '') }}"
        {{ isset($barang) ? 'readonly' : '' }}
        required>
</div>

<div class="form-group mb-3">
    <label class="fw-semibold">Nama Barang</label>
    <input type="text"
        name="nama_barang"
        class="form-control"
        value="{{ old('nama_barang', $barang->nama_barang ?? '') }}"
        required>
</div>

<div class="form-group mb-3">
    <label class="fw-semibold">Kategori</label>
    <select name="kategori_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
        <option value="{{ $k->id }}"
            {{ old('kategori_id', $barang->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
            {{ $k->nama_kategori }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label class="fw-semibold">Lokasi</label>
    <select name="lokasi_id" class="form-control">
        <option value="">-- Pilih Lokasi --</option>
        @foreach($lokasi as $l)
        <option value="{{ $l->id }}"
            {{ old('lokasi_id', $barang->lokasi_id ?? '') == $l->id ? 'selected' : '' }}>
            {{ $l->nama_lokasi }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-3">
    <label class="fw-semibold">Keterangan</label>
    <textarea name="keterangan"
        class="form-control"
        rows="3">{{ old('keterangan', $barang->keterangan ?? '') }}</textarea>
</div>

<div class="form-group mb-4">
    <label class="fw-semibold">Foto Barang</label>

    <div class="image-upload-box">
        <img id="preview"
            src="{{ isset($barang) && $barang->foto_barang
                    ? asset('storage/'.$barang->foto_barang)
                    : asset('assets/images/upload-placeholder.png') }}">

        <input type="file"
            name="foto_barang"
            accept="image/*"
            onchange="previewImage(this)">
    </div>

    <small class="text-muted d-block mt-2">
        JPG / PNG · Maksimal 2MB
    </small>
</div>