@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="page-header">
    <div class="page-block">
        <h5 class="mb-0">Data Kategori</h5>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <a href="{{ route('kategori.create') }}" class="btn btn-success mb-3">
            <i class="feather icon-plus"></i> Tambah Kategori
        </a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Kategori</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="feather icon-edit"></i>
                        </a>

                        <form action="{{ route('kategori.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus kategori?')">
                                <i class="feather icon-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $kategori->links() }}
    </div>
</div>
@endsection
