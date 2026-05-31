<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Akun Admin PLN Icon Plus Jambi
        User::create([
            'name' => 'Admin Icon Plus Jambi',
            'email' => 'admin@iconplus.co.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'avatar' => null,
        ]);

        // Buat Akun Manager PLN Icon Plus Jambi
        User::create([
            'name' => 'Manager Icon Plus Jambi',
            'email' => 'manager@iconplus.co.id',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'avatar' => null,
        ]);
    }
}