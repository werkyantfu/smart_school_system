<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id_number',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'class_id',
        'guardian_phone',
        'status',
    ];
    // Relationship: A student belongs to a class
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

}
