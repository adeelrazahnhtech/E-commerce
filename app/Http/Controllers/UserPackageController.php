<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderProduct;
use App\Models\Package;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPackageController extends Controller
{
    public function index(){
        
        $packages = Package::all();
        return view('front.package.list',compact('packages'));
    }

    public function create(){
        return view('front.package.create');
    }

    public function package(){
      $package =  auth()->user()->packages->first();
      if($package){
          $createAt = $package->pivot->created_at;
          $today = Carbon::now();
          switch ($package->duration_unit){
            case 'weeks':
                $unit = 'addWeeks';
                break;
            case 'months':
                $unit = 'addMonths';
                break;
            case 'years':
                $unit = 'addYears';
                break;
          }
          $expire = $createAt->$unit($package->duration);
      }
      $remainingDays = $today->diffInDays($expire);
      return view('front.package',compact('package','expire','remainingDays'));
    }

    public function order(){
     $user =   auth()->user()->name;
     $orders = Order::with('products')->get();
     return view('front.order',compact('orders','user'));
    }
    
    public function viewProduct($orderId){
        $orders = Order::with('products')->find($orderId);
        $products = $orders->products;
         return view('front.view-products',compact('products'));
    }
}
