<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // Seed Transactions
        DB::connection('transaction')->table('transactions')->insert([
            [
                'transaction_number' => 'TRX-2024-001',
                'type' => 'in',
                'source_location_id' => null,
                'destination_location_id' => 1, // Gudang Utama
                'destination_info' => null,
                'notes' => 'Pembelian awal stok dari supplier',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'transaction_number' => 'TRX-2024-002',
                'type' => 'transfer',
                'source_location_id' => 1, // Gudang Utama
                'destination_location_id' => 2, // Gudang Cabang 1
                'destination_info' => null,
                'notes' => 'Transfer stok ke cabang untuk distribusi',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'transaction_number' => 'TRX-2024-003',
                'type' => 'out',
                'source_location_id' => 4, // Showroom Jakarta
                'destination_location_id' => null,
                'destination_info' => 'Customer Retail - PT Maju Bersama',
                'notes' => 'Penjualan ke customer retail',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'transaction_number' => 'TRX-2024-004',
                'type' => 'in',
                'source_location_id' => null,
                'destination_location_id' => 3, // Gudang Cabang 2
                'destination_info' => null,
                'notes' => 'Restock dari supplier lokal',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'transaction_number' => 'TRX-2024-005',
                'type' => 'transfer',
                'source_location_id' => 1, // Gudang Utama
                'destination_location_id' => 5, // Showroom Bandung
                'destination_info' => null,
                'notes' => 'Transfer untuk display showroom',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'transaction_number' => 'TRX-2024-006',
                'type' => 'out',
                'source_location_id' => 2, // Gudang Cabang 1
                'destination_location_id' => null,
                'destination_info' => 'Distributor - CV Sukses Mandiri',
                'notes' => 'Penjualan grosir ke distributor',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'transaction_number' => 'TRX-2024-007',
                'type' => 'in',
                'source_location_id' => null,
                'destination_location_id' => 1, // Gudang Utama
                'destination_info' => null,
                'notes' => 'Pembelian stok baru dari supplier utama',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'transaction_number' => 'TRX-2024-008',
                'type' => 'out',
                'source_location_id' => 4, // Showroom Jakarta
                'destination_location_id' => null,
                'destination_info' => 'Customer Retail - Bapak Ahmad',
                'notes' => 'Penjualan retail ke customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Transaction Details dengan harga yang sesuai master produk
        DB::connection('transaction')->table('transaction_details')->insert([
            // TRX-2024-001 - Pembelian awal (menggunakan harga beli)
            [
                'transaction_id' => 1,
                'product_id' => 1, // Laptop Asus
                'quantity' => 30,
                'unit_price' => 8500000, // cost_price
                'total_price' => 255000000,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'transaction_id' => 1,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 100,
                'unit_price' => 120000, // cost_price
                'total_price' => 12000000,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'transaction_id' => 1,
                'product_id' => 3, // Kaos Polos
                'quantity' => 200,
                'unit_price' => 35000, // cost_price
                'total_price' => 7000000,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],

            // TRX-2024-002 - Transfer ke cabang (menggunakan harga jual)
            [
                'transaction_id' => 2,
                'product_id' => 1, // Laptop Asus
                'quantity' => 15,
                'unit_price' => 9500000, // selling_price
                'total_price' => 142500000,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'transaction_id' => 2,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 50,
                'unit_price' => 150000, // selling_price
                'total_price' => 7500000,
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],

            // TRX-2024-003 - Penjualan customer (menggunakan harga jual)
            [
                'transaction_id' => 3,
                'product_id' => 1, // Laptop Asus
                'quantity' => 2,
                'unit_price' => 9500000, // selling_price
                'total_price' => 19000000,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],

            // TRX-2024-004 - Restock supplier (menggunakan harga beli)
            [
                'transaction_id' => 4,
                'product_id' => 4, // Beras Premium
                'quantity' => 200,
                'unit_price' => 10000, // cost_price
                'total_price' => 2000000,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'transaction_id' => 4,
                'product_id' => 5, // Air Mineral
                'quantity' => 400,
                'unit_price' => 4000, // cost_price
                'total_price' => 1600000,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],

            // TRX-2024-005 - Transfer untuk display (menggunakan harga jual)
            [
                'transaction_id' => 5,
                'product_id' => 3, // Kaos Polos
                'quantity' => 80,
                'unit_price' => 50000, // selling_price
                'total_price' => 4000000,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'transaction_id' => 5,
                'product_id' => 6, // Pulpen Hitam
                'quantity' => 200,
                'unit_price' => 3000, // cost_price
                'total_price' => 600000,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],

            // TRX-2024-006 - Penjualan grosir (menggunakan harga custom)
            [
                'transaction_id' => 6,
                'product_id' => 3, // Kaos Polos
                'quantity' => 50,
                'unit_price' => 45000, // harga grosir
                'total_price' => 2250000,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],

            // TRX-2024-007 - Pembelian stok baru (menggunakan harga beli)
            [
                'transaction_id' => 7,
                'product_id' => 1, // Laptop Asus
                'quantity' => 10,
                'unit_price' => 8500000, // cost_price
                'total_price' => 85000000,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'transaction_id' => 7,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 25,
                'unit_price' => 120000, // cost_price
                'total_price' => 3000000,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],

            // TRX-2024-008 - Penjualan retail (menggunakan harga jual)
            [
                'transaction_id' => 8,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 1,
                'unit_price' => 150000, // selling_price
                'total_price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Update Location Stock berdasarkan transaksi
        $this->updateLocationStock();
    }

    private function updateLocationStock()
    {
        // Reset semua stok terlebih dahulu
        DB::connection('location')->table('location_stocks')->truncate();

        // Stok awal berdasarkan transaksi
        $stockData = [
            // Gudang Utama (ID: 1)
            ['location_id' => 1, 'product_id' => 1, 'quantity' => 25], // Laptop Asus: 30-15+10 = 25
            ['location_id' => 1, 'product_id' => 2, 'quantity' => 75], // Mouse: 100-50+25 = 75
            ['location_id' => 1, 'product_id' => 3, 'quantity' => 120], // Kaos: 200-80 = 120
            ['location_id' => 1, 'product_id' => 4, 'quantity' => 0], // Beras: 0
            ['location_id' => 1, 'product_id' => 5, 'quantity' => 0], // Air Mineral: 0
            ['location_id' => 1, 'product_id' => 6, 'quantity' => 0], // Pulpen: 0

            // Gudang Cabang 1 (ID: 2)
            ['location_id' => 2, 'product_id' => 1, 'quantity' => 15], // Laptop Asus: 15
            ['location_id' => 2, 'product_id' => 2, 'quantity' => 50], // Mouse: 50
            ['location_id' => 2, 'product_id' => 3, 'quantity' => 0], // Kaos: 0 (sudah terjual)
            ['location_id' => 2, 'product_id' => 4, 'quantity' => 0], // Beras: 0
            ['location_id' => 2, 'product_id' => 5, 'quantity' => 0], // Air Mineral: 0
            ['location_id' => 2, 'product_id' => 6, 'quantity' => 0], // Pulpen: 0

            // Gudang Cabang 2 (ID: 3)
            ['location_id' => 3, 'product_id' => 1, 'quantity' => 0], // Laptop Asus: 0
            ['location_id' => 3, 'product_id' => 2, 'quantity' => 0], // Mouse: 0
            ['location_id' => 3, 'product_id' => 3, 'quantity' => 0], // Kaos: 0
            ['location_id' => 3, 'product_id' => 4, 'quantity' => 200], // Beras: 200
            ['location_id' => 3, 'product_id' => 5, 'quantity' => 400], // Air Mineral: 400
            ['location_id' => 3, 'product_id' => 6, 'quantity' => 0], // Pulpen: 0

            // Showroom Jakarta (ID: 4)
            ['location_id' => 4, 'product_id' => 1, 'quantity' => 0], // Laptop Asus: 0 (sudah terjual)
            ['location_id' => 4, 'product_id' => 2, 'quantity' => 0], // Mouse: 0 (sudah terjual)
            ['location_id' => 4, 'product_id' => 3, 'quantity' => 0], // Kaos: 0
            ['location_id' => 4, 'product_id' => 4, 'quantity' => 0], // Beras: 0
            ['location_id' => 4, 'product_id' => 5, 'quantity' => 0], // Air Mineral: 0
            ['location_id' => 4, 'product_id' => 6, 'quantity' => 0], // Pulpen: 0

            // Showroom Bandung (ID: 5)
            ['location_id' => 5, 'product_id' => 1, 'quantity' => 0], // Laptop Asus: 0
            ['location_id' => 5, 'product_id' => 2, 'quantity' => 0], // Mouse: 0
            ['location_id' => 5, 'product_id' => 3, 'quantity' => 80], // Kaos: 80
            ['location_id' => 5, 'product_id' => 4, 'quantity' => 0], // Beras: 0
            ['location_id' => 5, 'product_id' => 5, 'quantity' => 0], // Air Mineral: 0
            ['location_id' => 5, 'product_id' => 6, 'quantity' => 200], // Pulpen: 200
        ];

        foreach ($stockData as $stock) {
            if ($stock['quantity'] > 0) {
                DB::connection('location')->table('location_stocks')->insert([
                    'location_id' => $stock['location_id'],
                    'product_id' => $stock['product_id'],
                    'quantity' => $stock['quantity'],
                    'last_updated' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
