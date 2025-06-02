<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('login')->insert([
            'username' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
        ]);
    }
}
