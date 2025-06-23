@extends('layouts.main')

@section('container')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Produk</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Daftar Produk</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Data Produk</h5>
                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Produk
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="products-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Unit</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Margin</th>
                                            <th>Stok Min</th>
                                            <th>Stok Max</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $product->product_code }}</span>
                                                </td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category->category_name }}</td>
                                                <td>{{ $product->unit->unit_symbol }}</td>
                                                <td>Rp {{ number_format($product->cost_price, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                                                <td>
                                                    @php
                                                        $margin = $product->selling_price - $product->cost_price;
                                                        $marginPercent = $product->cost_price > 0 ? ($margin / $product->cost_price) * 100 : 0;
                                                    @endphp
                                                    <span class="badge bg-success">
                                                        Rp {{ number_format($margin, 0, ',', '.') }}
                                                        ({{ number_format($marginPercent, 1) }}%)
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning">{{ $product->min_stock }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $product->max_stock }}</span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('products.show', $product->id) }}"
                                                           class="btn btn-sm btn-info" title="Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                           class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada data produk</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#products-table').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                    }
                });
            });
        </script>
    @endpush
@endsection
