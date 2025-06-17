<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\Location;
use App\Models\LocationStock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Produk
        $totalProducts = MasterProduct::where('is_active', true)->count();

        // Total Transaksi
        $totalTransactions = Transaction::count();

        // Total Lokasi
        $totalLocations = Location::count();

        // Stok Menipis
        $lowStockProducts = LocationStock::with(['product', 'location'])
            ->get()
            ->filter(function ($stock) {
                return $stock->quantity <= $stock->product->min_stock;
            });
        $lowStockCount = $lowStockProducts->count();

        // Transaksi Terbaru
        $recentTransactions = Transaction::with(['sourceLocation', 'destinationLocation', 'details'])
            ->latest()
            ->take(5)
            ->get();

        // Data untuk Grafik Transaksi (7 hari terakhir)
        $transactionData = [];
        $transactionLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = Transaction::whereDate('created_at', $date)->count();
            $transactionData[] = $count;
            $transactionLabels[] = $date->format('d/m');
        }

        // Data untuk Grafik Produk (berdasarkan kategori)
        $productData = [];
        $productLabels = [];
        $productsByCategory = MasterProduct::where('is_active', true)
            ->select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        foreach ($productsByCategory as $item) {
            $productData[] = $item->total;
            $productLabels[] = $item->category->category_name;
        }

        return view('dashboard', compact(
            'totalProducts',
            'totalTransactions',
            'totalLocations',
            'lowStockProducts',
            'lowStockCount',
            'recentTransactions',
            'transactionData',
            'transactionLabels',
            'productData',
            'productLabels'
        ));
    }
}
