<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    { {
            $now = now();
            DB::table('products')->insert([
                'name' => 'Susu Real Good',
                'price' => 5000,
                'stock' => 50,
                'brand_id' => 1,
                'category_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('products')->insert([
                'name' => 'Chitato',
                'price' => 5500,
                'stock' => 30,
                'brand_id' => 3,
                'category_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('products')->insert([
                'name' => 'Ayam Rica-rica',
                'price' => 15000,
                'stock' => 30,
                'brand_id' => 1,
                'category_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
