<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateSellerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerLoginController extends Controller
{
    public function loginForm(){
     return view('seller.login');
    }

    public function authenticate(AuthenticateSellerRequest $request){

        $validatedData = $request->validated();
        if(empty($validatedData)){
            return redirect()->route('seller.login')->withInput($request->only('email'));
        }
            if(Auth::guard('seller')->attempt(['email' => $request->email,'password' => $request->password],$request->get('remember'))){
                
                $user = Auth::guard('seller')->user();
                if($user->role == 2 && $user->email_verified == 1){
                    
                   
                    return redirect()->route('seller.dashboard');
                }else{
                    Auth::guard('seller')->logout();
                    return redirect()->route('seller.login')->with('error','You are not authorized to access the seller panel ');
                }

            }else{
              return redirect()->route('seller.login')->with('error','Error Email/Password is incorrect');
            }
    }
}
