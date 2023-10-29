<?php

namespace App\Http\Controllers\subAdmin;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerifiedMail;
use App\Models\Role;
use App\Models\SubAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Mail;
use Illuminate\Support\Facades\Validator;

class SubAdminController extends Controller
{
    public function register(){
        $roles = Role::where('id',4)->get();
        return view('sub_admin.register',compact('roles'));
    }

    public function process(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|max:255|unique:sub_admins',
            'password' => 'required|min:5|confirmed',
            'role'      => 'required',
           ]);
   
           
           if($validator->passes()){
               $validatedData = $validator->validated();
               $validatedData['token'] = uniqid();
               $user = SubAdmin::create($validatedData);
   
           Mail::to($user->email)->send(new EmailVerifiedMail($user));
   
               return redirect()->route('sub_admin.register')->with('success','Account register please wait for account approval');
   
           }else{
               return redirect()->route('seller.register')->withErrors($validator)->withInput($request->only(['email','name']));
           }
    }

    public function login(){
        return view('sub_admin.login');
    }

    public function authenticate(Request $request){
       $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required',
       ]);

       if($validator->passes()){

    }else{
        return redirect()->route('login')->withErrors($validator)->withInput($request->only(['email']));
    }
}
