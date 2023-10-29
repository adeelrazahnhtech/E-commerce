<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerifiedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Mail;

class AuthController extends Controller
{
   public function register(){
    $roles = Role::get()->where('id',3);
    return view('front.register',compact('roles'));
   } 

   public function processRegister(Request $request){
    $validator = Validator::make($request->all(),[
      'name' => 'required:min',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:3|confirmed',
      'role' => 'required',
    ]);

    $validatedData = $validator->validated();
    if($validator->passes()){
        $validatedData['token'] = uniqid();  
        $user = User::create($validatedData);
        Mail::to($user->email)->send(new EmailVerifiedMail($user));
        return redirect()->route('account.register')->with('success','Account register Please wait for account approval');
    }else{
        return redirect()->route('account.register')->withErrors($validator)->withInput($request->only(['email','name']));
    }
   }

   public function login(){
    return view('front.login');
   }

   public function authenticate(Request $request){
    $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if($validator->passes()){
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password],$request->get('remember'))){
          $user = auth()->user();
          if($user->role == 3 && $user->email_verified == 1){
            return redirect()->route('account.profile');

          }else{
            auth()->logout();
            return redirect()->route('account.login')->with('error','You are not authorized to access the user panel');
          }

        }else{
            return redirect()->route('account.login')->with('error','Invalid Email/password is incorrect');
        }
    }else{
        return redirect()->route('account.login')->withErrors($validator);

    }

   }
}
