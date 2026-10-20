<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mark;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mark::create([
            'student_id' => 1,
            'subject_id' => 1,
            'score' => 85.5,
            'exam_type' => 'midterm',
        ]);
    }
}
