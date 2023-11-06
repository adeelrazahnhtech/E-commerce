<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
      $products = Product::with('reviews')->get();
        return view ('front.profile',compact('products'));
    }

    public function singleProduct($productId){
      $product = Product::with('orders')->with('reviews')->findOrFail($productId);
      // dd($product);
      // dd($product);
      // dd(auth()->user()->order);
      // dd(auth()->user()->review);
      //  && !auth()->user()->review
      return view ('front.single-product',compact('product'));
    }

 

  

    public function logout(){
      Auth::guard('web')->logout();
      return redirect()->route('account.login');
    }
}
