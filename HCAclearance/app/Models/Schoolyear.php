<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{
    use HasFactory;
    public function clearance()
    {
        return $this->hasMany(Clearance::class,'schoolyear_id','id');
    }
    protected $fillable = [
        'schoolyear',
        'status',
    ];
}
