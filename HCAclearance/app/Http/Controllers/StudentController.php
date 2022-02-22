<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Student_stat;
use App\Models\User;
use App\Models\Classroom;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.student');
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
        $user=New User;
        $user->rank='student';
        $user->role='student';
        $user->username=$req->student_id;
        $user->password=Hash::make($req->student_id);
        $user->save();

        $student=New Student;
        $student->user_id=$user->id;
        $student->student_id=$req->student_id;
        $student->fname=$req->fname;
        $student->lname=$req->lname;
        $student->grade=$req->gradelevel;
        $student->classroom_id=$req->class;
        $student->save();

        Toastr::success('Student has been added','Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $student=Student::find($id);
        $student->password=Hash::make($student->username);
        Toastr::success('Password has been added','Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data =Student::find($id);
        foreach($data->student_stat as $stat){
            $student_stat=Student_stat::find($stat->id);
            $student_stat->delete();
        }
        $user=User::find($data->user->id);
        $user->delete();
        $data->delete();
        Toastr::success('Student has been deleted','Success');
        return redirect()->back();
    }

    public function getstudent(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#"><i class="fa fa-edit "></i></a>';
                    $actionBtn .= '<a href="'.route('student.delete',$row->id).'"><i class="fas fa-trash-alt" style="margin:10px;color:red;"></i></a>';
                    $actionBtn .= '<a href="'.route('student.update',$row->id).'"><i class="fas fa-undo"></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function classroom(Request $req)
    {
        $classes = Classroom::where("grade_level",$req->grade)->get();
        return($classes);
    }

}
