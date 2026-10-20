<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // call the individual seeders to populate the database with initial data
        $this->call([
              // 1. Users 
            AdminUserSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            ParentSeeder::class,
            AccountantSeeder::class,
            RegistrarSeeder::class,
            
            // 2. Classes & Subjects 
            SchoolClassSeeder::class,
            SubjectSeeder::class,
            
            // 3. Students
            StudentSeeder::class,
            
            // 4. Finance
            InvoiceSeeder::class,
            PaymentSeeder::class,
            
            // 5. LMS
            MarkSeeder::class,
            AttendanceSeeder::class,
            ]);
             }
}