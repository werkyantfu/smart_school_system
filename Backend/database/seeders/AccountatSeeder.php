<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountantSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Accountant Sara',
            'email' => 'accountant@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'accountant',
        ]);
    }
}