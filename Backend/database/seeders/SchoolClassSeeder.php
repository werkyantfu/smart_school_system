<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Insert classes with the correct columns (name, section, room_number)
        $classes = [
            ['name' => 'KG 1', 'section' => 'A', 'room_number' => '101'],
            ['name' => 'KG 2', 'section' => 'A', 'room_number' => '102'],
            ['name' => 'KG 3', 'section' => 'A', 'room_number' => '103'],
            ['name' => 'Grade 1', 'section' => 'A', 'room_number' => '201'],
            ['name' => 'Grade 2', 'section' => 'A', 'room_number' => '202'],
            ['name' => 'Grade 3', 'section' => 'A', 'room_number' => '203'],
            ['name' => 'Grade 4', 'section' => 'A', 'room_number' => '204'],
            ['name' => 'Grade 5', 'section' => 'A', 'room_number' => '205'],
            ['name' => 'Grade 6', 'section' => 'A', 'room_number' => '301'],
            ['name' => 'Grade 7', 'section' => 'A', 'room_number' => '302'],
            ['name' => 'Grade 8', 'section' => 'A', 'room_number' => '303'],
            ['name' => 'Grade 9', 'section' => 'A', 'room_number' => '401'],
            ['name' => 'Grade 10', 'section' => 'A', 'room_number' => '402'],
            ['name' => 'Grade 11', 'section' => 'A', 'room_number' => '501'],
            ['name' => 'Grade 12', 'section' => 'A', 'room_number' => '502'],
        ];

        foreach ($classes as $class) {
            SchoolClass::create($class);
        }
    }
}