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
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Utama -->
            <div class="row">
                <!-- Total Produk -->
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-primary">
                                        <i class="fas fa-box fa-2x text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Total Produk</h6>
                                    <h4 class="mb-0">{{ $totalProducts }}</h4>
                                    <small class="text-muted">Produk aktif</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-success">
                                        <i class="fas fa-exchange-alt fa-2x text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Total Transaksi</h6>
                                    <h4 class="mb-0">{{ $totalTransactions }}</h4>
                                    <small class="text-muted">Semua waktu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Lokasi -->
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-info">
                                        <i class="fas fa-map-marker-alt fa-2x text-info"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Total Lokasi</h6>
                                    <h4 class="mb-0">{{ $totalLocations }}</h4>
                                    <small class="text-muted">Gudang & Showroom</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Nilai Stok -->
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-warning">
                                        <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Nilai Stok</h6>
                                    <h4 class="mb-0">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</h4>
                                    <small class="text-muted">Berdasarkan harga beli</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Transaksi -->


            <!-- Nilai Transaksi per Tipe -->
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-success">
                                        <i class="fas fa-arrow-down fa-2x text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Nilai Transaksi Masuk</h6>
                                    <h4 class="mb-0 text-success">Rp {{ number_format($totalInValue, 0, ',', '.') }}</h4>
                                    <small class="text-muted">{{ $totalInTransactions }} transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-danger">
                                        <i class="fas fa-arrow-up fa-2x text-danger"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Nilai Transaksi Keluar</h6>
                                    <h4 class="mb-0 text-danger">Rp {{ number_format($totalOutValue, 0, ',', '.') }}</h4>
                                    <small class="text-muted">{{ $totalOutTransactions }} transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-warning">
                                        <i class="fas fa-exchange-alt fa-2x text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Nilai Transaksi Transfer</h6>
                                    <h4 class="mb-0 text-warning">Rp {{ number_format($totalTransferValue, 0, ',', '.') }}</h4>
                                    <small class="text-muted">{{ $totalTransferTransactions }} transaksi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="row">
                <!-- Grafik Transaksi -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Transaksi (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            <div id="transactionChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Nilai Transaksi -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Nilai Transaksi (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            <div id="transactionValueChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Nilai Transaksi per Tipe -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Nilai Transaksi per Tipe (7 Hari Terakhir)</h5>
                        </div>
                        <div class="card-body">
                            <div id="transactionValueByTypeChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Produk dan Statistik -->
            <div class="row">
                <!-- Grafik Produk -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Distribusi Produk per Kategori</h5>
                        </div>
                        <div class="card-body">
                            <div id="productChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Periode -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Statistik Periode</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <h4 class="text-primary">{{ $weekTransactions }}</h4>
                                        <p class="mb-1">Transaksi Minggu Ini</p>
                                        <h6 class="text-success">Rp {{ number_format($weekTransactionValue, 0, ',', '.') }}</h6>
                                        <small class="text-muted">Total Nilai</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <h4 class="text-primary">{{ $monthTransactions }}</h4>
                                        <p class="mb-1">Transaksi Bulan Ini</p>
                                        <h6 class="text-success">Rp {{ number_format($monthTransactionValue, 0, ',', '.') }}</h6>
                                        <small class="text-muted">Total Nilai</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 border rounded">
                                        <h4 class="text-warning">{{ $lowStockCount }}</h4>
                                        <p class="mb-1">Stok Menipis</p>
                                        <h6 class="text-danger">{{ $outOfStockCount }}</h6>
                                        <small class="text-muted">Stok Kosong</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Informasi -->
            <div class="row">
                <!-- Transaksi Terbaru -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Transaksi Terbaru</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Transaksi</th>
                                            <th>Tipe</th>
                                            <th>Tujuan</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentTransactions as $transaction)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="text-decoration-none">
                                                        {{ $transaction->transaction_number }}
                                                    </a>
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
                                                    @if($transaction->type == 'out' && $transaction->destination_info)
                                                        <span class="text-primary">{{ $transaction->destination_info }}</span>
                                                    @elseif($transaction->destination_location_id && isset($locations[$transaction->destination_location_id]))
                                                        <span class="text-muted">{{ $locations[$transaction->destination_location_id]->location_name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk Terlaris -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Produk Terlaris</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Kode</th>
                                            <th>Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topProducts as $product)
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td><span class="badge bg-secondary">{{ $product->product_code }}</span></td>
                                                <td>
                                                    <span class="badge bg-success">{{ number_format($product->total_sold) }}</span>
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

            <!-- Stok dan Lokasi -->
            <div class="row">
                <!-- Stok Menipis -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Stok Menipis</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Lokasi</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lowStockProducts as $stock)
                                            @php
                                                $product = $activeProducts->get($stock->product_id);
                                            @endphp
                                            @if($product)
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $stock->location->location_name }}</td>
                                                <td>
                                                    <span class="badge bg-warning">{{ $stock->quantity }}</span>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok Kosong -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Stok Kosong</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($outOfStockProducts as $stock)
                                            @php
                                                $product = $activeProducts->get($stock->product_id);
                                            @endphp
                                            @if($product)
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $stock->location->location_name }}</td>
                                                <td>
                                                    <span class="badge bg-danger">Kosong</span>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lokasi dengan Stok Terbanyak -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lokasi dengan Stok Terbanyak</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Lokasi</th>
                                            <th>Total Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topLocations as $location)
                                            <tr>
                                                <td>{{ $location->location_name }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ number_format($location->total_stock) }}</span>
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
            // Grafik Transaksi
            var transactionOptions = {
                series: [{
                    name: 'Total',
                    data: @json($transactionData)
                }, {
                    name: 'Masuk',
                    data: @json($transactionInData)
                }, {
                    name: 'Keluar',
                    data: @json($transactionOutData)
                }, {
                    name: 'Transfer',
                    data: @json($transactionTransferData)
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#6366f1', '#10b981', '#ef4444', '#f59e0b'],
                xaxis: {
                    categories: @json($transactionLabels)
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    }
                },
                legend: {
                    position: 'top'
                },
                noData: {
                    text: 'Tidak ada data transaksi'
                }
            };

            var transactionChart = new ApexCharts(document.querySelector("#transactionChart"), transactionOptions);
            transactionChart.render();

            // Grafik Nilai Transaksi
            var transactionValueOptions = {
                series: [{
                    name: 'Nilai Transaksi',
                    data: @json($transactionValueData)
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#10b981'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: @json($transactionLabels)
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                },
                noData: {
                    text: 'Tidak ada data nilai transaksi'
                }
            };

            var transactionValueChart = new ApexCharts(document.querySelector("#transactionValueChart"), transactionValueOptions);
            transactionValueChart.render();

            // Grafik Produk
            var productOptions = {
                series: @json($productData),
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: @json($productLabels),
                colors: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4'],
                noData: {
                    text: 'Tidak ada data produk'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var productChart = new ApexCharts(document.querySelector("#productChart"), productOptions);
            productChart.render();

            // Grafik Nilai Transaksi per Tipe
            var transactionValueByTypeOptions = {
                series: [{
                    name: 'Nilai Masuk',
                    data: @json($transactionInValueData)
                }, {
                    name: 'Nilai Keluar',
                    data: @json($transactionOutValueData)
                }, {
                    name: 'Nilai Transfer',
                    data: @json($transactionTransferValueData)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: false,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                colors: ['#10b981', '#ef4444', '#f59e0b'],
                xaxis: {
                    categories: @json($transactionLabels),
                    title: {
                        text: 'Tanggal'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Nilai (Rp)'
                    },
                    labels: {
                        formatter: function (value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                },
                legend: {
                    position: 'top'
                },
                noData: {
                    text: 'Tidak ada data nilai transaksi per tipe'
                }
            };

            var transactionValueByTypeChart = new ApexCharts(document.querySelector("#transactionValueByTypeChart"), transactionValueByTypeOptions);
            transactionValueByTypeChart.render();
        </script>
    @endpush
@endsection
