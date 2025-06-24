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
                            <li class="breadcrumb-item"><a href="{{ route('employes.index') }}">Pegawai</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Pegawai</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Pegawai</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Edit Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employes.update', $master->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $master->name) }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $master->email) }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $location->phone ?? '') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $location->position ?? '') }}">
                                    @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $location->address ?? '') }}</textarea>
                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                                    <option value="1" {{ old('is_active', $master->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', $master->is_active) == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('employes.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
