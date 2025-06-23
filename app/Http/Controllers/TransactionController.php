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
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['details.product.category', 'details.product.unit'])
            ->latest()
            ->get();

        // Load locations separately for cross-database relationships
        $locationIds = $transactions->pluck('source_location_id')
            ->merge($transactions->pluck('destination_location_id'))
            ->filter()
            ->unique();

        $locations = Location::whereIn('id', $locationIds)->get()->keyBy('id');

        return view('transactions.index', compact('transactions', 'locations'));
    }

    public function create()
    {
        $products = MasterProduct::where('is_active', true)
            ->with(['category', 'unit'])
            ->orderBy('product_name')
            ->get();

        $locations = Location::orderBy('location_name')->get();

        // Generate transaction number
        $lastTransaction = Transaction::latest()->first();
        $transactionNumber = 'TRX-' . date('Y') . '-' . str_pad(($lastTransaction ? intval(substr($lastTransaction->transaction_number, -3)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        return view('transactions.create', compact('products', 'locations', 'transactionNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_number' => 'required|string|unique:transactions,transaction_number',
            'type' => 'required|in:in,out,transfer',
            'source_location_id' => 'nullable',
            'destination_location_id' => 'nullable',
            'destination_info' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
            'products.*.price_type' => 'required|in:cost,selling,custom',
        ], [
            'transaction_number.required' => 'Nomor transaksi wajib diisi',
            'transaction_number.unique' => 'Nomor transaksi sudah digunakan',
            'type.required' => 'Tipe transaksi wajib dipilih',
            'type.in' => 'Tipe transaksi tidak valid',
            'destination_info.max' => 'Informasi tujuan maksimal 255 karakter',
            'products.required' => 'Produk wajib dipilih',
            'products.min' => 'Minimal 1 produk',
            'products.*.product_id.required' => 'Produk wajib dipilih',
            'products.*.quantity.required' => 'Quantity wajib diisi',
            'products.*.quantity.integer' => 'Quantity harus berupa angka',
            'products.*.quantity.min' => 'Quantity minimal 1',
            'products.*.unit_price.required' => 'Harga unit wajib diisi',
            'products.*.unit_price.numeric' => 'Harga unit harus berupa angka',
            'products.*.unit_price.min' => 'Harga unit minimal 0',
            'products.*.price_type.required' => 'Tipe harga wajib dipilih',
            'products.*.price_type.in' => 'Tipe harga tidak valid',
        ]);

        // Validate location based on transaction type
        if ($request->type == 'in' && !$request->destination_location_id) {
            return back()->withInput()->withErrors(['destination_location_id' => 'Lokasi tujuan wajib diisi untuk transaksi masuk']);
        }

        if ($request->type == 'out' && !$request->source_location_id) {
            return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber wajib diisi untuk transaksi keluar']);
        }

        if ($request->type == 'out' && !$request->destination_info) {
            return back()->withInput()->withErrors(['destination_info' => 'Informasi tujuan wajib diisi untuk transaksi keluar']);
        }

        if ($request->type == 'transfer' && (!$request->source_location_id || !$request->destination_location_id)) {
            return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber dan tujuan wajib diisi untuk transaksi transfer']);
        }

        // Validate location exists manually
        if ($request->source_location_id) {
            $sourceLocation = Location::find($request->source_location_id);
            if (!$sourceLocation) {
                return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber tidak valid']);
            }
        }

        if ($request->destination_location_id) {
            $destinationLocation = Location::find($request->destination_location_id);
            if (!$destinationLocation) {
                return back()->withInput()->withErrors(['destination_location_id' => 'Lokasi tujuan tidak valid']);
            }
        }

        // Validate products exist manually
        foreach ($request->products as $index => $productData) {
            $product = MasterProduct::find($productData['product_id']);
            if (!$product) {
                return back()->withInput()->withErrors(["products.{$index}.product_id" => 'Produk tidak valid']);
            }
        }

        try {
            DB::beginTransaction();

            // Create transaction
            $transaction = Transaction::create([
                'transaction_number' => $request->transaction_number,
                'type' => $request->type,
                'source_location_id' => $request->source_location_id,
                'destination_location_id' => $request->destination_location_id,
                'destination_info' => $request->destination_info,
                'notes' => $request->notes,
            ]);

            // Create transaction details
            foreach ($request->products as $productData) {
                $product = MasterProduct::find($productData['product_id']);

                // Calculate unit price based on price type
                $unitPrice = $this->calculateUnitPrice($product, $productData['price_type'], $productData['unit_price']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'unit_price' => $unitPrice,
                    'total_price' => $unitPrice * $productData['quantity'],
                ]);

                // Update stock
                $this->updateStock($transaction, $productData['product_id'], $productData['quantity']);
            }

            DB::commit();

            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Transaksi berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['details.product.category', 'details.product.unit']);

        // Load locations separately
        $locationIds = collect([$transaction->source_location_id, $transaction->destination_location_id])->filter();
        $locations = Location::whereIn('id', $locationIds)->get()->keyBy('id');

        return view('transactions.show', compact('transaction', 'locations'));
    }

    public function edit(Transaction $transaction)
    {
        $products = MasterProduct::where('is_active', true)
            ->with(['category', 'unit'])
            ->orderBy('product_name')
            ->get();

        $locations = Location::orderBy('location_name')->get();

        $transaction->load(['details.product']);

        return view('transactions.edit', compact('transaction', 'products', 'locations'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:in,out,transfer',
            'source_location_id' => 'nullable',
            'destination_location_id' => 'nullable',
            'destination_info' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
            'products.*.price_type' => 'required|in:cost,selling,custom',
        ]);

        // Validate location based on transaction type
        if ($request->type == 'in' && !$request->destination_location_id) {
            return back()->withInput()->withErrors(['destination_location_id' => 'Lokasi tujuan wajib diisi untuk transaksi masuk']);
        }

        if ($request->type == 'out' && !$request->source_location_id) {
            return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber wajib diisi untuk transaksi keluar']);
        }

        if ($request->type == 'out' && !$request->destination_info) {
            return back()->withInput()->withErrors(['destination_info' => 'Informasi tujuan wajib diisi untuk transaksi keluar']);
        }

        if ($request->type == 'transfer' && (!$request->source_location_id || !$request->destination_location_id)) {
            return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber dan tujuan wajib diisi untuk transaksi transfer']);
        }

        // Validate location exists manually
        if ($request->source_location_id) {
            $sourceLocation = Location::find($request->source_location_id);
            if (!$sourceLocation) {
                return back()->withInput()->withErrors(['source_location_id' => 'Lokasi sumber tidak valid']);
            }
        }

        if ($request->destination_location_id) {
            $destinationLocation = Location::find($request->destination_location_id);
            if (!$destinationLocation) {
                return back()->withInput()->withErrors(['destination_location_id' => 'Lokasi tujuan tidak valid']);
            }
        }

        // Validate products exist manually
        foreach ($request->products as $index => $productData) {
            $product = MasterProduct::find($productData['product_id']);
            if (!$product) {
                return back()->withInput()->withErrors(["products.{$index}.product_id" => 'Produk tidak valid']);
            }
        }

        try {
            DB::beginTransaction();

            // Reverse previous stock changes
            foreach ($transaction->details as $detail) {
                $this->reverseStockUpdate($transaction, $detail->product_id, $detail->quantity);
            }

            // Update transaction
            $transaction->update([
                'type' => $request->type,
                'source_location_id' => $request->source_location_id,
                'destination_location_id' => $request->destination_location_id,
                'destination_info' => $request->destination_info,
                'notes' => $request->notes,
            ]);

            // Delete old details
            $transaction->details()->delete();

            // Create new transaction details
            foreach ($request->products as $productData) {
                $product = MasterProduct::find($productData['product_id']);

                // Calculate unit price based on price type
                $unitPrice = $this->calculateUnitPrice($product, $productData['price_type'], $productData['unit_price']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'unit_price' => $unitPrice,
                    'total_price' => $unitPrice * $productData['quantity'],
                ]);

                // Update stock
                $this->updateStock($transaction, $productData['product_id'], $productData['quantity']);
            }

            DB::commit();

            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Transaksi berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();

            // Reverse stock changes
            foreach ($transaction->details as $detail) {
                $this->reverseStockUpdate($transaction, $detail->product_id, $detail->quantity);
            }

            // Delete transaction details
            $transaction->details()->delete();

            // Delete transaction
            $transaction->delete();

            DB::commit();

            return redirect()->route('transactions.index')
                ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateUnitPrice($product, $priceType, $customPrice = 0)
    {
        switch ($priceType) {
            case 'cost':
                return $product->cost_price;
            case 'selling':
                return $product->selling_price;
            case 'custom':
                return $customPrice;
            default:
                return $product->selling_price;
        }
    }

    private function updateStock($transaction, $productId, $quantity)
    {
        switch ($transaction->type) {
            case 'in':
                // Add to destination location
                $this->updateLocationStock($transaction->destination_location_id, $productId, $quantity, 'add');
                break;

            case 'out':
                // Subtract from source location
                $this->updateLocationStock($transaction->source_location_id, $productId, $quantity, 'subtract');
                break;

            case 'transfer':
                // Subtract from source, add to destination
                $this->updateLocationStock($transaction->source_location_id, $productId, $quantity, 'subtract');
                $this->updateLocationStock($transaction->destination_location_id, $productId, $quantity, 'add');
                break;
        }
    }

    private function reverseStockUpdate($transaction, $productId, $quantity)
    {
        switch ($transaction->type) {
            case 'in':
                // Subtract from destination location
                $this->updateLocationStock($transaction->destination_location_id, $productId, $quantity, 'subtract');
                break;

            case 'out':
                // Add to source location
                $this->updateLocationStock($transaction->source_location_id, $productId, $quantity, 'add');
                break;

            case 'transfer':
                // Add to source, subtract from destination
                $this->updateLocationStock($transaction->source_location_id, $productId, $quantity, 'add');
                $this->updateLocationStock($transaction->destination_location_id, $productId, $quantity, 'subtract');
                break;
        }
    }

    private function updateLocationStock($locationId, $productId, $quantity, $operation)
    {
        $stock = LocationStock::where('location_id', $locationId)
            ->where('product_id', $productId)
            ->first();

        if ($stock) {
            if ($operation == 'add') {
                $stock->quantity += $quantity;
            } else {
                $stock->quantity = max(0, $stock->quantity - $quantity);
            }
            $stock->last_updated = now();
            $stock->save();
        } else {
            // Create new stock record if doesn't exist
            if ($operation == 'add') {
                LocationStock::create([
                    'location_id' => $locationId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'last_updated' => now(),
                ]);
            }
        }
    }

    public function getProductPrice(Request $request)
    {
        $product = MasterProduct::find($request->product_id);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'cost_price' => $product->cost_price,
            'selling_price' => $product->selling_price,
        ]);
    }
}
