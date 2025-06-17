<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $units = MasterUnit::all();
        return view('master.units.index', compact('units'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'unit_name' => 'required|string|max:255',
                'unit_symbol' => 'required|string|max:10'
            ]);

            DB::beginTransaction();

            MasterUnit::create([
                'unit_name' => $request->unit_name,
                'unit_symbol' => $request->unit_symbol
            ]);

            DB::commit();

            return redirect()->route('master.units.index')
                ->with('success', 'Satuan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('master.units.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, MasterUnit $unit)
    {
        try {
            $request->validate([
                'unit_name' => 'required|string|max:255',
                'unit_symbol' => 'required|string|max:10'
            ]);

            DB::beginTransaction();

            $unit->update([
                'unit_name' => $request->unit_name,
                'unit_symbol' => $request->unit_symbol
            ]);

            DB::commit();

            return redirect()->route('master.units.index')
                ->with('success', 'Satuan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('master.units.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(MasterUnit $unit)
    {
        try {
            DB::beginTransaction();
            $unit->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Satuan berhasil dihapus'
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
