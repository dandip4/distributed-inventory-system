<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register | Sistem Informasi Inventaris</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('template/backend/assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('template/backend/assets/fonts/inter/inter.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/fonts/material.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/style-preset.css') }}">
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- Preloader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <div class="text-center">
                            <h4 class="f-w-500 mb-3">Register Sistem Informasi Inventaris</h4>
                            <img src="{{ asset('template/backend/assets/images/qq.jpg') }}" alt="Logo" class="img-fluid" style="width: 200px; height: 200px;">
                            <p class="mb-4">Daftar akun baru untuk mengakses sistem</p>
                        </div>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="feather icon-user"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi password" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login di sini</a></p>
                            <p class="text-muted">© {{ date('Y') }} Sistem Informasi Inventaris. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{ asset('template/backend/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/plugins/feather.min.js') }}"></script>
</body>

</html>
