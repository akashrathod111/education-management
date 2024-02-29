<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description','student_id','teacher_id','user_type'];

    protected $casts = [
        'student_id' => 'array',
        'teacher_id' => 'array',
    ];
}
