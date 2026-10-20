<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // first student (male)
        Student::create([
            'student_id_number' => 'SMS-2026-0001',
            'first_name' => 'Abebe',
            'last_name' => 'Kebede',
            'dob' => '2015-05-10',
            'gender' => 'M',
            'class_id' => 4, // ማሳሰቢያ፡ 4 ማለት በ SchoolClassSeeder መሰረት Grade 1 ማለት ነው
            'guardian_phone' => '0911223344',
            'status' => 'active',
        ]);

        // second student (female)
        Student::create([
            'student_id_number' => 'SMS-2026-0002',
            'first_name' => 'Sara',
            'last_name' => 'Ahmed',
            'dob' => '2015-08-20',
            'gender' => 'F',
            'class_id' => 4, // Grade 1
            'guardian_phone' => '0922334455',
            'status' => 'active',
        ]);

        // third student (male)
        Student::create([
            'student_id_number' => 'SMS-2026-0003',
            'first_name' => 'Dawit',
            'last_name' => 'Tesfaye',
            'dob' => '2014-11-02',
            'gender' => 'M',
            'class_id' => 5, // Grade 2
            'guardian_phone' => '0933445566',
            'status' => 'active',
        ]);
    }
}