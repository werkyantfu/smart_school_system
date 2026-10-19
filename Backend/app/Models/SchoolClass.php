<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'level',
    ];
    // students relationship
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // 1 class has many subjects
    
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}
