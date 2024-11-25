<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('users')->insert([
        'username' => 'Lia Suwitno',
        'email' => 'suwitnolia2@gmail.com',
        'password' => Hash::make('liasuwitno123'),
        'created_at' => $now,
        'updated_at' => $now,
        ]);
    }
}
