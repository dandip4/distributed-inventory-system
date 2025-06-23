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
                                <li class="breadcrumb-item"><a href="{{ route('transactions.show', $transaction->id) }}">Detail</a></li>
                                <li class="breadcrumb-item" aria-current="page">Edit</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Transaksi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Edit Transaksi</h5>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" id="transactionForm">
                                @csrf
                                @method('PUT')

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="transaction_number" class="form-label">Nomor Transaksi</label>
                                            <input type="text" class="form-control" id="transaction_number"
                                                   value="{{ $transaction->transaction_number }}" readonly>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="type" class="form-label">Tipe Transaksi <span class="text-danger">*</span></label>
                                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                                <option value="">Pilih Tipe Transaksi</option>
                                                <option value="in" {{ old('type', $transaction->type) == 'in' ? 'selected' : '' }}>Masuk</option>
                                                <option value="out" {{ old('type', $transaction->type) == 'out' ? 'selected' : '' }}>Keluar</option>
                                                <option value="transfer" {{ old('type', $transaction->type) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="source_location_id" class="form-label">Lokasi Sumber</label>
                                            <select class="form-select @error('source_location_id') is-invalid @enderror" id="source_location_id" name="source_location_id">
                                                <option value="">Pilih Lokasi Sumber</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}" {{ old('source_location_id', $transaction->source_location_id) == $location->id ? 'selected' : '' }}>
                                                        {{ $location->location_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('source_location_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="destination_location_id" class="form-label">Lokasi Tujuan</label>
                                            <select class="form-select @error('destination_location_id') is-invalid @enderror" id="destination_location_id" name="destination_location_id">
                                                <option value="">Pilih Lokasi Tujuan</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}" {{ old('destination_location_id', $transaction->destination_location_id) == $location->id ? 'selected' : '' }}>
                                                        {{ $location->location_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('destination_location_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3" id="destination_info_group" style="display: none;">
                                            <label for="destination_info" class="form-label">Ke Mana <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('destination_info') is-invalid @enderror"
                                                   id="destination_info" name="destination_info"
                                                   value="{{ old('destination_info', $transaction->destination_info) }}"
                                                   placeholder="Contoh: Customer A, Supplier B, dll">
                                            @error('destination_info')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="notes" class="form-label">Catatan</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3"
                                              placeholder="Catatan tambahan (opsional)">{{ old('notes', $transaction->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Detail Produk</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="products-container">
                                            @foreach($transaction->details as $index => $detail)
                                                <div class="product-row row mb-3" data-index="{{ $index }}">
                                                    <div class="col-md-3">
                                                        <label class="form-label">Produk <span class="text-danger">*</span></label>
                                                        <select class="form-select product-select" name="products[{{ $index }}][product_id]" required>
                                                            <option value="">Pilih Produk</option>
                                                            @foreach($products as $product)
                                                                <option value="{{ $product->id }}"
                                                                        data-cost="{{ $product->cost_price }}"
                                                                        data-selling="{{ $product->selling_price }}"
                                                                        {{ $detail->product_id == $product->id ? 'selected' : '' }}>
                                                                    {{ $product->product_name }} ({{ $product->product_code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control quantity-input"
                                                               name="products[{{ $index }}][quantity]" min="1"
                                                               value="{{ $detail->quantity }}" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tipe Harga <span class="text-danger">*</span></label>
                                                        <select class="form-select price-type-select" name="products[{{ $index }}][price_type]" required>
                                                            <option value="">Pilih</option>
                                                            <option value="cost" {{ $detail->unit_price == $detail->product->cost_price ? 'selected' : '' }}>Harga Beli</option>
                                                            <option value="selling" {{ $detail->unit_price == $detail->product->selling_price ? 'selected' : '' }}>Harga Jual</option>
                                                            <option value="custom" {{ $detail->unit_price != $detail->product->cost_price && $detail->unit_price != $detail->product->selling_price ? 'selected' : '' }}>Custom</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Harga Unit <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control unit-price-input"
                                                               name="products[{{ $index }}][unit_price]" min="0" step="0.01"
                                                               value="{{ $detail->unit_price }}" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Total</label>
                                                        <input type="text" class="form-control total-price-display"
                                                               value="Rp {{ number_format($detail->total_price, 0, ',', '.') }}" readonly>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label class="form-label">&nbsp;</label>
                                                        @if($index > 0)
                                                            <button type="button" class="btn btn-danger btn-sm remove-product">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-sm remove-product" style="display: none;">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-success" id="add-product">
                                                <i class="fas fa-plus"></i> Tambah Produk
                                            </button>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-4">
                                                <div class="card bg-light">
                                                    <div class="card-body">
                                                        <h6 class="card-title">Total Transaksi</h6>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Total Item:</span>
                                                            <span id="total-items">{{ $transaction->details->sum('quantity') }}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span>Total Nilai:</span>
                                                            <span id="total-value">Rp {{ number_format($transaction->details->sum('total_price'), 0, ',', '.') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save"></i> Update Transaksi
                                    </button>
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
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
        $(document).ready(function() {
            let productIndex = {{ $transaction->details->count() - 1 }};

            // Initialize destination info group visibility
            function updateDestinationInfoVisibility() {
                const type = $('#type').val();

                if (type === 'out') {
                    $('#destination_info_group').show();
                    $('#destination_info').prop('required', true);
                } else {
                    $('#destination_info_group').hide();
                    $('#destination_info').prop('required', false);
                }
            }

            // Call on page load
            updateDestinationInfoVisibility();

            // Handle transaction type change
            $('#type').change(function() {
                const type = $(this).val();

                if (type === 'in') {
                    $('#source_location_id').prop('required', false);
                    $('#destination_location_id').prop('required', true);
                    $('#destination_info_group').hide();
                    $('#destination_info').prop('required', false);
                } else if (type === 'out') {
                    $('#source_location_id').prop('required', true);
                    $('#destination_location_id').prop('required', false);
                    $('#destination_info_group').show();
                    $('#destination_info').prop('required', true);
                } else if (type === 'transfer') {
                    $('#source_location_id').prop('required', true);
                    $('#destination_location_id').prop('required', true);
                    $('#destination_info_group').hide();
                    $('#destination_info').prop('required', false);
                } else {
                    $('#source_location_id').prop('required', false);
                    $('#destination_location_id').prop('required', false);
                    $('#destination_info_group').hide();
                    $('#destination_info').prop('required', false);
                }
            });

            // Add product row
            $('#add-product').click(function() {
                productIndex++;
                const newRow = $('.product-row:first').clone();

                // Clear values
                newRow.find('select, input').val('');
                newRow.find('.total-price-display').val('');

                // Update names
                newRow.find('[name*="[0]"]').each(function() {
                    const name = $(this).attr('name').replace('[0]', '[' + productIndex + ']');
                    $(this).attr('name', name);
                });

                // Show remove button
                newRow.find('.remove-product').show();

                // Add to container
                $('#products-container').append(newRow);

                // Rebind events
                bindProductEvents(newRow);
            });

            // Remove product row
            $(document).on('click', '.remove-product', function() {
                $(this).closest('.product-row').remove();
                calculateTotals();
            });

            // Bind product events
            function bindProductEvents(row) {
                // Product selection
                row.find('.product-select').change(function() {
                    const option = $(this).find('option:selected');
                    const costPrice = option.data('cost');
                    const sellingPrice = option.data('selling');

                    // Update price type options
                    const priceTypeSelect = row.find('.price-type-select');
                    priceTypeSelect.find('option[value="cost"]').text(`Harga Beli (Rp ${costPrice?.toLocaleString() || 0})`);
                    priceTypeSelect.find('option[value="selling"]').text(`Harga Jual (Rp ${sellingPrice?.toLocaleString() || 0})`);

                    // Auto-select selling price
                    priceTypeSelect.val('selling').trigger('change');
                });

                // Price type change
                row.find('.price-type-select').change(function() {
                    const priceType = $(this).val();
                    const productSelect = row.find('.product-select');
                    const option = productSelect.find('option:selected');
                    const unitPriceInput = row.find('.unit-price-input');

                    if (priceType === 'cost') {
                        unitPriceInput.val(option.data('cost') || 0);
                    } else if (priceType === 'selling') {
                        unitPriceInput.val(option.data('selling') || 0);
                    } else if (priceType === 'custom') {
                        unitPriceInput.val('').focus();
                    }

                    calculateRowTotal(row);
                });

                // Quantity and unit price change
                row.find('.quantity-input, .unit-price-input').on('input', function() {
                    calculateRowTotal(row);
                });
            }

            // Calculate row total
            function calculateRowTotal(row) {
                const quantity = parseFloat(row.find('.quantity-input').val()) || 0;
                const unitPrice = parseFloat(row.find('.unit-price-input').val()) || 0;
                const total = quantity * unitPrice;

                row.find('.total-price-display').val(`Rp ${total.toLocaleString()}`);
                calculateTotals();
            }

            // Calculate totals
            function calculateTotals() {
                let totalItems = 0;
                let totalValue = 0;

                $('.product-row').each(function() {
                    const quantity = parseFloat($(this).find('.quantity-input').val()) || 0;
                    const unitPrice = parseFloat($(this).find('.unit-price-input').val()) || 0;

                    totalItems += quantity;
                    totalValue += quantity * unitPrice;
                });

                $('#total-items').text(totalItems);
                $('#total-value').text(`Rp ${totalValue.toLocaleString()}`);
            }

            // Bind events to all existing rows
            $('.product-row').each(function() {
                bindProductEvents($(this));
            });

            // Form validation
            $('#transactionForm').submit(function(e) {
                const type = $('#type').val();

                if (type === 'out' && !$('#destination_info').val().trim()) {
                    e.preventDefault();
                    alert('Informasi tujuan wajib diisi untuk transaksi keluar');
                    $('#destination_info').focus();
                    return false;
                }

                // Check if at least one product is selected
                let hasProduct = false;
                $('.product-select').each(function() {
                    if ($(this).val()) {
                        hasProduct = true;
                        return false;
                    }
                });

                if (!hasProduct) {
                    e.preventDefault();
                    alert('Minimal satu produk harus dipilih');
                    return false;
                }
            });
        });
    </script>
    @endpush
@endsection
