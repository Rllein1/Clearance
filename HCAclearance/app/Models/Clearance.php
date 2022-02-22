<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;
    public function assignatories()
    {
        return $this->hasMany(Assignatory::class,'clearance_id','id');
    }
}
