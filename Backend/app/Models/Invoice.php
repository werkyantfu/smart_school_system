<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'term',
        'total_amount',
        'due_date',
        'status',
    ];
    //stdent relationship
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    //payments relationship

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
}
}