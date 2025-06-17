<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\Location;
use App\Models\LocationStock;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = MasterProduct::count();
        $totalLocations = Location::count();
        $totalStock = LocationStock::sum('quantity');
        $recentTransactions = Transaction::with(['sourceLocation', 'destinationLocation'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalLocations',
            'totalStock',
            'recentTransactions'
        ));
    }
}
