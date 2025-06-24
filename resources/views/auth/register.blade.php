<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SIRIS | Sistem Inventory Terdistribusi</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('template/backend/assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                        'sans': ['Poppins', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        'blue-primary': '#1e40af',
                        'blue-secondary': '#3b82f6',
                        'blue-light': '#dbeafe',
                        'blue-dark': '#1e3a8a',
                    },
                    backgroundImage: {
                        'gradient-hero': 'linear-gradient(135deg, #0f172a 0%, #1e40af 50%, #3b82f6 100%)',
                        'gradient-card': 'linear-gradient(145deg, #ffffff 0%, #f8fafc 100%)',
                    },
                    boxShadow: {
                        'soft': '0 10px 40px rgba(0, 0, 0, 0.1)',
                        'blue': '0 20px 60px rgba(30, 64, 175, 0.15)',
                        'blue-lg': '0 25px 80px rgba(30, 64, 175, 0.2)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(30, 64, 175, 0.3);
        }

        .password-strength {
            height: 4px;
            width: 100%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
    </style>
</head>

<body class="font-sans bg-gradient-hero min-h-screen flex items-center justify-center py-4 px-4" style="font-family: 'Poppins', sans-serif;">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400 bg-opacity-20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute top-1/3 -left-32 w-80 h-80 bg-purple-400 bg-opacity-15 rounded-full blur-2xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 right-20 w-64 h-64 bg-indigo-400 bg-opacity-20 rounded-full blur-2xl animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-lg relative z-10 animate-fade-in">
        <!-- Register Card -->
        <div class="bg-white/10 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl animate-slide-up">
            <!-- Logo Section Inside Card -->
            <div class="text-center mb-6">
                <a href="{{ route('landing') }}" class="inline-block group">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-2xl group-hover:shadow-blue-lg transition-all duration-300">
                                <i class="bi bi-boxes text-white text-lg group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse"></div>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black text-white">SIRIS</h1>
                            <p class="text-blue-200 text-xs font-medium -mt-1">Sistem Inventory Terdistribusi</p>
                        </div>
                    </div>
                </a>
                <h2 class="text-2xl font-bold text-white mb-1">Bergabung dengan SIRIS!</h2>
                <p class="text-blue-200 font-medium text-sm">Buat akun untuk mengakses sistem inventory terdistribusi</p>
            </div>

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <div class="space-y-1">
                    <label for="name" class="block text-white font-semibold text-sm">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-person text-blue-300"></i>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200 focus:outline-none input-focus backdrop-blur-sm @error('name') border-red-400 @enderror"
                            placeholder="Masukkan nama lengkap Anda"
                            required
                        >
                    </div>
                    @error('name')
                        <p class="text-red-300 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="space-y-1">
                    <label for="email" class="block text-white font-semibold text-sm">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-blue-300"></i>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200 focus:outline-none input-focus backdrop-blur-sm @error('email') border-red-400 @enderror"
                            placeholder="Masukkan email Anda"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-300 text-xs font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Fields in Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Password Field -->
                    <div class="space-y-1">
                        <label for="password" class="block text-white font-semibold text-sm">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-lock text-blue-300"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200 focus:outline-none input-focus backdrop-blur-sm @error('password') border-red-400 @enderror"
                                placeholder="Password"
                                required
                                onkeyup="checkPasswordStrength(this.value)"
                            >
                        </div>
                        @error('password')
                            <p class="text-red-300 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-white font-semibold text-sm">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="bi bi-shield-check text-blue-300"></i>
                            </div>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full pl-10 pr-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-blue-200 focus:outline-none input-focus backdrop-blur-sm @error('password_confirmation') border-red-400 @enderror"
                                placeholder="Konfirmasi"
                                required
                            >
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-300 text-xs font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password Strength Indicator -->
                <div class="space-y-1">
                    <div class="password-strength">
                        <div id="password-strength-bar" class="password-strength-bar" style="width: 0%; background: #ef4444;"></div>
                    </div>
                    <p id="password-strength-text" class="text-xs text-blue-200">Minimal 8 karakter dengan kombinasi huruf & angka</p>
                </div>

                <!-- Terms Agreement -->
                <div class="flex items-start space-x-2">
                    <input type="checkbox" id="terms" required class="w-4 h-4 text-blue-500 bg-white/10 border border-white/20 rounded focus:ring-blue-500 focus:ring-2 mt-0.5">
                    <label for="terms" class="text-blue-200 text-xs leading-relaxed">
                        Saya setuju dengan
                        <span class="text-white font-medium">syarat dan ketentuan</span>
                        serta
                        <span class="text-white font-medium">kebijakan privasi</span>
                        SIRIS
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full btn-gradient text-white font-bold py-3 rounded-xl flex items-center justify-center space-x-2 group"
                >
                    <span>Buat Akun SIRIS</span>
                    <i class="bi bi-rocket-takeoff group-hover:translate-x-1 transition-transform duration-300"></i>
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-blue-200 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-white font-bold hover:text-blue-200 transition-colors duration-200">
                        Masuk sekarang
                    </a>
                </p>
            </div>

            <!-- Back to Landing -->
            <div class="mt-4 text-center">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-blue-300 hover:text-white transition-colors duration-200 font-medium text-sm">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke beranda</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-blue-200 text-xs">
                © {{ date('Y') }} SIRIS. Dikembangkan dengan <i class="bi bi-heart-fill text-red-400 animate-pulse"></i> untuk bisnis modern
            </p>
        </div>
    </div>

    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            let strength = 0;
            let color = '#ef4444'; // red
            let text = 'Password terlalu lemah';

            // Check password criteria
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;

            // Set strength level
            if (strength === 0) {
                strengthBar.style.width = '0%';
                color = '#ef4444';
                text = 'Masukkan password';
            } else if (strength === 1 || strength === 2) {
                strengthBar.style.width = '25%';
                color = '#ef4444';
                text = 'Password lemah';
            } else if (strength === 3) {
                strengthBar.style.width = '50%';
                color = '#f59e0b';
                text = 'Password sedang';
            } else if (strength === 4) {
                strengthBar.style.width = '75%';
                color = '#10b981';
                text = 'Password kuat';
            } else if (strength === 5) {
                strengthBar.style.width = '100%';
                color = '#059669';
                text = 'Password sangat kuat';
            }

            strengthBar.style.background = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        }
    </script>
</body>
</html>
