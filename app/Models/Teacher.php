<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'standerd_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    public function standerd()
    {
        return $this->belongsTo(Standerd::class,'standerd_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
}
