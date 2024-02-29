<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','parent_id','standerd_id'];

    public function standerd()
    {
        return $this->belongsTo(Standerd::class,'standerd_id');
    }
    public function parent()
    {
        return $this->belongsTo(StudentParent::class,'parent_id');
    }
}
