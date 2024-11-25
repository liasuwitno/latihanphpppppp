<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $now = now();
            DB::table('categories')->insert([
                'name' => 'Snacks',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('categories')->insert([
                'name' => 'Desserts',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('categories')->insert([
                'name' => 'Minuman',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('categories')->insert([
                'name' => 'Buah',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
