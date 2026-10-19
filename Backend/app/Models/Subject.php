<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
     use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'code',
        'teacher_id',
    ];

    // Relationship: A subject belongs to a class
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // Relationship: A subject may have a teacher (user)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    //marks relationship
    public function marks()
    {
        return $this->hasMany(Mark::class, 'subject_id');
    }
}
