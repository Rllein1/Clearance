<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student_stat;
use App\Models\Clearance;
use App\Models\Assignatory;
use DataTables;

class StaffController extends Controller
{

    public function remark($id){
        $datas=Requirement::where('clearance_id',$id)->get();
        foreach($datas as $data){
            if($data->employee_id==Auth::user()->employee->id){
                return response()->json($data);
            }
        }
        return 1;
    }

    public function viewclearance($id)
    {
        if ($request->ajax()) {
            $clearance = Clearance::find($id);
            $data=$clearance->requires;
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    //GETSTUDENT?????????????????????????????
    public function student(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = Student_stat::where([['signatory_id',Auth::user()->signatory->id],['clearance_id',$id]])->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($row){
                $student=Student::find($row->student_id);
                $name=$student->fname.' '.$student->lname;
                return $name;
            })
            ->addColumn('action', function($row){
                $actionBtn = "<a href='http://127.0.0.1:8000/updatestatus/$row->id' class='edit btn btn-success btn-sm'>Update Status</a>";
                return $actionBtn;
            })
            ->addColumn('status', function($row){
                if($row->status==0){
                    return "<p class='fw-bold text-danger'>Not Cleared</p>";
                }
                return "<p class='fw-bold text-success'>Clear</p>";                      
            })
            ->addColumn('select', function($row){

                return "<input type='checkbox' value='$row->id' name='checkbox[]' class='checkbox'></input>";
            })
            ->rawColumns(['select','name','action','status'])
            ->make(true);
        }
    }
    
}
