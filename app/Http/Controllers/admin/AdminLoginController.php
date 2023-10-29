<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $request){
     $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
     ]);
     if($validator->passes()){

        if(auth('admin')->attempt(['email'=>$request->email,'password'=> $request->password],$request->get('remember'))){
           $admin = Auth::guard('admin')->user();   // here we got complete information of user
           if($admin->role == 1){
            return redirect()->route('admin.dashboard');
           }else{
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error','You are not authorized to access the admin panel');
           }
        }else{
            return redirect()->route('admin.login')->with('error','Invalid Email/Password is incorrect');
        }

     }else{
        return redirect()->route('admin.login')
                         ->withErrors($validator)
                         ->withInput($request->only('email'));
     }
    }
}
