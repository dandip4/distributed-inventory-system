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
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detail Produk</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detail Produk</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Informasi Produk</h5>
                                <div>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Kode Produk</strong></td>
                                            <td>: <span class="badge bg-primary">{{ $product->product_code }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Produk</strong></td>
                                            <td>: {{ $product->product_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kategori</strong></td>
                                            <td>: {{ $product->category->category_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Unit</strong></td>
                                            <td>: {{ $product->unit->unit_name }} ({{ $product->unit->unit_symbol }})</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            <td>:
                                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Harga Beli</strong></td>
                                            <td>: <span class="text-danger fw-bold">Rp {{ number_format($product->cost_price, 0, ',', '.') }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Harga Jual</strong></td>
                                            <td>: <span class="text-success fw-bold">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Margin</strong></td>
                                            <td>:
                                                @php
                                                    $margin = $product->selling_price - $product->cost_price;
                                                    $marginPercent = $product->cost_price > 0 ? ($margin / $product->cost_price) * 100 : 0;
                                                @endphp
                                                <span class="badge bg-success">
                                                    Rp {{ number_format($margin, 0, ',', '.') }}
                                                    ({{ number_format($marginPercent, 1) }}%)
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stok Minimum</strong></td>
                                            <td>: <span class="badge bg-warning">{{ $product->min_stock }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Stok Maksimum</strong></td>
                                            <td>: <span class="badge bg-info">{{ $product->max_stock }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <h6>Informasi Tambahan</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Dibuat Pada</strong></td>
                                            <td>: {{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Terakhir Diupdate</strong></td>
                                            <td>: {{ $product->updated_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
