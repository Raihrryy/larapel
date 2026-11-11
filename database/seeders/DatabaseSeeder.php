<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function open(): void
    {
        // Data Dummy Customer
        Customer::create([
            'nama' => 'Raihan Azka Azxia',
            'email' => 'raihan@example.com',
            'password' => Hash::make('password123')
        ]);

        Customer::create([
            'nama' => 'Siti Aisyah',
            'email' => 'aisyah@example.com',
            'password' => Hash::make('password123')
        ]);
    }
}