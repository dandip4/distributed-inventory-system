<?php
namespace App\Http\Controllers;

use App\Models\MasterEmploye;
use App\Models\LocationEmploye;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = MasterEmploye::with('locationDetail')->get();
        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'is_active'=> 'required|boolean',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'position' => 'nullable|string|max:100',
        ]);

        DB::connection('master')->beginTransaction();
        DB::connection('location')->beginTransaction();

        try {
            $master = MasterEmploye::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'is_active' => $request->is_active,
            ]);

            LocationEmploye::create([
                'id'      => $master->id,
                'phone'   => $request->phone,
                'address' => $request->address,
                'position'=> $request->position,
            ]);

            DB::connection('master')->commit();
            DB::connection('location')->commit();

            return redirect()->route('employes.index')->with('success', 'Pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::connection('master')->rollBack();
            DB::connection('location')->rollBack();
            return back()->withInput()->with('error', 'Gagal menambah pegawai: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $master = MasterEmploye::findOrFail($id);
        $location = LocationEmploye::find($id);
        return view('employes.edit', compact('master', 'location'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'is_active'=> 'required|boolean',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'position' => 'nullable|string|max:100',
        ]);

        DB::connection('master')->beginTransaction();
        DB::connection('location')->beginTransaction();

        try {
            $master = MasterEmploye::findOrFail($id);
            $master->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'is_active' => $request->is_active,
            ]);

            $location = LocationEmploye::find($id);
            if ($location) {
                $location->update([
                    'phone'    => $request->phone,
                    'address'  => $request->address,
                    'position' => $request->position,
                ]);
            } else {
                LocationEmploye::create([
                    'id'      => $id,
                    'phone'   => $request->phone,
                    'address' => $request->address,
                    'position'=> $request->position,
                ]);
            }

            DB::connection('master')->commit();
            DB::connection('location')->commit();

            return redirect()->route('employes.index')->with('success', 'Pegawai berhasil diupdate');
        } catch (\Exception $e) {
            DB::connection('master')->rollBack();
            DB::connection('location')->rollBack();
            return back()->withInput()->with('error', 'Gagal update pegawai: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::connection('master')->beginTransaction();
        DB::connection('location')->beginTransaction();

        try {
            MasterEmploye::destroy($id);
            LocationEmploye::destroy($id);

            DB::connection('master')->commit();
            DB::connection('location')->commit();

            return redirect()->route('employes.index')->with('success', 'Pegawai berhasil dihapus');
        } catch (\Exception $e) {
            DB::connection('master')->rollBack();
            DB::connection('location')->rollBack();
            return back()->with('error', 'Gagal hapus pegawai: ' . $e->getMessage());
        }
    }
}
