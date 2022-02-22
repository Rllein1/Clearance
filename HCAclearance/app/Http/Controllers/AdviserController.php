<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Adviser;
use App\Models\User;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class AdviserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.adviser');
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
        $user->rank='staff';
        $user->role='adviser';
        $user->username=$req->username;
        $user->password=Hash::make($user->username);
        $user->save();

        $adviser=new Adviser;
        $adviser->user_id=$user->id;
        $adviser->fname=$req->fname;
        $adviser->lname=$req->lname;
        $adviser->save();
        Toastr::success('Adviser has been added','Success');
        // return response()->json($adviser);
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
        $adviser=Adviser::find($id);
        $adviser->password=Hash::make($adviser->username);
        Toastr::success('Password has been reset','Success');
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
        $adviser=Adviser::find($id);
        $adviser->delete();
        Toastr::success('Adviser has been deleted','Success');
        return redirect()->back();
        
    }

    public function getadviser(Request $request)
    {
        if ($request->ajax()) {
            $data = Adviser::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#"><i class="fa fa-edit "></i></a>';
                    $actionBtn .= '<a href="'.route('adviser.delete',$row->id).'"><i class="fas fa-trash-alt" style="margin:10px;color:red;"></i></a>';
                    $actionBtn .= '<a href="'.route('adviser.update',$row->id).'"><i class="fas fa-undo"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

}
