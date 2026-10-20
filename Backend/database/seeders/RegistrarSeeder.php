<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Registrar Almaz',
            'email' => 'registrar@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'registrar',
        ]);
    }
}
