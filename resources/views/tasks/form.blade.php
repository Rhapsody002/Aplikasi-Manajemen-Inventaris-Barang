{{-- JUDUL --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Judul Tugas</label>
    <input type="text"
        name="judul"
        class="form-control"
        value="{{ old('judul') }}"
        placeholder="Contoh: Barang Masuk Gudang A"
        required>
</div>

{{-- TIPE TUGAS (HANYA SATU) --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Tipe Tugas</label>
    <select name="tipe"
        id="tipe"
        class="form-control"
        required>
        <option value="">-- Pilih Tipe --</option>
        <option value="masuk" {{ old('tipe') == 'masuk' ? 'selected' : '' }}>
            Barang Masuk
        </option>
        <option value="keluar" {{ old('tipe') == 'keluar' ? 'selected' : '' }}>
            Barang Keluar
        </option>
    </select>
</div>

{{-- BARANG --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Barang</label>
    <select name="barang_id" class="form-control" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($barang as $b)
        <option value="{{ $b->id }}"
            {{ old('barang_id') == $b->id ? 'selected' : '' }}>
            {{ $b->nama_barang }}
        </option>
        @endforeach
    </select>
</div>

{{-- JUMLAH --}}
<div class="form-group mb-3">
    <label class="fw-semibold">Jumlah</label>
    <input type="number"
        name="jumlah"
        class="form-control"
        min="1"
        value="{{ old('jumlah') }}"
        required>
</div>

{{-- SUPPLIER (KHUSUS BARANG MASUK) --}}
<div class="form-group mb-3" id="supplier-wrapper">
    <label class="fw-semibold">Supplier</label>
    <select name="supplier_id" class="form-control">
        <option value="">-- Pilih Supplier --</option>
        @foreach($supplier as $s)
        <option value="{{ $s->id }}"
            {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
            {{ $s->nama_supplier }}
        </option>
        @endforeach
    </select>
    <small class="text-muted">
        Wajib diisi jika tipe = Barang Masuk
    </small>
</div>

{{-- LOKASI PELETAKAN --}}
<div class="form-group mb-3" id="lokasi-wrapper">
    <label class="fw-semibold">
        Lokasi Peletakan
        <small class="text-muted">(Tujuan barang)</small>
    </label>

    <select name="lokasi_id" class="form-control">
        <option value="">-- Pilih Lokasi --</option>
        @foreach($lokasi as $l)
        <option value="{{ $l->id }}"
            {{ old('lokasi_id') == $l->id ? 'selected' : '' }}>
            {{ $l->nama_lokasi }}
        </option>
        @endforeach
    </select>

    <small class="text-muted">
        Wajib diisi jika tipe = Barang Masuk
    </small>
</div>


{{-- PETUGAS --}}
<div class="form-group mb-4">
    <label class="fw-semibold">Petugas</label>
    <select name="user_id" class="form-control" required>
        <option value="">-- Pilih Petugas --</option>
        @foreach($petugas as $p)
        <option value="{{ $p->id }}"
            {{ old('user_id') == $p->id ? 'selected' : '' }}>
            {{ $p->name }}
        </option>
        @endforeach
    </select>
</div>

{{-- SCRIPT SHOW / HIDE SUPPLIER&Lokasi --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipe = document.getElementById('tipe');
        const supplierWrapper = document.getElementById('supplier-wrapper');
        const lokasiWrapper = document.getElementById('lokasi-wrapper');

        function toggleFields() {
            if (tipe.value === 'masuk') {
                supplierWrapper.style.display = 'block';
                lokasiWrapper.style.display = 'block';
            } else {
                supplierWrapper.style.display = 'none';
                lokasiWrapper.style.display = 'none';
            }
        }

        toggleFields();
        tipe.addEventListener('change', toggleFields);
    });
</script>
@endpush