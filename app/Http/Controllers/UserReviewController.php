<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserReviewController extends Controller
{
    public function adminReview(){
       $reviews = Review::with('product')->get();
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

        
        if($validator->passes()){
            $validatedData = $validator->validated();
            $validatedData['user_id'] = auth()->id();
            // dd($validatedData);
            $product = Product::find($request->product_id);
            $product->reviews()->create($validatedData);
            // $review = Review::create($validatedData);
            flash()->addSuccess('Review added please wait for review approval');
            return redirect()->route('account.profile');
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
