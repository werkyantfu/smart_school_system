<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'user_id', 
        'employee_id', 
        'qualification', 
        'specialization', 
        'hire_date', 
        'salary'
    ];

    // Relationship: A Teacher belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}