<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Parent',
            'email' => 'parent@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'parent',
        ]);
    }
}
