<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignatory extends Model
{
    use HasFactory;
    public function from()
    {
        return $this->belongsTo(Clearance::class,"clearance_id",'id');
    }
    public function signatory()
    {
        return $this->belongsTo(Signatory::class,"signatory_id",'id');
    }
    public function students()
    {
        return $this->hasMany(Student_stat::class,"assignatory_id","id");
    }
    public function prerequisites()
    {
        return $this->hasMany(Prerequisite::class,"assignatory_id","id");
    }
}
