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
                                <li class="breadcrumb-item" aria-current="page">Edit Produk</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Produk</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Edit Produk</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="product_code" class="form-label">Kode Produk <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                                                   id="product_code" name="product_code"
                                                   value="{{ old('product_code', $product->product_code) }}"
                                                   placeholder="Contoh: PRD001" required>
                                            @error('product_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="product_name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                                   id="product_name" name="product_name"
                                                   value="{{ old('product_name', $product->product_name) }}"
                                                   placeholder="Masukkan nama produk" required>
                                            @error('product_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                    id="category_id" name="category_id" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="unit_id" class="form-label">Unit <span class="text-danger">*</span></label>
                                            <select class="form-select @error('unit_id') is-invalid @enderror"
                                                    id="unit_id" name="unit_id" required>
                                                <option value="">Pilih Unit</option>
                                                @foreach($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                            {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->unit_name }} ({{ $unit->unit_symbol }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="cost_price" class="form-label">Harga Beli <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control @error('cost_price') is-invalid @enderror"
                                                       id="cost_price" name="cost_price"
                                                       value="{{ old('cost_price', $product->cost_price) }}"
                                                       placeholder="0" min="0" step="100" required>
                                            </div>
                                            @error('cost_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="selling_price" class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror"
                                                       id="selling_price" name="selling_price"
                                                       value="{{ old('selling_price', $product->selling_price) }}"
                                                       placeholder="0" min="0" step="100" required>
                                            </div>
                                            @error('selling_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="min_stock" class="form-label">Stok Minimum <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('min_stock') is-invalid @enderror"
                                                   id="min_stock" name="min_stock"
                                                   value="{{ old('min_stock', $product->min_stock) }}"
                                                   placeholder="0" min="0" required>
                                            @error('min_stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="max_stock" class="form-label">Stok Maksimum <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('max_stock') is-invalid @enderror"
                                                   id="max_stock" name="max_stock"
                                                   value="{{ old('max_stock', $product->max_stock) }}"
                                                   placeholder="0" min="0" required>
                                            @error('max_stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Auto calculate selling price based on margin
            document.getElementById('cost_price').addEventListener('input', function() {
                const costPrice = parseFloat(this.value) || 0;
                const sellingPrice = document.getElementById('selling_price');

                // Set default margin 20% if selling price is empty
                if (!sellingPrice.value) {
                    sellingPrice.value = Math.round(costPrice * 1.2);
                }
            });

            // Validate max_stock > min_stock
            document.getElementById('max_stock').addEventListener('input', function() {
                const maxStock = parseInt(this.value) || 0;
                const minStock = parseInt(document.getElementById('min_stock').value) || 0;

                if (maxStock < minStock) {
                    this.setCustomValidity('Stok maksimum harus lebih besar dari stok minimum');
                } else {
                    this.setCustomValidity('');
                }
            });
        </script>
    @endpush
@endsection
