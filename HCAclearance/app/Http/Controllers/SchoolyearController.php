<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolyear;
use DataTables;

class SchoolyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolyears=Schoolyear::all();
        return view('pages.admin.schoolyear')->with('schoolyears',$schoolyears);
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
        $schoolyear=New Schoolyear;
        $schoolyear->schoolyear=$req->schoolyear;
        $schoolyear->status=1;

        $existSY = Schoolyear::where('schoolyear',$req->schoolyear)->first();
        
            if($existSY== null){
                $schoolyear->save();
                return response()->json($schoolyear, 201);
            }
            return back()->withErrors([
                '       Error: Schoolyear Already Exist         ',
            ]);
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return('asdasdadsa');
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
        $data=Schoolyear::find($id);
        if($data->status==0){
            $sys=Schoolyear::where('status',1)->get();
            foreach($sys as $sy){
                $sy->status=0;
                $sy->save();
            }
            $data->status=1;
            $data->save();
            return redirect()->back();
        }
        $data->status=0;
        $data->save();
        Toastr::success('Schoolyear has been updated','Success');
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
        $data = Schoolyear::find($id);
        $data->delete();
        Toastr::success('Schoolyear has been deleted','Success');
        return redirect()->back();
    }

    public function get(Request $request)
    {

        if ($request->ajax()) {
            $data = Schoolyear::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $actionBtn = '<a href="'.route('schoolyear.delete',$row->id).'" class="edit btn btn-danger btn-sm">DELETE</a>';
                        return $actionBtn;
                })
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        $statusBtn = '<a href="'.route('schoolyear.update',$row->id).'" class="edit btn btn-success btn-sm">Active</a>';
                        return $statusBtn;
                    }else{
                        $statusBtn = '<a href="'.route('schoolyear.update',$row->id).'" class="edit btn btn-danger btn-sm">Inactive</a>';
                        return $statusBtn;
                    }
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
    }
}
