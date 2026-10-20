<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // create an admin user
        User::create([
            'name' => 'Werkyantfu',
            'email' => 'werkyantfutewachew@gmail.com',
            'password' => Hash::make('werke@1993#'), // የመግቢያ ቃል
            'role' => 'admin',
        ]);
    }
}