<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\MasterCategory;
use App\Models\MasterUnit;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ProductController extends Controller
{
    public function index()
    {
        $products = MasterProduct::with(['category', 'unit'])->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = MasterCategory::all();
        $units = MasterUnit::all();
        return view('products.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_code'  => 'required',
            'product_name'  => 'required',
            'category_id'   => 'required',
            'unit_id'       => 'required',
            'min_stock'     => 'required|numeric|min:0',
            'max_stock'     => 'required|numeric|min:0',
            'is_active'     => 'required|boolean'
        ]);

        MasterProduct::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(MasterProduct $product)
    {
        $categories = MasterCategory::all();
        $units = MasterUnit::all();
        return view('products.edit', compact('product', 'categories', 'units'));
    }

    public function update(Request $request, MasterProduct $product)
    {
        $request->validate([
            'product_code'  => 'required',
            'product_name'  => 'required',
            'category_id'   => 'required',
            'unit_id'       => 'required',
            'min_stock'     => 'required|numeric|min:0',
            'max_stock'     => 'required|numeric|min:0',
            'is_active'     => 'required|boolean'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(MasterProduct $product)
    {
        try {
            FacadesDB::beginTransaction();
            $product->delete();
            FacadesDB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            FacadesDB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
