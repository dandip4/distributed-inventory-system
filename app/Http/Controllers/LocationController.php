<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'country' => 'nullable'
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'location_name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'country' => 'nullable'
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Lokasi berhasil diperbarui');
    }

    public function destroy(Location $location)
    {
        try {
            DB::beginTransaction();

            // Cek apakah lokasi memiliki stok
            if ($location->stocks()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lokasi tidak dapat dihapus karena masih memiliki stok'
                ]);
            }

            // Cek apakah lokasi terlibat dalam transaksi
            if ($location->sourceTransactions()->exists() || $location->destinationTransactions()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lokasi tidak dapat dihapus karena terlibat dalam transaksi'
                ]);
            }

            $location->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lokasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus lokasi'
            ]);
        }
    }
}
