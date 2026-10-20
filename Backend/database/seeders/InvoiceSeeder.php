<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'student_id' => 1,
            'term' => 'Term 1',
            'total_amount' => 5000.00,
            'due_date' => '2026-11-01',
            'status' => 'unpaid',
        ]);
    }
}
