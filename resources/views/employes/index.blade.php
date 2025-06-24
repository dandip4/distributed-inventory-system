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
                            <li class="breadcrumb-item" aria-current="page">Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Pegawai</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Daftar Pegawai</h5>
                        <a href="{{ route('employes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Pegawai
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employes as $index => $employe)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $employe->name }}</td>
                                            <td>{{ $employe->email }}</td>
                                            <td>
                                                @if($employe->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $employe->locationDetail->phone ?? '-' }}</td>
                                            <td>{{ $employe->locationDetail->address ?? '-' }}</td>
                                            <td>{{ $employe->locationDetail->position ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                                    onclick="confirmDelete({{ $employe->id }}, '{{ $employe->name }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $employe->id }}" action="{{ route('employes.destroy', $employe->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p>Belum ada data pegawai</p>
                                                    <a href="{{ route('employes.create') }}" class="btn btn-primary">
                                                        Tambah Pegawai Pertama
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
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Pegawai "${name}" akan dihapus secara permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                document.getElementById(`delete-form-${id}`).submit();
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
