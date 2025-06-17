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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok Menipis -->
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-lg bg-light-warning">
                                        <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Stok Menipis</h6>
                                    <h4 class="mb-0">{{ $lowStockCount }}</h4>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Grafik Transaksi -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div id="transactionChart"></div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Produk -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Produk</h5>
                        </div>
                        <div class="card-body">
                            <div id="productChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Transaksi Terbaru -->
                <div class="col-xl-8">
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
                                            <th>Lokasi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentTransactions as $transaction)
                                            <tr>
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
                                                <td>
                                                    @if($transaction->type == 'in')
                                                        {{ $transaction->destinationLocation->location_name }}
                                                    @elseif($transaction->type == 'out')
                                                        {{ $transaction->sourceLocation->location_name }}
                                                    @else
                                                        {{ $transaction->sourceLocation->location_name }} → {{ $transaction->destinationLocation->location_name }}
                                                    @endif
                                                </td>
                                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <span class="badge bg-success">Selesai</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <tr>
                                                <td>{{ $stock->product->product_name }}</td>
                                                <td>{{ $stock->location->location_name }}</td>
                                                <td>
                                                    <span class="badge bg-danger">{{ $stock->quantity }}</span>
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
                    name: 'Transaksi',
                    data: @json($transactionData)
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
                    curve: 'smooth'
                },
                xaxis: {
                    categories: @json($transactionLabels)
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    }
                }
            };

            var transactionChart = new ApexCharts(document.querySelector("#transactionChart"), transactionOptions);
            transactionChart.render();

            // Grafik Produk
            var productOptions = {
                series: @json($productData),
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: @json($productLabels),
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
        </script>
    @endpush
@endsection
