<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MasterProduct;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\LocationStock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['details', 'sourceLocation', 'destinationLocation'])
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $locations = Location::all();
        $products = MasterProduct::all();
        return view('transactions.create', compact('locations', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:in,out,transfer',
            'source_location_id' => 'required_if:type,out,transfer',
            'destination_location_id' => 'required_if:type,in,transfer',
            'notes' => 'nullable|string',
            'details' => 'required|array|min:1',
            'details.*.product_id' => 'required',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.unit_price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'transaction_number' => 'TRX-' . Str::random(10),
                'type' => $request->type,
                'source_location_id' => $request->source_location_id,
                'destination_location_id' => $request->destination_location_id,
                'notes' => $request->notes,
            ]);

            foreach ($request->details as $detail) {
                $transaction->details()->create([
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'total_price' => $detail['quantity'] * $detail['unit_price'],
                ]);

                if (in_array($request->type, ['out', 'transfer'])) {
                    $sourceStock = LocationStock::where('location_id', $request->source_location_id)
                        ->where('product_id', $detail['product_id'])
                        ->first();

                    if (!$sourceStock) {
                        throw new \Exception('Stok tidak ditemukan di lokasi sumber');
                    }

                    if ($sourceStock->quantity < $detail['quantity']) {
                        throw new \Exception('Stok tidak mencukupi di lokasi sumber');
                    }

                    $sourceStock->quantity -= $detail['quantity'];
                    $sourceStock->last_updated = now();
                    $sourceStock->save();
                }

                if (in_array($request->type, ['in', 'transfer'])) {
                    $destinationStock = LocationStock::where('location_id', $request->destination_location_id)
                        ->where('product_id', $detail['product_id'])
                        ->first();

                    if ($destinationStock) {
                        $destinationStock->quantity += $detail['quantity'];
                        $destinationStock->last_updated = now();
                        $destinationStock->save();
                    } else {
                        LocationStock::create([
                            'location_id' => $request->destination_location_id,
                            'product_id' => $detail['product_id'],
                            'quantity' => $detail['quantity'],
                            'last_updated' => now()
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['details.product', 'sourceLocation', 'destinationLocation']);
        return view('transactions.show', compact('transaction'));
    }
}
