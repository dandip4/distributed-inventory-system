<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run()
    {
        // Seed Locations
        DB::connection('location')->table('locations')->insert([
            [
                'location_name' => 'Gudang Utama',
                'address' => 'Jl. Industri No. 123',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Gudang Cabang 1',
                'address' => 'Jl. Raya Surabaya No. 456',
                'city' => 'Surabaya',
                'country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Gudang Cabang 2',
                'address' => 'Jl. Medan Merdeka No. 789',
                'city' => 'Medan',
                'country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Showroom Jakarta',
                'address' => 'Jl. Sudirman No. 321',
                'city' => 'Jakarta',
                'country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Showroom Bandung',
                'address' => 'Jl. Asia Afrika No. 654',
                'city' => 'Bandung',
                'country' => 'Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Location Stocks
        DB::connection('location')->table('location_stocks')->insert([
            // Gudang Utama
            [
                'location_id' => 1,
                'product_id' => 1, // Laptop Asus
                'quantity' => 25,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 1,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 75,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 1,
                'product_id' => 3, // Kaos Polos
                'quantity' => 150,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 1,
                'product_id' => 4, // Beras Premium
                'quantity' => 300,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 1,
                'product_id' => 5, // Air Mineral
                'quantity' => 600,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 1,
                'product_id' => 6, // Pulpen Hitam
                'quantity' => 300,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Gudang Cabang 1
            [
                'location_id' => 2,
                'product_id' => 1, // Laptop Asus
                'quantity' => 15,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 2,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 50,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 2,
                'product_id' => 3, // Kaos Polos
                'quantity' => 100,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Gudang Cabang 2
            [
                'location_id' => 3,
                'product_id' => 1, // Laptop Asus
                'quantity' => 10,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 3,
                'product_id' => 4, // Beras Premium
                'quantity' => 200,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 3,
                'product_id' => 5, // Air Mineral
                'quantity' => 400,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Showroom Jakarta (stok menipis untuk testing)
            [
                'location_id' => 4,
                'product_id' => 1, // Laptop Asus
                'quantity' => 3, // Di bawah min_stock (5)
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 4,
                'product_id' => 2, // Mouse Wireless
                'quantity' => 8, // Di bawah min_stock (10)
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Showroom Bandung
            [
                'location_id' => 5,
                'product_id' => 3, // Kaos Polos
                'quantity' => 80,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_id' => 5,
                'product_id' => 6, // Pulpen Hitam
                'quantity' => 200,
                'last_updated' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
