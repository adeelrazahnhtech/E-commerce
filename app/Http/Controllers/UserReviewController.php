<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserReviewController extends Controller
{
    public function adminReview(){
        $reviews = Review::with('reviewable.user_role','product')->orderByDesc('rating')->get();
       return view("admin.review.list",compact("reviews"));
    }

    public function approve($reviewId)
    {
        $review = Review::find($reviewId);
        
        if ($review) {
            $review->update(['status' => 1]);
            flash()->addSuccess('Review has been approved.');
        } else {
            flash()->error('Review not found.');
        }
    
        return redirect()->back();
    }

    public function disapprove(Request $request, $reviewId)
    {
        $review = Review::find($reviewId);
        
        if ($review) {
            $review->update(['status' => 0]);
            flash()->addSuccess('Review has been disapproved.');
        } else {
            flash()->error('Review not found.');
        }
    
        return redirect()->back();
    }

    public function admin_create($productId){
        $product = Product::find($productId);
            return view('admin.review.create',compact('product'));

    }

    public function seller_create($productId){
      $product =  Product::find($productId);
      return view('seller.review.create',compact('product'));

    }

    
    public function subAdminCreate($productId){
        $product =  Product::find($productId);
        return view('sub_admin.review.create',compact('product'));
  
      }


    public function create($productId){
            $product = Product::with('orders')->find($productId);
            return view('front.review.create',compact('product'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'rating' => 'required',
            'review' => 'required|min:3',
            'product_id' => 'required',
        ]);


        if($validator->passes()){
            $validatedData = $validator->validated();

            if (auth('admin')->check())
            {
                $user = auth('admin')->user();
                
            }elseif (auth('sub_admin')->check()) 
            {
                $user = auth('sub_admin')->user();
                
            }elseif (auth('seller')->check()){
                $user = auth('seller')->user();
            }else
            {
                $user = auth()->user();
            }

            $user->reviews()->create($validatedData);

            flash()->addSuccess('Successfully review added');

            if(auth('admin')->check()){
            return redirect()->route('products.index');
            }elseif (auth('sub_admin')->check()){
            return redirect()->route('sub_admin.product.index');
            }elseif (auth('seller')->check()){
            return redirect()->route('seller.products.index');
            }else{
                return redirect()->route('account.profile');
            }
          
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
