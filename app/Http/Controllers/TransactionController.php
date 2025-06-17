<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:IN,OUT,TRANSFER',
            'source_location_id' => 'required_if:type,OUT,TRANSFER|exists:locations,id',
            'destination_location_id' => 'required_if:type,IN,TRANSFER|exists:locations,id',
            'reference_number' => 'required|string|unique:transactions,reference_number',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:master_products,id',
            'items.*.quantity' => 'required|numeric|min:0',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        try {
            $transaction = $this->inventoryService->createTransaction($validated);

            return response()->json([
                'message' => 'Transaksi berhasil dibuat',
                'data' => $transaction->load(['details.product', 'sourceLocation', 'destinationLocation'])
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        $filters = $request->only(['type', 'location_id', 'start_date', 'end_date']);

        try {
            $transactions = $this->inventoryService->getTransactionHistory($filters);

            return response()->json([
                'data' => $transactions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $transaction = Transaction::with(['details.product', 'sourceLocation', 'destinationLocation', 'creator'])
                ->findOrFail($id);

            return response()->json([
                'data' => $transaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Transaksi tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
