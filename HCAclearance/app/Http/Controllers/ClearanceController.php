<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Schoolyear;
use App\Models\Signatory;
use App\Models\Clearance;
use App\Models\Assignatory;
use App\Models\Prerequisite;
use App\Models\Student;
use App\Models\Student_stat;
use App\Models\User;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;


class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolyear = Schoolyear::where('status',1)->first();
        $clearances =Clearance::all();
        $signatories =Signatory::all();
        $count =Signatory::count();
        return view('pages/admin/clearance', compact('schoolyear','clearances','signatories','count'));
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
    public function store(Request $req)
    {
        $sy=Schoolyear::where('status',1)->first();
        $clearance=New Clearance;
        if($req->sem!=null){
            $clearance->name="GRADE".$req->gradelevel."clearance-(".$sy->schoolyear.'/'.$req->sem.'-sem)';
        }else{
            $clearance->name="GRADE".$req->gradelevel."clearance-(".$sy->schoolyear.')';
        }
        $existclearance=Clearance::where('name',$clearance->name)->first();
            if($existclearance != null){
                return back()->withErrors([
                    '       Error: Clearance Already Exist        ',
                ]);
            }
        $clearance->schoolyear_id=$sy->id;
        $clearance->grade_level=$req->gradelevel;
        $clearance->status=0;
        $clearance->save();



        foreach($req->checkbox as $signatory){
            $assignatory=New Assignatory;
            $assignatory->clearance_id=$clearance->id;
            $assignatory->signatory_id=$signatory;
            $name=$signatory."preference";
            $assignatory->preference=$req->$name;
            $assignatory->save();

            $students=Student::where('grade',$req->gradelevel)->get();

            foreach($students as $student){
                $status=New Student_stat;
                // $status->clearance_id=$clearance->id;
                $status->student_id=$student->id;
                $status->assignatory_id=$assignatory->id;
                $status->signatory_id=$signatory;
                $status->status=0;
                $status->save();
            }


        }
        Toastr::success('Clearance has been added','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $clearance = Clearance::find($id);
            $data=$clearance->assignatories;
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('name', function($row){
                    return $name=$row->signatory->signatory_name;
                })
                ->rawColumns(['name'])
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
    public function update(Request $request, $id)
    {
        $data=Clearance::find($id);
        if($data->grade_level =='jhs'){
            if($data->status == 0){
                $clearances=Clearance::where("grade_level",'jhs')->where("status",1)->get();
                foreach($clearances as $clearance){
                    $clearance->status=0;
                    $clearance->save();
                }
                $data->status=1;
                $data->save();
                return redirect()->back();
            }
            $data->status=0;
            $data->save();
            return redirect()->back();
        }else{
            if($data->status==0){
                $clearances=Clearance::where("grade_level",'shs')->where("status",1)->get();
                foreach($clearances as $clearance){
                    $clearance->status=0;
                    $clearance->save();
                }
                $data->status=1;
                $data->save();
                return redirect()->back();
            }
            $data->status=0;
            $data->save();
            return redirect()->back();
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
        $data = Clearance::find($id);
        foreach($data->assignatories as $assignatory){
            foreach($assignatory->students as $student){
                $student_stat=Student_stat::find($student->id);
                $student_stat->delete();
            }
            $assignatories=Assignatory::find($assignatory->id);
            $assignatories->delete();
        }
        $data->delete();
        Toastr::success('Adviser has been deleted','Success');
        return redirect()->back();
    }
    public function getclearance(Request $request)
    {
        if ($request->ajax()) {
            $data = Clearance::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('clearance.delete',$row->id).'" class="edit btn btn-danger btn-sm">DELETE</a>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        $statusBtn = '<a href="'.route('clearance.update',$row->id).'" class="edit btn btn-success btn-sm">Active</a>';
                        return $statusBtn;
                    }else{
                        $statusBtn = '<a href="'.route('clearance.update',$row->id).'" class="edit btn btn-danger btn-sm">Inactive</a>';
                        return $statusBtn;
                    }
                })
                ->addColumn('name', function($row){
                    $name = "<a href='#' onclick='clearance($row->id)' class='' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>$row->name</a>";
                    return $name;
                })
                ->rawColumns(['action','status','name'])
                ->make(true);
        }
    }

    public function assignatory()
    {
        $signatory = Signatory::all();
        return($signatory);
    }

    public function destroyassignatory($id)
    {
        $data = Assignatory::find($id);
        foreach($data->prerequisites as $prereq){
            foreach($data->students as $student){
                $student_stat=Student_stat::find($student->id);
                $student_stat->delete();
            }
            $prerequisite=Prerequisite::find($prereq->id);
            $prerequisite->delete();
        }
        $data->delete();
        Toastr::success('Signatory has been deleted','Success');
        return redirect()->back();
    }

}
