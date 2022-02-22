<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Signatory;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;


class SignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.signatory');
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
        $user->role='signatory';
        $user->username=$req->username;
        $user->password=Hash::make($user->username);
        $user->save();

        $signatory=New Signatory;
        $signatory->user_id=$user->id;
        $signatory->signatory_name=$req->signatory_name;
        $signatory->save();
        Toastr::success('Signatory has been added','Success');
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
        $signatory=Signatory::find($id);
        $signatory->password=Hash::make($signatory->username);
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
        $signatory=Signatory::find($id);
        $signatory->delete();
        Toastr::success('Signatory has been deleted','Success');
        return redirect()->back();
    }

    public function getsignatory(Request $request)
    {
        if ($request->ajax()) {
            $data = Signatory::latest()->get();
            return Datatables::of($data)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#"><i class="fa fa-edit "></i></a>';
                    $actionBtn .= '<a href="'.route('signatory.delete',$row->id).'"><i class="fas fa-trash-alt" style="margin:10px;color:red;"></i></a>';
                    $actionBtn .= '<a href="'.route('signatory.update',$row->id).'"><i class="fas fa-undo"></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    } 

}
