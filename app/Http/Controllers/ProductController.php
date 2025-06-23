<?php

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use App\Models\MasterCategory;
use App\Models\MasterUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = MasterProduct::with(['category', 'unit'])
            ->where('is_active', true)
            ->orderBy('product_name')
            ->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = MasterCategory::orderBy('category_name')->get();
        $units = MasterUnit::orderBy('unit_name')->get();

        return view('products.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|max:50|unique:master_products,product_code',
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:master_categories,id',
            'unit_id' => 'required|exists:master_units,id',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'required|integer|min:0|gte:min_stock',
        ], [
            'product_code.required' => 'Kode produk wajib diisi',
            'product_code.unique' => 'Kode produk sudah digunakan',
            'product_name.required' => 'Nama produk wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'unit_id.required' => 'Unit wajib dipilih',
            'cost_price.required' => 'Harga beli wajib diisi',
            'cost_price.numeric' => 'Harga beli harus berupa angka',
            'selling_price.required' => 'Harga jual wajib diisi',
            'selling_price.numeric' => 'Harga jual harus berupa angka',
            'min_stock.required' => 'Stok minimum wajib diisi',
            'max_stock.required' => 'Stok maksimum wajib diisi',
            'max_stock.gte' => 'Stok maksimum harus lebih besar dari stok minimum',
        ]);

        try {
            MasterProduct::create($request->all());

            return redirect()->route('products.index')
                ->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(MasterProduct $product)
    {
        $product->load(['category', 'unit']);

        return view('products.show', compact('product'));
    }

    public function edit(MasterProduct $product)
    {
        $categories = MasterCategory::orderBy('category_name')->get();
        $units = MasterUnit::orderBy('unit_name')->get();

        return view('products.edit', compact('product', 'categories', 'units'));
    }

    public function update(Request $request, MasterProduct $product)
    {
        $request->validate([
            'product_code' => 'required|string|max:50|unique:master_products,product_code,' . $product->id,
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:master_categories,id',
            'unit_id' => 'required|exists:master_units,id',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'required|integer|min:0',
            'max_stock' => 'required|integer|min:0|gte:min_stock',
        ], [
            'product_code.required' => 'Kode produk wajib diisi',
            'product_code.unique' => 'Kode produk sudah digunakan',
            'product_name.required' => 'Nama produk wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'unit_id.required' => 'Unit wajib dipilih',
            'cost_price.required' => 'Harga beli wajib diisi',
            'cost_price.numeric' => 'Harga beli harus berupa angka',
            'selling_price.required' => 'Harga jual wajib diisi',
            'selling_price.numeric' => 'Harga jual harus berupa angka',
            'min_stock.required' => 'Stok minimum wajib diisi',
            'max_stock.required' => 'Stok maksimum wajib diisi',
            'max_stock.gte' => 'Stok maksimum harus lebih besar dari stok minimum',
        ]);

        try {
            $product->update($request->all());

            return redirect()->route('products.index')
                ->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(MasterProduct $product)
    {
        try {
            // Soft delete - set is_active to false
            $product->update(['is_active' => false]);

            return redirect()->route('products.index')
                ->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
