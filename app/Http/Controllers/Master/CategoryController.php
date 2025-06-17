<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = MasterCategory::all();
        return view('master.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            DB::beginTransaction();

            MasterCategory::create([
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);

            DB::commit();

            return redirect()->route('master.categories.index')
                ->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('master.categories.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, MasterCategory $category)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            DB::beginTransaction();

            $category->update([
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);

            DB::commit();

            return redirect()->route('master.categories.index')
                ->with('success', 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('master.categories.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(MasterCategory $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
