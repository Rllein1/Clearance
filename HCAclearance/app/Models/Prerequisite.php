<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    use HasFactory;
    public function from_signatory()
    {
        return $this->hasOne(Signatory::class,"id","signatory_id");
    }
}
