<?php

namespace App\Http\Controllers;

use App\Models\LocationStock;
use App\Models\Location;
use App\Models\MasterProduct;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = LocationStock::with(['location', 'product'])->get();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $locations = Location::all();
        $products = MasterProduct::all();
        return view('stocks.create', compact('locations', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:0'
        ]);

        // Cek apakah stok sudah ada
        $stock = LocationStock::where('location_id', $request->location_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($stock) {
            return redirect()->back()
                ->with('error', 'Stok untuk produk ini sudah ada di lokasi tersebut');
        }

        LocationStock::create($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }

    public function edit(LocationStock $stock)
    {
        $locations = Location::all();
        $products = MasterProduct::all();
        return view('stocks.edit', compact('stock', 'locations', 'products'));
    }

    public function update(Request $request, LocationStock $stock)
    {
        $request->validate([
            'location_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:0'
        ]);

        // Cek apakah stok sudah ada di lokasi lain
        $existingStock = LocationStock::where('location_id', $request->location_id)
            ->where('product_id', $request->product_id)
            ->where('id', '!=', $stock->id)
            ->first();

        if ($existingStock) {
            return redirect()->back()
                ->with('error', 'Stok untuk produk ini sudah ada di lokasi tersebut');
        }

        $stock->update($request->all());

        return redirect()->route('stocks.index')
            ->with('success', 'Stok berhasil diperbarui');
    }

    public function destroy(LocationStock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')
            ->with('success', 'Stok berhasil dihapus');
    }
}