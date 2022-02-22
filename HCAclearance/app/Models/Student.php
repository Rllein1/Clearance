<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }
    public function student_stat()
    {
        return $this->hasMany(Student_stat::class,'student_id','id');
    }

    protected $fillable = [
        'user_id',
        'student_id',
        'fname',
        'lname',
        'grade',
        'classroom_id',
    ];
}
