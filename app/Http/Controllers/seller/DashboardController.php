<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
       
        return view('seller.dashboard');
    }

    public function logout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login');
    }
}
