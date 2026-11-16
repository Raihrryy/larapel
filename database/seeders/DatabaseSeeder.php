<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Administrator',
                'password' => 'admin123',
            ]
        );
    }
}