<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterSeeder extends Seeder
{
    public function run()
    {
        // Seed Categories
        DB::connection('master')->table('master_categories')->insert([
            [
                'category_name' => 'Elektronik',
                'description' => 'Produk-produk elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Pakaian',
                'description' => 'Produk-produk pakaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Makanan',
                'description' => 'Produk-produk makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Minuman',
                'description' => 'Produk-produk minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Alat Tulis',
                'description' => 'Produk-produk alat tulis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Units
        DB::connection('master')->table('master_units')->insert([
            [
                'unit_name' => 'Pieces',
                'unit_symbol' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Kilogram',
                'unit_symbol' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Liter',
                'unit_symbol' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Meter',
                'unit_symbol' => 'm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_name' => 'Box',
                'unit_symbol' => 'box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Products
        DB::connection('master')->table('master_products')->insert([
            [
                'product_code' => 'PRD001',
                'product_name' => 'Laptop Asus',
                'category_id' => 1,
                'unit_id' => 1,
                'cost_price' => 8500000,
                'selling_price' => 9000000,
                'min_stock' => 5,
                'max_stock' => 50,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PRD002',
                'product_name' => 'Mouse Wireless',
                'category_id' => 1,
                'unit_id' => 1,
                'cost_price' => 150000,
                'selling_price' => 180000,
                'min_stock' => 10,
                'max_stock' => 100,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PRD003',
                'product_name' => 'Kaos Polos',
                'category_id' => 2,
                'unit_id' => 1,
                'cost_price' => 50000,
                'selling_price' => 75000,
                'min_stock' => 20,
                'max_stock' => 200,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PRD004',
                'product_name' => 'Beras Premium',
                'category_id' => 3,
                'unit_id' => 2,
                'cost_price' => 12000,
                'selling_price' => 15000,
                'min_stock' => 50,
                'max_stock' => 500,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PRD005',
                'product_name' => 'Air Mineral',
                'category_id' => 4,
                'unit_id' => 3,
                'cost_price' => 5000,
                'selling_price' => 8000,
                'min_stock' => 100,
                'max_stock' => 1000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_code' => 'PRD006',
                'product_name' => 'Pulpen Hitam',
                'category_id' => 5,
                'unit_id' => 1,
                'cost_price' => 5000,
                'selling_price' => 8000,
                'min_stock' => 50,
                'max_stock' => 500,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Users
        DB::connection('master')->table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
