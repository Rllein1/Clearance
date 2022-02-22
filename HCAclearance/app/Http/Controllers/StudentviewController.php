<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Clearance;
use App\Models\Student;
use App\Models\Schoolyear;
use App\Models\Student_stat;
use DataTables;


class StudentviewController extends Controller
{

    public function getclearance(Request $request)
    {
        $schoolyear=Schoolyear::where('status',1)->first();
        foreach($schoolyear->clearance as $clearance){
            if($clearance->status == 1 && $clearance->grade_level == Auth::user()->student->grade){
                return view('pages.student.myclearance')->with('clearance', $clearance);
            }
        }
    }

    public function requirements(Request $request)
    {
        if ($request->ajax()) {
            $stats = Student_stat::where('student_id',Auth::user()->student->id)->get();
            foreach($stats as $stat){
                if($stat->assignatory->from->status == 1){
                    $datas[]=Student_stat::find($stat->id);
                }
            }
            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $name = $row->signatory->signatory_name;
                    return $name;
                })
                ->addColumn('status', function($row){
                    if($row->status==0){
                        return "<p class='fw-bold text-danger'>Not Cleared</p>";
                    }
                    return "<p class='fw-bold text-success'>Clear</p>";
                })
                ->rawColumns(['name','status'])
                ->make(true);
        }
    }
}
