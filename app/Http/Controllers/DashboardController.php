<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\Location;
use App\Models\LocationStock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Produk - menggunakan koneksi 'master'
        $totalProducts = MasterProduct::where('is_active', true)->count();

        // Total Transaksi - menggunakan koneksi 'transaction'
        $totalTransactions = Transaction::count();

        // Total Lokasi - menggunakan koneksi 'location'
        $totalLocations = Location::count();

        // Statistik Transaksi per Tipe
        $totalInTransactions = Transaction::where('type', 'in')->count();
        $totalOutTransactions = Transaction::where('type', 'out')->count();
        $totalTransferTransactions = Transaction::where('type', 'transfer')->count();

        // Nilai Transaksi per Tipe - Semua Waktu
        $totalInValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->where('type', 'in');
        })->sum('total_price');

        $totalOutValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->where('type', 'out');
        })->sum('total_price');

        $totalTransferValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->where('type', 'transfer');
        })->sum('total_price');

        // Statistik Transaksi Hari Ini
        $todayTransactions = Transaction::whereDate('created_at', Carbon::today())->count();
        $todayInTransactions = Transaction::whereDate('created_at', Carbon::today())->where('type', 'in')->count();
        $todayOutTransactions = Transaction::whereDate('created_at', Carbon::today())->where('type', 'out')->count();
        $todayTransferTransactions = Transaction::whereDate('created_at', Carbon::today())->where('type', 'transfer')->count();

        // Nilai Transaksi Hari Ini per Tipe
        $todayInValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereDate('created_at', Carbon::today())->where('type', 'in');
        })->sum('total_price');

        $todayOutValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereDate('created_at', Carbon::today())->where('type', 'out');
        })->sum('total_price');

        $todayTransferValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereDate('created_at', Carbon::today())->where('type', 'transfer');
        })->sum('total_price');

        // Nilai Transaksi Hari Ini - menggunakan koneksi 'transaction'
        $todayTransactionValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereDate('created_at', Carbon::today());
        })->sum('total_price');

        // Statistik Transaksi Minggu Ini
        $weekTransactions = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $weekTransactionValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->sum('total_price');

        // Statistik Transaksi Bulan Ini
        $monthTransactions = Transaction::whereMonth('created_at', Carbon::now()->month)->count();
        $monthTransactionValue = TransactionDetail::whereHas('transaction', function($query) {
            $query->whereMonth('created_at', Carbon::now()->month);
        })->sum('total_price');

        // Total Nilai Stok - menggunakan query terpisah untuk cross-database
        $allStocks = LocationStock::get();
        $activeProducts = MasterProduct::where('is_active', true)->get()->keyBy('id');

        $totalStockValue = 0;
        foreach ($allStocks as $stock) {
            $product = $activeProducts->get($stock->product_id);
            if ($product) {
                $totalStockValue += $stock->quantity * $product->cost_price;
            }
        }

        // Stok Menipis - Perbaiki query untuk multiple database
        // Ambil semua stok dari database location
        $allStocks = LocationStock::with(['location'])->get();

        // Ambil semua produk aktif dari database master
        $activeProducts = MasterProduct::where('is_active', true)->get()->keyBy('id');

        // Filter stok yang menipis
        $lowStockProducts = $allStocks->filter(function ($stock) use ($activeProducts) {
            $product = $activeProducts->get($stock->product_id);
            return $product && $stock->quantity <= $product->min_stock;
        })->take(5);

        $lowStockCount = $lowStockProducts->count();

        // Stok Kosong
        $outOfStockProducts = $allStocks->filter(function ($stock) {
            return $stock->quantity == 0;
        })->take(5);

        $outOfStockCount = $outOfStockProducts->count();

        // Transaksi Terbaru - menggunakan koneksi 'transaction'
        $recentTransactions = Transaction::with(['details.product.category', 'details.product.unit'])
            ->latest()
            ->take(5)
            ->get();

        // Load locations separately for cross-database relationships
        $locationIds = $recentTransactions->pluck('source_location_id')
            ->merge($recentTransactions->pluck('destination_location_id'))
            ->filter()
            ->unique();

        $locations = Location::whereIn('id', $locationIds)->get()->keyBy('id');

        // Produk Terlaris (berdasarkan quantity terjual) - menggunakan query terpisah
        $transactionDetails = TransactionDetail::whereHas('transaction', function($query) {
            $query->where('type', 'out');
        })->get();

        $productSales = [];
        foreach ($transactionDetails as $detail) {
            $productId = $detail->product_id;
            if (!isset($productSales[$productId])) {
                $productSales[$productId] = 0;
            }
            $productSales[$productId] += $detail->quantity;
        }

        // Sort dan ambil top 5
        arsort($productSales);
        $topProductIds = array_slice(array_keys($productSales), 0, 5, true);

        $topProducts = collect();
        foreach ($topProductIds as $productId) {
            $product = $activeProducts->get($productId);
            if ($product) {
                $topProducts->push((object)[
                    'product_name' => $product->product_name,
                    'product_code' => $product->product_code,
                    'total_sold' => $productSales[$productId]
                ]);
            }
        }

        // Lokasi dengan Stok Terbanyak - menggunakan query terpisah
        $locationStocks = [];
        foreach ($allStocks as $stock) {
            $product = $activeProducts->get($stock->product_id);
            if ($product) {
                $locationId = $stock->location_id;
                if (!isset($locationStocks[$locationId])) {
                    $locationStocks[$locationId] = [
                        'location_name' => $stock->location->location_name,
                        'total_stock' => 0
                    ];
                }
                $locationStocks[$locationId]['total_stock'] += $stock->quantity;
            }
        }

        // Sort dan ambil top 5
        uasort($locationStocks, function($a, $b) {
            return $b['total_stock'] <=> $a['total_stock'];
        });

        $topLocations = collect();
        $count = 0;
        foreach ($locationStocks as $locationData) {
            if ($count >= 5) break;
            $topLocations->push((object)$locationData);
            $count++;
        }

        // Data untuk Grafik Transaksi (7 hari terakhir) - menggunakan koneksi 'transaction'
        $transactionData = [];
        $transactionLabels = [];
        $transactionInData = [];
        $transactionOutData = [];
        $transactionTransferData = [];
        $transactionInValueData = [];
        $transactionOutValueData = [];
        $transactionTransferValueData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Transaction::whereDate('created_at', $date)->count();
            $countIn = Transaction::whereDate('created_at', $date)->where('type', 'in')->count();
            $countOut = Transaction::whereDate('created_at', $date)->where('type', 'out')->count();
            $countTransfer = Transaction::whereDate('created_at', $date)->where('type', 'transfer')->count();

            // Nilai transaksi per tipe
            $valueIn = TransactionDetail::whereHas('transaction', function($query) use ($date) {
                $query->whereDate('created_at', $date)->where('type', 'in');
            })->sum('total_price');

            $valueOut = TransactionDetail::whereHas('transaction', function($query) use ($date) {
                $query->whereDate('created_at', $date)->where('type', 'out');
            })->sum('total_price');

            $valueTransfer = TransactionDetail::whereHas('transaction', function($query) use ($date) {
                $query->whereDate('created_at', $date)->where('type', 'transfer');
            })->sum('total_price');

            $transactionData[] = $count;
            $transactionInData[] = $countIn;
            $transactionOutData[] = $countOut;
            $transactionTransferData[] = $countTransfer;
            $transactionInValueData[] = $valueIn;
            $transactionOutValueData[] = $valueOut;
            $transactionTransferValueData[] = $valueTransfer;
            $transactionLabels[] = $date->format('d/m');
        }

        // Data untuk Grafik Produk (berdasarkan kategori) - menggunakan koneksi 'master'
        $productData = [];
        $productLabels = [];

        // Query yang benar untuk grafik produk
        $productsByCategory = MasterProduct::where('is_active', true)
            ->select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        foreach ($productsByCategory as $item) {
            if ($item->category) {
            $productData[] = $item->total;
            $productLabels[] = $item->category->category_name;
            }
        }

        // Data untuk Grafik Nilai Transaksi (7 hari terakhir) - menggunakan query terpisah
        $transactionValueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $value = TransactionDetail::whereHas('transaction', function($query) use ($date) {
                $query->whereDate('created_at', $date);
            })->sum('total_price');
            $transactionValueData[] = $value;
        }

        return view('dashboard', compact(
            'totalProducts',
            'totalTransactions',
            'totalLocations',
            'totalInTransactions',
            'totalOutTransactions',
            'totalTransferTransactions',
            'totalInValue',
            'totalOutValue',
            'totalTransferValue',
            'todayTransactions',
            'todayInTransactions',
            'todayOutTransactions',
            'todayTransferTransactions',
            'todayInValue',
            'todayOutValue',
            'todayTransferValue',
            'todayTransactionValue',
            'weekTransactions',
            'weekTransactionValue',
            'monthTransactions',
            'monthTransactionValue',
            'totalStockValue',
            'lowStockProducts',
            'lowStockCount',
            'outOfStockProducts',
            'outOfStockCount',
            'recentTransactions',
            'locations',
            'topProducts',
            'topLocations',
            'transactionData',
            'transactionLabels',
            'transactionInData',
            'transactionOutData',
            'transactionTransferData',
            'transactionInValueData',
            'transactionOutValueData',
            'transactionTransferValueData',
            'transactionValueData',
            'productData',
            'productLabels',
            'activeProducts'
        ));
    }
}


