<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;




class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    // schoolseeder
    // 1=KG1, 2=KG2, 3=Grade1, 4=Grade2, 5=Grade3, 6=Grade4, 7=Grade5, 8=Grade6, 9=Grade7, 10=Grade8, 11=Grade9, 12=Grade10, 13=Grade11, 14=Grade12

    //=================================
    //Grade 1 - class_id = 4
    {
        Subject::create([
            'class_id' => 4,
            'name' => 'Mathematics',
            'code' => 'MATH101',
            
        ]);
        Subject::create([
            'class_id' => 4,
            'name' => 'English',
            'code' => 'ENG101',
            
        ]);
        Subject::create([
            'class_id' => 4,
            'name' => 'Amharic',
            'code' => 'AMH101',
            
        ]);
        subject::create([
            'class_id' => 4,
            'name' => 'Science',
            'code' => 'SCI101',
            
        ]);


        //grade 2 - class_id = 5
        Subject::create([
            'class_id' => 5,
            'name' => 'Mathematics',
            'code' => 'MATH201',
            
        ]);
        Subject::create([
            'class_id' => 5,
            'name' => 'English',
            'code' => 'ENG201',
        
        ]);
        Subject::create([
            'class_id' => 5,
            'name' => 'Amharic',
            'code' => 'AMH201',
            
        ]);
        Subject::create([
            'class_id' => 5,
            'name' => 'Science',
            'code' => 'SCI201',
            
        ]);
        
        //grade 9 - class_id = 12
        Subject::create([
            'class_id' => 12,
            'name' => 'Mathematics',
            'code' => 'MATH901',
            
        ]);
        Subject::create([
            'class_id' => 12,
            'name' => 'English',
            'code' => 'ENG901',
            
        ]);
        Subject::create([
            'class_id' => 12,
            'name' => 'Amharic',
            'code' => 'AMH901',
        ]);
        Subject::create([
            'class_id' => 12,
            'name' => 'Science',
            'code' => 'SCI901',
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'History',
            'code' => 'HIS901',
            
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Geography',
            'code' => 'GEO901',
            
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Physics',
            'code' => 'PHY901',
            
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Chemistry',
            'code' => 'CHE901',
            
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Biology',
            'code' => 'BIO901',
            
        ]);
        Subject::create([
            'class_id' => 12,
            'name' => 'Computer Science',
            'code' => 'CSC901',
            
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Physical Education',
            'code' => 'PE901',
        ]);
        subject::create([
            'class_id' => 12,
            'name' => 'Geography',
            'code' => 'EO901',
            
        ]);

    }
}
