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
                                <li class="breadcrumb-item" aria-current="page">Stok</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Stok</h2>
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
                                <h5>Daftar Stok</h5>
                                <div>
                                    <a href="{{ route('stocks.create') }}" class="btn btn-primary">
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
                                            <th>Lokasi</th>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                <td style="width: 30px; text-align: center;">{{ $loop->iteration }}</td>
                                                <td>{{ $stock->location->location_name }}</td>
                                                <td>{{ $stock->product->product_name }}</td>
                                                <td>{{ $stock->quantity }}</td>
                                                <td>{{ $stock->last_updated ? $stock->last_updated->format('d/m/Y H:i') : '-' }}</td>
                                                <td>
                                                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm me-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $stock->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
            function deleteData(id) {
                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Kamu ingin menghapus data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/stocks/${id}`, {
                                method: "DELETE",
                                headers: {
                                    "Content-Type": "application/json",
                                    "Accept": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success').then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'Terjadi kesalahan saat menghapus data.', 'error');
                            });
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
