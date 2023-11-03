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
    //    $reviews = Review::with('product')->get();
                  $reviews =    Review::get();
                //   $role = Role::find();
       return view("admin.review.list",compact("reviews"));
    }

    public function approve(Request $request, $reviewId)
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


    public function create($productId){
            $product = Product::with('orders')->find($productId);
            return view('front.review.create',compact('product'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'rating' => 'required',
            'review' => 'required|min:3',
            'product_id' => 'required',
            // 'user_id' => 'required',
        ]);
        // dd($request->all());

        
        if($validator->passes()){
            $validatedData = $validator->validated();
            // dd($validatedData);
            
            $reviewableType = 'App\\Models\\' . auth()->user()->role;
            $validatedData['reviewable_id'] = auth()->id();
            $validatedData['reviewable_type'] = $reviewableType;
            $review = Review::create($validatedData);
            flash()->addSuccess('Successfully review added');
            return redirect()->route('admin.reviews');
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
