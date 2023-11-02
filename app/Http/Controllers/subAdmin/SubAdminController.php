<?php

namespace App\Http\Controllers\subAdmin;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerifiedMail;
use App\Models\Role;
use App\Models\SubAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mail;
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
               return redirect()->route('sub_admin.register')->withErrors($validator)->withInput($request->only(['email','name']));
           }
    }

    public function verify_email($token){
        $sub_admin = SubAdmin::where('token',$token)->first();

        if($sub_admin){
            $sub_admin->update(['email_verified' => 1,'token' => '']);
            flash()->addSuccess('Email verification successfully now you can log in');
            return redirect()->route('sub_admin.login');
        }else{
            flash()->addError('Email verification failed please try again');
            return redirect()->route('sub_admin.register');

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

        if(Auth::guard('sub_admin')->attempt(['email'=> $request->email, 'password' => $request->password],$request->get('remember'))){
           $user = auth()->guard('sub_admin')->user();
           
                if($user->role == 4 && $user->email_verified == 1){
                    return redirect()->route('sub_admin.dashboard');

                }else{
                    auth('sub_admin')->logout();
                    flash()->addErrors("you are not authorized to access the sub admin panel");
                    return redirect()->route('sub_admin.login');

                }
        }else{
            flash()->addError("Error: Invalid email/password");
            return redirect()->route('sub_admin.login');
        }

    }else{
        return redirect()->route('sub_admin.login')->withErrors($validator)->withInput($request->only(['email']));
    }


    }

    public function dashboard(){
        return view('sub_admin.dashboard');
    }

    public function logout(){
        auth()->guard('sub_admin')->logout();
        flash()->addSuccess("Successfully you are logged out");
        return redirect()->route('sub_admin.login');
    }

}
