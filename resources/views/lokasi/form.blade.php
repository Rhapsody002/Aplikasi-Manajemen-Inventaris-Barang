<div class="form-group mb-3">
    <label class="fw-semibold">Nama Lokasi</label>
    <input type="text"
        name="nama_lokasi"
        class="form-control"
        value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}"
        required>
</div>

<div class="form-group mb-4">
    <label class="fw-semibold">Keterangan</label>
    <textarea name="keterangan"
        class="form-control"
        rows="3">{{ old('keterangan', $lokasi->keterangan ?? '') }}</textarea>
</div>