<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Payment::create([
            'invoice_id' => 1,
            'amount' => 5000.00,
            'method' => 'telebirr',
            'payment_date' => '2026-10-20',
            'receipt_number' => 'RCP-12345',
        ]);
    }
}
