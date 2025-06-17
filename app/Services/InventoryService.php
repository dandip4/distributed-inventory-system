<?php

namespace App\Services;

use App\Models\MasterProduct;
use App\Models\Location;
use App\Models\LocationStock;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function createTransaction($data)
    {
        DB::beginTransaction();
        try {
            // Buat transaksi
            $transaction = Transaction::create([
                'transaction_type' => $data['type'],
                'source_location_id' => $data['source_location_id'] ?? null,
                'destination_location_id' => $data['destination_location_id'] ?? null,
                'transaction_date' => now(),
                'reference_number' => $data['reference_number'],
                'notes' => $data['notes'] ?? null,
                'created_by' => auth()->id()
            ]);

            // Update stok
            foreach ($data['items'] as $item) {
                // Update stok lokasi sumber
                if ($data['source_location_id']) {
                    $this->updateStock(
                        $data['source_location_id'],
                        $item['product_id'],
                        -$item['quantity']
                    );
                }

                // Update stok lokasi tujuan
                if ($data['destination_location_id']) {
                    $this->updateStock(
                        $data['destination_location_id'],
                        $item['product_id'],
                        $item['quantity']
                    );
                }

                // Buat detail transaksi
                $transaction->details()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['quantity'] * $item['unit_price']
                ]);
            }

            DB::commit();
            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function updateStock($locationId, $productId, $quantity)
    {
        $stock = LocationStock::where('location_id', $locationId)
            ->where('product_id', $productId)
            ->first();

        if ($stock) {
            $stock->quantity += $quantity;
            $stock->last_updated = now();
            $stock->save();
        } else {
            LocationStock::create([
                'location_id' => $locationId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'last_updated' => now()
            ]);
        }
    }

    public function getStockByLocation($locationId)
    {
        return LocationStock::with(['product.category', 'product.unit'])
            ->where('location_id', $locationId)
            ->get();
    }

    public function getProductStock($productId)
    {
        return LocationStock::with('location')
            ->where('product_id', $productId)
            ->get();
    }

    public function getTransactionHistory($filters = [])
    {
        $query = Transaction::with(['details.product', 'sourceLocation', 'destinationLocation', 'creator']);

        if (isset($filters['type'])) {
            $query->where('transaction_type', $filters['type']);
        }

        if (isset($filters['location_id'])) {
            $query->where(function($q) use ($filters) {
                $q->where('source_location_id', $filters['location_id'])
                  ->orWhere('destination_location_id', $filters['location_id']);
            });
        }

        if (isset($filters['start_date'])) {
            $query->where('transaction_date', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->where('transaction_date', '<=', $filters['end_date']);
        }

        return $query->orderBy('transaction_date', 'desc')->paginate(10);
    }
}
