{{-- FILTER HISTORY --}}
<div class="card category-card mb-4">
    <div class="card-body">

        <form method="GET" class="row g-3 align-items-end">

            <div class="col-md-3">
                <label class="fw-semibold">Dari Tanggal</label>
                <input type="date"
                    name="from"
                    value="{{ request('from') }}"
                    class="form-control">
            </div>

            <div class="col-md-3">
                <label class="fw-semibold">Sampai Tanggal</label>
                <input type="date"
                    name="to"
                    value="{{ request('to') }}"
                    class="form-control">
            </div>

            <div class="col-md-2">
                <label class="fw-semibold">Tipe</label>
                <select name="tipe" class="form-control">
                    <option value="">Semua</option>
                    <option value="masuk" {{ request('tipe') === 'masuk' ? 'selected' : '' }}>
                        Masuk
                    </option>
                    <option value="keluar" {{ request('tipe') === 'keluar' ? 'selected' : '' }}>
                        Keluar
                    </option>
                </select>
            </div>

            @if(auth()->user()->role !== 'petugas')
            <div class="col-md-3">
                <label class="fw-semibold">Petugas</label>
                <select name="user_id" class="form-control">
                    <option value="">Semua</option>
                    @foreach($petugas as $p)
                    <option value="{{ $p->id }}"
                        {{ request('user_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="col-md-2">
                <label class="form-label mb-1 invisible">Aksi</label>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="feather icon-filter"></i>
                    </button>

                    <a href="{{ route('history.index') }}"
                        class="btn btn-light w-100">
                        <i class="feather icon-rotate-ccw"></i>
                    </a>
                </div>
            </div>


        </form>

    </div>
</div>