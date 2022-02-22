<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adviser extends Model
{
    use HasFactory;
    public function advisory()
    {
        return $this->belongsTo(Classroom::class,"id", "adviser_id");
    }

    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }

}
