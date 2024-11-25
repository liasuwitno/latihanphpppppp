<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $now = now();
            DB::table('brands')->insert([
                'name' => 'Aqua',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('brands')->insert([
                'name' => 'Walls',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('brands')->insert([
                'name' => 'Nestle',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
