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
                                <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaksi</a></li>
                                <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Transaksi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Transaksi</h5>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('transactions.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="type" class="form-label">Tipe Transaksi</label>
                                        <select name="type" id="type" class="form-select" required>
                                            <option value="">Pilih Tipe</option>
                                            <option value="in">Transaksi Masuk</option>
                                            <option value="out">Transaksi Keluar</option>
                                            <option value="transfer">Transfer Antar Lokasi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 source-location" style="display: none;">
                                        <label for="source_location_id" class="form-label">Lokasi Sumber</label>
                                        <select name="source_location_id" id="source_location_id" class="form-select">
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 destination-location" style="display: none;">
                                        <label for="destination_location_id" class="form-label">Lokasi Tujuan</label>
                                        <select name="destination_location_id" id="destination_location_id" class="form-select">
                                            <option value="">Pilih Lokasi</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="notes" class="form-label">Catatan</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Detail Produk</h6>
                                        <button type="button" class="btn btn-sm btn-primary" id="addProduct">
                                            <i class="fas fa-plus"></i> Tambah Produk
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div id="productDetails">
                                            <div class="row mb-3 product-row">
                                                <div class="col-md-4">
                                                    <select name="details[0][product_id]" class="form-select product-select" required>
                                                        <option value="">Pilih Produk</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                    data-price="{{ $product->price }}">
                                                                {{ $product->product_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="details[0][quantity]"
                                                           class="form-control quantity" placeholder="Jumlah" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="details[0][unit_price]"
                                                           class="form-control unit-price" placeholder="Harga" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control total-price"
                                                           placeholder="Total" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger remove-product">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
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
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const sourceLocation = document.querySelector('.source-location');
            const destinationLocation = document.querySelector('.destination-location');
            const sourceLocationSelect = document.getElementById('source_location_id');
            const destinationLocationSelect = document.getElementById('destination_location_id');

            typeSelect.addEventListener('change', function() {
                const type = this.value;
                sourceLocation.style.display = (type === 'out' || type === 'transfer') ? 'block' : 'none';
                destinationLocation.style.display = (type === 'in' || type === 'transfer') ? 'block' : 'none';

                sourceLocationSelect.required = (type === 'out' || type === 'transfer');
                destinationLocationSelect.required = (type === 'in' || type === 'transfer');
            });

            let productCount = 1;
            const addProductBtn = document.getElementById('addProduct');
            const productDetails = document.getElementById('productDetails');

            addProductBtn.addEventListener('click', function() {
                const newRow = document.querySelector('.product-row').cloneNode(true);
                const inputs = newRow.querySelectorAll('input, select');

                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('[0]', `[${productCount}]`));
                    }
                    input.value = '';
                });

                productDetails.appendChild(newRow);
                productCount++;
            });

            productDetails.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-product') || e.target.closest('.remove-product')) {
                    if (document.querySelectorAll('.product-row').length > 1) {
                        e.target.closest('.product-row').remove();
                    }
                }
            });

            productDetails.addEventListener('change', function(e) {
                if (e.target.classList.contains('product-select')) {
                    const row = e.target.closest('.product-row');
                    const price = e.target.options[e.target.selectedIndex].dataset.price;
                    row.querySelector('.unit-price').value = price;
                    calculateTotal(row);
                }
            });

            productDetails.addEventListener('input', function(e) {
                if (e.target.classList.contains('quantity') || e.target.classList.contains('unit-price')) {
                    calculateTotal(e.target.closest('.product-row'));
                }
            });

            function calculateTotal(row) {
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
                const total = quantity * unitPrice;
                row.querySelector('.total-price').value = total.toFixed(2);
            }
        });
    </script>
    @endpush
@endsection
