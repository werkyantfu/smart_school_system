<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass; 

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // KG 1 - 3
        SchoolClass::create(['name' => 'KG 1', 'level' => 0]);
        SchoolClass::create(['name' => 'KG 2', 'level' => 0]);
        SchoolClass::create(['name' => 'KG 3', 'level' => 0]);
       
        // Grade 1 - 12
        for ($i = 1; $i <= 12; $i++) {
            SchoolClass::create([
                'name' => "Grade $i",
                'level' => $i,]);
    }
    }
}