<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
     use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'score',
        'exam_type',
    ];
    //student relationship
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
}
//subject relationship
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
