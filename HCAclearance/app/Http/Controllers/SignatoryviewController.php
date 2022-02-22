<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Student_stat;
use App\Models\Clearance;
use App\Models\Assignatory;
use DataTables;

class SignatoryviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.staff.signatoryindex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
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
                $actionBtn = '<form action="http://127.0.0.1:8000/signatoryview/update/status"> <input type="checkbox" value="'.$row->id.'" name="checkbox[]" class="checkbox" style="display:none"checked><button type="submit">Update</button></form>';
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $student=Student_stat::find($id);
        if($student->assignatory->preference == 1){
            if($student->status== 0){
                $student->status=1;
                $student->save();
                return redirect()->back();
            }
            $student->status=0;
            $student->save();
            return redirect()->back();
        }
        else{
            $status=Student_stat::where("clearance_id",$student->clearance_id)->where("student_id",$student->student_id)->get();
            foreach($status as $stat){
                if( $stat->assignatory->preference < $student->assignatory->preference and $stat->status == 1){
                    if($student->status== 0){
                        $student->status=1;
                        $student->save();
                        return redirect()->back();
                    }
                    $student->status=0;
                    $student->save();
                    return redirect()->back();
                }else{
                }

            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getclearance(Request $request){
        if ($request->ajax()) {
            $datas = Clearance::where("status",1)->get();
            foreach($datas as $data){
                foreach($data->assignatories as $assignatory){
                    if($assignatory->signatory_id == Auth::user()->signatory->id){
                        $set[]=$assignatory->from;
                    }
                }
            }
            return Datatables::of($set)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $actionBtn = "<a href='javascript:void(0)' onclick='showstudent($row->id)' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>$row->name</a>";
                    return $actionBtn;
                })
                ->rawColumns(['name'])
                ->make(true);
        }
    }

    public function select(Request $req){
        foreach($req->checkbox as $checkbox){
            SignatoryviewController::update($checkbox);
        }
        return redirect()->back();
    }
}
