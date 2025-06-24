<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRIS - Sistem Inventory Terdistribusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                        'blue-gradient-start': '#1d4ed8',
                        'blue-gradient-end': '#1e40af',
                        'accent': '#f97316',
                        'accent-light': '#fed7aa',
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'fade-in-down': 'fadeInDown 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.8s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-blue': 'pulseBlue 2s infinite',
                    },
                    backgroundImage: {
                        'gradient-blue': 'linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%)',
                        'gradient-blue-dark': 'linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #3b82f6 100%)',
                        'gradient-hero': 'linear-gradient(135deg, #0f172a 0%, #1e40af 50%, #3b82f6 100%)',
                        'gradient-card': 'linear-gradient(145deg, #ffffff 0%, #f8fafc 100%)',
                    },
                    boxShadow: {
                        'soft': '0 10px 40px rgba(0, 0, 0, 0.1)',
                        'blue': '0 20px 60px rgba(30, 64, 175, 0.15)',
                        'blue-lg': '0 25px 80px rgba(30, 64, 175, 0.2)',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulseBlue {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 30px 80px rgba(30, 64, 175, 0.2);
        }

        .btn-blue-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }

        .btn-blue-gradient:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(30, 64, 175, 0.3);
        }

        .text-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .blob-animation {
            animation: blob 7s infinite;
        }

        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .glow-effect {
            box-shadow: 0 0 50px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="font-sans bg-white text-gray-900 overflow-x-hidden antialiased" style="font-family: 'Poppins', sans-serif;">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 ease-in-out" id="navbar">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 via-blue-800/10 to-purple-900/20 backdrop-blur-2xl border-b border-white/10"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="#home" class="group flex items-center space-x-4 hover:scale-105 transition-all duration-300">
                        <div class="relative">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-blue-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl group-hover:shadow-blue-lg transition-all duration-300">
                                <i class="bi bi-boxes text-white text-2xl group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full animate-pulse"></div>
                        </div>
                        <div class="hidden sm:block">
                            <div class="text-3xl font-black text-white group-hover:text-blue-200 transition-colors duration-300">SIRIS</div>
                            <div class="text-xs text-blue-200 font-medium -mt-1">Inventory System</div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden lg:block">
                    <div class="flex items-center space-x-2">
                        <a href="#home" class="group relative px-6 py-3 text-white font-semibold text-sm hover:text-blue-200 transition-all duration-300">
                            <span class="relative z-10">Beranda</span>
                            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm"></div>
                        </a>
                        <a href="#features" class="group relative px-6 py-3 text-white font-semibold text-sm hover:text-blue-200 transition-all duration-300">
                            <span class="relative z-10">Fitur</span>
                            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm"></div>
                        </a>
                        <a href="#architecture" class="group relative px-6 py-3 text-white font-semibold text-sm hover:text-blue-200 transition-all duration-300">
                            <span class="relative z-10">Arsitektur</span>
                            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm"></div>
                        </a>
                        <a href="#about" class="group relative px-6 py-3 text-white font-semibold text-sm hover:text-blue-200 transition-all duration-300">
                            <span class="relative z-10">Tentang</span>
                            <div class="absolute inset-0 bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm"></div>
                        </a>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:block text-white hover:text-blue-200 px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 hover:bg-white/10 backdrop-blur-sm border border-white/20">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="group bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-2xl text-sm font-bold shadow-2xl hover:shadow-blue-lg transition-all duration-300 hover:scale-105">
                            <span class="flex items-center space-x-2">
                                <span>Daftar</span>
                                <i class="bi bi-rocket-takeoff group-hover:translate-x-1 transition-transform duration-300"></i>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="group bg-gradient-to-r from-green-500 to-blue-600 text-white px-8 py-3 rounded-2xl text-sm font-bold shadow-2xl hover:shadow-blue-lg transition-all duration-300 hover:scale-105">
                            <span class="flex items-center space-x-2">
                                <i class="bi bi-speedometer2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span>Dashboard</span>
                            </span>
                        </a>
                    @endguest

                    <!-- Mobile menu button -->
                    <div class="lg:hidden">
                        <button type="button" class="relative w-12 h-12 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white hover:bg-white/20 transition-all duration-300 border border-white/20" id="mobile-menu-button">
                            <i class="bi bi-list text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Mobile menu -->
        <div class="lg:hidden hidden" id="mobile-menu">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/95 via-blue-800/95 to-purple-900/95 backdrop-blur-2xl"></div>
            <div class="relative z-10 px-6 py-6 space-y-4">
                <a href="#home" class="group flex items-center space-x-4 text-white font-semibold py-4 px-6 rounded-2xl hover:bg-white/10 transition-all duration-300">
                    <span class="text-2xl"></span>
                    <span>Beranda</span>
                    <i class="bi bi-arrow-right ml-auto group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
                <a href="#features" class="group flex items-center space-x-4 text-white font-semibold py-4 px-6 rounded-2xl hover:bg-white/10 transition-all duration-300">
                    <span class="text-2xl"></span>
                    <span>Fitur</span>
                    <i class="bi bi-arrow-right ml-auto group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
                <a href="#architecture" class="group flex items-center space-x-4 text-white font-semibold py-4 px-6 rounded-2xl hover:bg-white/10 transition-all duration-300">
                    <span class="text-2xl"></span>
                    <span>Arsitektur</span>
                    <i class="bi bi-arrow-right ml-auto group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
                <a href="#about" class="group flex items-center space-x-4 text-white font-semibold py-4 px-6 rounded-2xl hover:bg-white/10 transition-all duration-300">
                    <span class="text-2xl"></span>
                    <span>Tentang</span>
                    <i class="bi bi-arrow-right ml-auto group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>

                <!-- Mobile CTA Buttons -->
                <div class="pt-6 space-y-4 border-t border-white/20">
                    @guest
                        <a href="{{ route('login') }}" class="block text-center text-white font-bold py-4 px-6 rounded-2xl border-2 border-white/30 hover:bg-white/10 transition-all duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block text-center bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-4 px-6 rounded-2xl shadow-2xl hover:shadow-blue-lg transition-all duration-300">
                            Daftar Sekarang
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block text-center bg-gradient-to-r from-green-500 to-blue-600 text-white font-bold py-4 px-6 rounded-2xl shadow-2xl hover:shadow-blue-lg transition-all duration-300">
                            Buka Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center bg-gradient-hero relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400 bg-opacity-20 rounded-full blur-3xl animate-float blob-animation"></div>
            <div class="absolute top-1/3 -left-32 w-80 h-80 bg-purple-400 bg-opacity-15 rounded-full blur-2xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 right-20 w-64 h-64 bg-indigo-400 bg-opacity-20 rounded-full blur-2xl animate-float" style="animation-delay: 4s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-gradient-to-r from-blue-600/10 to-purple-600/10 rounded-full blur-3xl animate-pulse"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <div class="animate-fade-in-up">
                        <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-medium mb-6 border border-white/20">
                            ✨ Revolusi Sistem Inventory Management
                        </div>
                        <h1 class="text-6xl lg:text-8xl font-black text-white mb-8 leading-[0.9] tracking-tight">
                            <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent">SIRIS</span>
                            <span class="block text-4xl lg:text-6xl font-light mt-2 text-blue-100">Sistem Inventory</span>
                            <span class="block text-3xl lg:text-5xl font-extralight mt-1 text-blue-200">Terdistribusi</span>
                        </h1>
                    </div>

                                        <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                        <p class="text-xl lg:text-2xl text-blue-100 mb-10 font-normal leading-relaxed max-w-2xl">
                            Kelola inventory anda di berbagai lokasi dengan
                            <span class="font-bold text-white bg-white/10 px-2 py-1 rounded-lg backdrop-blur-sm"> 3 database terdistribusi</span>,
                            real-time tracking, dan analytics dashboard yang <span class="text-accent font-semibold">powerful</span>.
                        </p>
                    </div>

                    <div class="animate-fade-in-up mb-10" style="animation-delay: 0.4s;">
                        <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                            <span class="px-5 py-3 bg-white/20 text-white rounded-2xl text-sm font-semibold backdrop-blur-sm border border-white/30 hover:bg-white/30 transition-all duration-300 hover:scale-105">
                                <i class="bi bi-database mr-2"></i>Multi-Database
                            </span>
                            <span class="px-5 py-3 bg-white/20 text-white rounded-2xl text-sm font-semibold backdrop-blur-sm border border-white/30 hover:bg-white/30 transition-all duration-300 hover:scale-105">
                                <i class="bi bi-arrow-repeat mr-2"></i>Real-time Sync
                            </span>
                            <span class="px-5 py-3 bg-white/20 text-white rounded-2xl text-sm font-semibold backdrop-blur-sm border border-white/30 hover:bg-white/30 transition-all duration-300 hover:scale-105">
                                <i class="bi bi-graph-up mr-2"></i>Advanced Analytics
                            </span>
                        </div>
                    </div>

                    <div class="animate-fade-in-up flex flex-col sm:flex-row gap-5 justify-center lg:justify-start" style="animation-delay: 0.6s;">
                        @guest
                            <a href="{{ route('register') }}" class="group bg-white text-blue-primary px-10 py-5 rounded-2xl text-lg font-bold inline-flex items-center justify-center space-x-3 hover:shadow-blue-lg transition-all duration-300 hover:scale-105 glow-effect">
                                <span>Mulai Sekarang</span>
                                <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                            </a>
                            <a href="#features" class="border-2 border-white/50 backdrop-blur-sm text-white hover:bg-white hover:text-blue-primary px-10 py-5 rounded-2xl text-lg font-bold transition-all duration-300 hover:scale-105 hover:border-white">
                                <i class="bi bi-play-circle mr-2"></i>Pelajari Lebih
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="group bg-white text-blue-primary px-10 py-5 rounded-2xl text-lg font-bold inline-flex items-center justify-center space-x-3 hover:shadow-blue-lg transition-all duration-300 hover:scale-105 glow-effect">
                                <span>Buka Dashboard</span>
                                <i class="bi bi-speedometer2 group-hover:scale-110 transition-transform duration-300"></i>
                            </a>
                            <a href="#features" class="border-2 border-white/50 backdrop-blur-sm text-white hover:bg-white hover:text-blue-primary px-10 py-5 rounded-2xl text-lg font-bold transition-all duration-300 hover:scale-105 hover:border-white">
                                <i class="bi bi-eye mr-2"></i>Lihat Fitur
                            </a>
                        @endguest
                    </div>
                </div>

                <div class="text-center animate-fade-in-right" style="animation-delay: 0.8s;">
                    <div class="relative">
                        <div class="w-64 h-64 lg:w-80 lg:h-80 mx-auto bg-white bg-opacity-10 rounded-3xl backdrop-blur-sm border border-white border-opacity-20 flex items-center justify-center">
                            <i class="bi bi-diagram-3 text-white text-8xl lg:text-9xl animate-pulse-blue"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gradient-to-br from-white via-blue-50/50 to-purple-50/30 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-400/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block px-6 py-3 bg-blue-primary/10 backdrop-blur-sm rounded-full text-blue-primary text-sm font-bold mb-6 border border-blue-primary/20">
                    ⚡ Fitur-Fitur Canggih
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-gray-900 mb-8 leading-tight">
                    Fitur <span class="text-gradient">Unggulan</span> SIRIS
                </h2>
                <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto font-normal leading-relaxed">
                    Sistem lengkap untuk manajemen inventory multi-lokasi dengan teknologi
                    <span class="text-blue-primary font-bold">database terdistribusi</span> yang modern dan powerful
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group card-hover bg-gradient-card p-8 rounded-3xl shadow-soft border border-gray-100/50 hover:shadow-blue-lg transition-all duration-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300 shadow-blue">
                        <i class="bi bi-boxes text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-primary transition-colors duration-300">Master Data Management</h3>
                    <p class="text-gray-600 mb-6 font-normal leading-relaxed">Kelola produk, kategori, unit, dan karyawan di database master terpisah dengan sistem validasi terintegrasi.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-blue-primary font-bold bg-blue-50 px-3 py-2 rounded-xl">Database: Master</span>
                        <i class="bi bi-arrow-right text-blue-primary group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>

                <div class="group card-hover bg-gradient-card p-8 rounded-3xl shadow-soft border border-gray-100/50 hover:shadow-blue-lg transition-all duration-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300 shadow-blue">
                        <i class="bi bi-geo-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-primary transition-colors duration-300">Multi-Location Inventory</h3>
                    <p class="text-gray-600 mb-6 font-normal leading-relaxed">Pantau stok real-time di berbagai lokasi dengan database location khusus dan sync otomatis antar gudang.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-purple-600 font-bold bg-purple-50 px-3 py-2 rounded-xl">Database: Location</span>
                        <i class="bi bi-arrow-right text-blue-primary group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>

                <div class="group card-hover bg-gradient-card p-8 rounded-3xl shadow-soft border border-gray-100/50 hover:shadow-blue-lg transition-all duration-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300 shadow-blue">
                        <i class="bi bi-arrow-left-right text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-primary transition-colors duration-300"> Transaction System</h3>
                    <p class="text-gray-600 mb-6 font-normal leading-relaxed">Transaksi IN/OUT/TRANSFER dengan database transaction terpisah dan tracking detail.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-green-600 font-bold bg-green-50 px-3 py-2 rounded-xl">Database: Transaction</span>
                        <i class="bi bi-arrow-right text-blue-primary group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>

                <div class="group card-hover bg-gradient-card p-8 rounded-3xl shadow-soft border border-gray-100/50 hover:shadow-blue-lg transition-all duration-500">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-300 shadow-blue">
                        <i class="bi bi-graph-up text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-primary transition-colors duration-300">Advanced Analytics</h3>
                    <p class="text-gray-600 mb-6 font-normal leading-relaxed">Dashboard analytics dengan cross-database queries, laporan real-time, dan insights mendalam untuk bisnis.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-orange-600 font-bold bg-orange-50 px-3 py-2 rounded-xl">Cross-Database</span>
                        <i class="bi bi-arrow-right text-blue-primary group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Database Architecture Section -->
    <section id="architecture" class="py-24 bg-gradient-to-br from-blue-900 via-blue-800 to-purple-900 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-purple-400/10 rounded-full blur-2xl animate-float" style="animation-delay: 4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-bold mb-8 border border-white/20">
                    🏗️ Arsitektur Canggih
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-white mb-8 leading-tight">
                    Arsitektur Database <span class="bg-gradient-to-r from-blue-300 via-white to-purple-300 bg-clip-text text-transparent">Terdistribusi</span>
                </h2>
                <p class="text-xl lg:text-2xl text-blue-100 max-w-4xl mx-auto font-normal leading-relaxed">
                    Sistem revolusioner dengan <span class="text-white font-bold">3 database terpisah</span> untuk performa optimal,
                    skalabilitas tinggi, dan keamanan data yang maksimal
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Master Database -->
                <div class="group card-hover bg-white/10 backdrop-blur-lg p-10 rounded-3xl border border-white/20 text-center hover:bg-white/15 transition-all duration-500">
                    <div class="relative mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                            <i class="bi bi-database text-white text-4xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-400 rounded-full flex items-center justify-center">
                            <i class="bi bi-check text-green-900 text-sm font-bold"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-6">Master DB</h3>
                    <p class="text-blue-200 mb-8 text-lg font-medium">Data Master & Authentication</p>
                    <div class="space-y-4">
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Produk & Kategori</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Unit & Satuan</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Users & Authentication</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Manajemen Karyawan</span>
                        </div>
                    </div>
                </div>

                <!-- Location Database -->
                <div class="group card-hover bg-white/10 backdrop-blur-lg p-10 rounded-3xl border border-white/20 text-center hover:bg-white/15 transition-all duration-500">
                    <div class="relative mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                            <i class="bi bi-geo-alt-fill text-white text-4xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                            <i class="bi bi-lightning-fill text-yellow-900 text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-6">Location DB</h3>
                    <p class="text-blue-200 mb-8 text-lg font-medium">Data Lokasi & Inventory</p>
                    <div class="space-y-4">
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Multi-Lokasi Gudang</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Real-Time Stock Tracking</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Inventory Management</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Location Analytics</span>
                        </div>
                    </div>
                </div>

                <!-- Transaction Database -->
                <div class="group card-hover bg-white/10 backdrop-blur-lg p-10 rounded-3xl border border-white/20 text-center hover:bg-white/15 transition-all duration-500">
                    <div class="relative mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                            <i class="bi bi-arrow-left-right text-white text-4xl"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center">
                            <i class="bi bi-graph-up text-orange-900 text-sm"></i>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-6">Transaction DB</h3>
                    <p class="text-blue-200 mb-8 text-lg font-medium">Data Transaksi & History</p>
                    <div class="space-y-4">
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Transaction IN/OUT/TRANSFER</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Complete Audit Trail</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Transaction Details</span>
                        </div>
                        <div class="flex items-center text-white bg-white/10 p-3 rounded-xl backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300">
                            <i class="bi bi-check-circle text-green-400 text-xl mr-4 flex-shrink-0"></i>
                            <span class="font-semibold">Historical Reports</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Connection Lines Visualization -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center space-x-4 px-8 py-4 bg-white/10 backdrop-blur-lg rounded-2xl border border-white/20">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-blue-400 rounded-full animate-pulse"></div>
                        <span class="text-white font-semibold">Master</span>
                    </div>
                    <div class="text-white">⟷</div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                        <span class="text-white font-semibold">Location</span>
                    </div>
                    <div class="text-white">⟷</div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-green-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                        <span class="text-white font-semibold">Transaction</span>
                    </div>
                </div>
                <p class="text-blue-200 mt-4 font-medium">Sinkronisasi Real-Time Cross-Database</p>
            </div>
        </div>
    </section>

    <!-- Detailed Features -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gradient mb-6">Fitur Lengkap Yang Sudah Tersedia</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light">
                    Sistem yang siap pakai dengan fitur-fitur canggih yang sudah terimplementasi dan siap digunakan
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-blue rounded-xl flex items-center justify-center mr-4">
                            <i class="bi bi-boxes text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Master Data Management</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Manajemen Produk dengan cost & selling price</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Kategori & Unit produk yang fleksibel</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Manajemen Karyawan per lokasi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">User authentication & authorization</span>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-blue rounded-xl flex items-center justify-center mr-4">
                            <i class="bi bi-geo-alt text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Location & Stock Management</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Multi-lokasi gudang & cabang</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Real-time stock tracking</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Min/Max stock alert system</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Stock movement history</span>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-blue rounded-xl flex items-center justify-center mr-4">
                            <i class="bi bi-arrow-left-right text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Transaction System</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Transaksi IN (barang masuk)</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Transaksi OUT (barang keluar)</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Transaksi TRANSFER antar lokasi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Automatic stock adjustment</span>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-blue rounded-xl flex items-center justify-center mr-4">
                            <i class="bi bi-graph-up text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Analytics & Reporting</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Dashboard statistik real-time</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Laporan nilai stok per lokasi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Trend analysis transaksi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-green-500 mr-3 text-lg"></i>
                            <span class="text-gray-700">Top products & locations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose SIRIS -->
    <section class="py-20 bg-gradient-blue">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-8">Mengapa Pilih SIRIS?</h2>
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur-sm">
                                <i class="bi bi-shield-check text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">Database Terdistribusi</h3>
                                <p class="text-blue-100 font-light">3 database terpisah (Master, Location, Transaction) untuk performa optimal dan skalabilitas tinggi.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur-sm">
                                <i class="bi bi-speedometer2 text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">Laravel 11 Technology</h3>
                                <p class="text-blue-100 font-light">Dibangun dengan framework Laravel terbaru, memberikan performa dan keamanan terbaik.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur-sm">
                                <i class="bi bi-people text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-white mb-3">Siap Pakai</h3>
                                <p class="text-blue-100 font-light">Sistem yang sudah lengkap dengan authentication, CRUD operations, dan business logic terintegrasi.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="relative">
                        <div class="w-80 h-80 mx-auto bg-white bg-opacity-10 rounded-3xl backdrop-blur-sm border border-white border-opacity-20 flex items-center justify-center">
                            <i class="bi bi-diagram-2 text-white text-9xl animate-pulse-blue"></i>
                        </div>
                        <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                            <i class="bi bi-lightning-fill text-yellow-900 text-xl"></i>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-green-400 rounded-full flex items-center justify-center animate-pulse">
                            <i class="bi bi-check-circle-fill text-green-900 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">Siap Mengoptimalkan Inventory Anda?</h2>
            <p class="text-xl text-blue-100 mb-10 font-light max-w-2xl mx-auto">
                Bergabunglah dengan SIRIS dan rasakan kemudahan manajemen inventory terdistribusi dengan teknologi terdepan.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}" class="bg-white text-blue-primary px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all duration-300 inline-flex items-center justify-center space-x-2">
                        <span>Daftar Gratis</span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-primary px-8 py-4 rounded-xl text-lg font-semibold transition-all duration-300">
                        Masuk Sekarang
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-white text-blue-primary px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-100 transition-all duration-300 inline-flex items-center justify-center space-x-2">
                        <span>Buka Dashboard</span>
                        <i class="bi bi-speedometer2"></i>
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="about" class="bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 text-white py-20 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-4 gap-10 mb-16">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl">
                            <i class="bi bi-boxes text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-4xl font-black">SIRIS</h2>
                            <p class="text-blue-200 font-medium">Sistem Inventory Terdistribusi</p>
                        </div>
                    </div>
                    <p class="text-blue-100 text-lg font-normal leading-relaxed mb-8 max-w-lg">
                        Revolusi manajemen inventory dengan teknologi <span class="text-white font-bold">3 database terdistribusi</span>,
                        memberikan solusi enterprise-grade untuk bisnis modern yang membutuhkan skalabilitas tinggi.
                    </p>
                    <div class="flex space-x-4">
                        <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
                            <span class="text-white font-semibold">🚀 Enterprise Ready</span>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
                            <span class="text-white font-semibold">⚡ High Performance</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-6 text-white">Database Architecture</h3>
                    <div class="space-y-4">
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-database text-white text-sm"></i>
                                </div>
                                <h4 class="font-bold text-white">Master DB</h4>
                            </div>
                            <p class="text-blue-200 text-sm">Produk, Kategori, Users & Karyawan</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-geo-alt text-white text-sm"></i>
                                </div>
                                <h4 class="font-bold text-white">Location DB</h4>
                            </div>
                            <p class="text-blue-200 text-sm">Multi-Lokasi & Stock Management</p>
                        </div>
                        <div class="bg-white/5 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/10 transition-all duration-300">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                                    <i class="bi bi-arrow-left-right text-white text-sm"></i>
                                </div>
                                <h4 class="font-bold text-white">Transaction DB</h4>
                            </div>
                            <p class="text-blue-200 text-sm">IN/OUT/TRANSFER & Audit Trail</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-6 text-white">Technology Stack</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">Laravel 11 Framework</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">MySQL Distributed System</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">Tailwind CSS Framework</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">Real-time Analytics</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">Responsive Design</span>
                        </div>
                        <div class="flex items-center space-x-3 text-blue-100">
                            <i class="bi bi-check-circle text-green-400 text-lg"></i>
                            <span class="font-semibold">Scalable Architecture</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 py-12 border-y border-white/20">
                <div class="text-center">
                    <div class="text-4xl font-black text-white mb-2">3</div>
                    <div class="text-blue-200 font-medium">Database Terdistribusi</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-white mb-2">∞</div>
                    <div class="text-blue-200 font-medium">Multi-Location Support</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-white mb-2">24/7</div>
                    <div class="text-blue-200 font-medium">Real-time Tracking</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-white mb-2">100%</div>
                    <div class="text-blue-200 font-medium">Enterprise Ready</div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="pt-12">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <div class="flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-8">
                        <p class="text-blue-200 font-medium text-center lg:text-left">
                            &copy; 2024 SIRIS - Sistem Inventory Terdistribusi
                        </p>
                        <div class="flex items-center space-x-2">
                            <span class="text-blue-200">Developed with</span>
                            <i class="bi bi-heart-fill text-red-400 animate-pulse"></i>
                            <span class="text-blue-200">for Modern Businesses</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
                            <span class="text-white font-semibold text-sm">🔥 Production Ready</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Enhanced Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const navbarBg = navbar.querySelector('.absolute.inset-0');

            if (window.scrollY > 80) {
                // Scrolled state - more opaque and solid
                navbarBg.classList.remove('from-blue-900/20', 'via-blue-800/10', 'to-purple-900/20');
                navbarBg.classList.add('from-blue-900/90', 'via-blue-800/85', 'to-purple-900/90');
                navbar.style.transform = 'translateY(0)';
                navbar.style.boxShadow = '0 20px 60px rgba(30, 64, 175, 0.3)';
            } else {
                // Top state - more transparent
                navbarBg.classList.remove('from-blue-900/90', 'via-blue-800/85', 'to-purple-900/90');
                navbarBg.classList.add('from-blue-900/20', 'via-blue-800/10', 'to-purple-900/20');
                navbar.style.transform = 'translateY(0)';
                navbar.style.boxShadow = '0 10px 40px rgba(30, 64, 175, 0.1)';
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Apply observer to elements that need animation
        document.querySelectorAll('.card-hover').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>
