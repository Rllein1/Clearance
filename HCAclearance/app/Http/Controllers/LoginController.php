<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function stafflogin(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->rank=='admin'){
                return redirect()->route('schoolyear.index');
            }
            elseif(Auth::user()->rank=='staff'){
                if(Auth::user()->role=='signatory'){
                    return redirect()->route('signatoryview.index');
                }else{
                    return redirect()->route('adviserview.index');
                }
            }else{
                return redirect()->route('getmyclearance');
            }
        }
        return back()->withErrors([
            '       Error: Invalid user         ',
        ]);
    }
}
