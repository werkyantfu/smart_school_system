<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'invoice_id', 
        'amount', 
        'payment_method', 
        'payment_date'
    ];

    // A payment belongs to a student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // A payment belongs to an invoice (optional)
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}