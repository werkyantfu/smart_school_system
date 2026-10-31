<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // ✅ Fields that can be mass-assigned
    protected $fillable = [
        'user_id', 
        'report_type', 
        'file_path', 
        'generated_at'
    ];

    // ✅ Relationship: A report belongs to the user who generated it
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}