<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // የመጀመሪያው Admin User መፍጠር
        User::create([
            'name' => 'Werkyantfu',
            'email' => 'admin@smartsms.com',
            'password' => Hash::make('password123'), // የመግቢያ ቃል
            'role' => 'admin',
        ]);
    }
}