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
                                <h5>Daftar Transaksi</h5>
                                <div>
                                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Buat Transaksi
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

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px; text-align: center;">No</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Tipe</th>
                                            <th>Lokasi Sumber</th>
                                            <th>Tujuan</th>
                                            <th>Total Item</th>
                                            <th>Total Nilai</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $index => $transaction)
                                            <tr>
                                                <td style="width: 30px; text-align: center;">{{ $index + 1 }}</td>
                                                <td>
                                                    <strong>{{ $transaction->transaction_number }}</strong>
                                                </td>
                                                <td>
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
                                                <td>
                                                    @if($transaction->source_location_id && isset($locations[$transaction->source_location_id]))
                                                        <span class="text-muted">{{ $locations[$transaction->source_location_id]->location_name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($transaction->type == 'out' && $transaction->destination_info)
                                                        <span class="text-primary">{{ $transaction->destination_info }}</span>
                                                    @elseif($transaction->destination_location_id && isset($locations[$transaction->destination_location_id]))
                                                        <span class="text-muted">{{ $locations[$transaction->destination_location_id]->location_name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $transaction->details->count() }} item</span>
                                                </td>
                                                <td>
                                                    <strong>Rp {{ number_format($transaction->details->sum('total_price'), 0, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    <small>{{ $transaction->created_at->format('d/m/Y H:i') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">Selesai</span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('transactions.show', $transaction->id) }}"
                                                           class="btn btn-info btn-sm" title="Lihat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                           class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-danger btn-sm"
                                                                title="Hapus"
                                                                onclick="confirmDelete({{ $transaction->id }}, '{{ $transaction->transaction_number }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $transaction->id }}"
                                                              action="{{ route('transactions.destroy', $transaction->id) }}"
                                                              method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                                        <p>Belum ada transaksi</p>
                                                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                                            Buat Transaksi Pertama
                                                        </a>
                                                    </div>
                                                </td>
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
            // Fungsi untuk konfirmasi delete dengan SweetAlert
            function confirmDelete(transactionId, transactionNumber) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Transaksi "${transactionNumber}" akan dihapus secara permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Submit form delete
                        document.getElementById(`delete-form-${transactionId}`).submit();
                    }
                });
            }

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
