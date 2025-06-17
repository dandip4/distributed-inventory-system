@extends('layouts.app')

@section('title', 'Daftar Stok')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Stok</h5>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Stok
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                    <tr>
                        <td>{{ $stock->location->location_name }}</td>
                        <td>{{ $stock->product->product_name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->last_updated->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada stok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection