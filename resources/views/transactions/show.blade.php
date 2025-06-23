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
                                <li class="breadcrumb-item" aria-current="page">Detail Transaksi</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detail Transaksi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Informasi Transaksi</h5>
                                <div>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Nomor Transaksi</strong></td>
                                            <td>: {{ $transaction->transaction_number }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tipe Transaksi</strong></td>
                                            <td>:
                                                @switch($transaction->type)
                                                    @case('in')
                                                        <span class="badge bg-success">Masuk</span>
                                                        @break
                                                    @case('out')
                                                        <span class="badge bg-danger">Keluar</span>
                                                        @break
                                                    @case('transfer')
                                                        <span class="badge bg-warning">Transfer</span>
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Lokasi Sumber</strong></td>
                                            <td>:
                                                @if($transaction->source_location_id && isset($locations[$transaction->source_location_id]))
                                                    {{ $locations[$transaction->source_location_id]->location_name }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tujuan</strong></td>
                                            <td>:
                                                @if($transaction->type == 'out' && $transaction->destination_info)
                                                    <span class="text-primary">{{ $transaction->destination_info }}</span>
                                                @elseif($transaction->destination_location_id && isset($locations[$transaction->destination_location_id]))
                                                    {{ $locations[$transaction->destination_location_id]->location_name }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>Tanggal Transaksi</strong></td>
                                            <td>: {{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status</strong></td>
                                            <td>: <span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Item</strong></td>
                                            <td>: {{ $transaction->details->count() }} item</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total Nilai</strong></td>
                                            <td>: <strong>Rp {{ number_format($transaction->details->sum('total_price'), 0, ',', '.') }}</strong></td>
                                        </tr>
                                        @if($transaction->notes)
                                            <tr>
                                                <td><strong>Catatan</strong></td>
                                                <td>: {{ $transaction->notes }}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3">Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Produk</th>
                                            <th>Kategori</th>
                                            <th>Unit</th>
                                            <th style="text-align: center;">Quantity</th>
                                            <th style="text-align: right;">Harga Unit</th>
                                            <th style="text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaction->details as $index => $detail)
                                            <tr>
                                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $detail->product->product_name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $detail->product->product_code }}</small>
                                                </td>
                                                <td>
                                                    @if($detail->product->category)
                                                        <span class="badge bg-info">{{ $detail->product->category->category_name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($detail->product->unit)
                                                        <span class="badge bg-secondary">{{ $detail->product->unit->unit_name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <span class="badge bg-primary">{{ $detail->quantity }}</span>
                                                </td>
                                                <td style="text-align: right;">
                                                    Rp {{ number_format($detail->unit_price, 0, ',', '.') }}
                                                </td>
                                                <td style="text-align: right;">
                                                    <strong>Rp {{ number_format($detail->total_price, 0, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6" style="text-align: right;">Total:</th>
                                            <th style="text-align: right;">Rp {{ number_format($transaction->details->sum('total_price'), 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
