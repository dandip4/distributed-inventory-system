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
                                <li class="breadcrumb-item" aria-current="page">Detail</li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Informasi Transaksi</h5>
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="200">No. Transaksi</th>
                                            <td>{{ $transaction->transaction_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tipe Transaksi</th>
                                            <td>
                                                @if($transaction->type == 'in')
                                                    <span class="badge bg-success">Masuk</span>
                                                @elseif($transaction->type == 'out')
                                                    <span class="badge bg-danger">Keluar</span>
                                                @else
                                                    <span class="badge bg-info">Transfer</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Sumber</th>
                                            <td>{{ $transaction->sourceLocation->location_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Tujuan</th>
                                            <td>{{ $transaction->destinationLocation->location_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Catatan</th>
                                            <td>{{ $transaction->notes ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <h6>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaction->details as $detail)
                                            <tr>
                                                <td style="width: 30px; text-align: center;">{{ $loop->iteration }}</td>
                                                <td>{{ $detail->product->product_name }}</td>
                                                <td>{{ $detail->quantity }}</td>
                                                <td>Rp {{ number_format($detail->unit_price, 2, ',', '.') }}</td>
                                                <td>Rp {{ number_format($detail->total_price, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Total Keseluruhan:</th>
                                            <th>Rp {{ number_format($transaction->details->sum('total_price'), 2, ',', '.') }}</th>
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
