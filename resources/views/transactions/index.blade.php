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
                                <li class="breadcrumb-item" aria-current="page">Transaksi</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Transaksi</h2>
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
                                <h5>Transaksi</h5>
                                <div>
                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>No. Transaksi</th>
                                            <th>Tipe</th>
                                            <th>Lokasi Sumber</th>
                                            <th>Lokasi Tujuan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td style="width: 30px; text-align: center;">{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->transaction_number }}</td>
                                                <td>
                                                    @if($transaction->type == 'in')
                                                        <span class="badge bg-success">Masuk</span>
                                                    @elseif($transaction->type == 'out')
                                                        <span class="badge bg-danger">Keluar</span>
                                                    @else
                                                        <span class="badge bg-info">Transfer</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->sourceLocation->location_name ?? '-' }}</td>
                                                <td>{{ $transaction->destinationLocation->location_name ?? '-' }}</td>
                                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('transactions.show', $transaction) }}"
                                                       class="btn btn-info btn-sm me-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 2100,
                    timerProgressBar: true,
                    showConfirmButton: true,
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    timer: 2100,
                    timerProgressBar: true,
                    showConfirmButton: true,
                });
            @endif
        </script>
    @endpush
@endsection
