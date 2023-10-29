<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerifiedMail;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Mail;

class SellerRegisterController extends Controller
{
    public function index(){

    }

    public function showForm(){
        $roles = Role::get()->where('id',2);
        return view('seller.register',compact('roles'));
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
         'name' => 'required|min:3',
         'email' => 'required|email|max:255|unique:users',
         'password' => 'required|min:5|confirmed',
         'role'      => 'required',
        ]);

        
        if($validator->passes()){
            $validatedData = $validator->validated();
            // $user = new User();
            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->password = Hash::make($request->password);
            // $user->save();

            $validatedData['token'] = uniqid();
            $user = User::create($validatedData);

        Mail::to($user->email)->send(new EmailVerifiedMail($user));

            return redirect()->route('seller.register')->with('success','Account register please wait for account approval');

        }else{
            return redirect()->route('seller.register')->withErrors($validator)->withInput($request->only(['email','name']));
        }
    }

    public function verify_email($tokken){
        
       $user = User::where('token', $tokken)->first();

       if($user){
        $user->update(['email_verified'=>1, 'token'=>'']);
        return redirect()->route('seller.login')->with('success','Email verification successfull. You can now log in.');

       }else{
       return redirect()->route('seller.register')->with('error','Email verification failed. Please try again');
       }
    }

    // auth('seller')->user()->products()->create($request->all());
}
