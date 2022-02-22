<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Schoolyear;
use App\Models\User;
use App\Models\Student_stat;
use App\Models\Clearance;
use Illuminate\Support\Facades\Auth;

class test extends Controller
{
    public function get(Request $request)
    {
        $student=Student_stat::find(38);
        $status=Student_stat::where("clearance_id",$student->clearance_id)->where("student_id",$student->student_id)->get();
        foreach($status as $stat){
            if( $stat->assignatory->preference < $student->assignatory->preference and $stat->status == 1){
                echo('wew');
            }else{
                echo($stat->status );
            }

        }
    }  

    public function store(Request $request)
    {
        request()->validate([
            'schoolyear' => 'required',
            'status' => 'required'
        ]);

        return Schoolyear::create([
            'schoolyear' => request('schoolyear'),
            'status' => request('status')
        ]);
    }  
}
