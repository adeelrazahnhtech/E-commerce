<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(){
        $cartcontents = Cart::getContent();
        return view('front.cart',compact('cartcontents'));
    }
    public function create(Request $request, Product $product)
    {
    
        try {
            Cart::add([
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => 1,
            ]);

            flash()->addSuccess('Successfully added the product to your cart ');
            return redirect()->route('account.profile');
        } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
            return redirect()->route('account.profile');
        }
    }

    public function update(Request $request,$item){
        $item = Cart::get($item); 
        if($item === null){
            flash()->addError('Item not found');
            return redirect()->route('front.cart');
        }
        // dd($item);
        
        try {
            Cart::remove($item->id);
            Cart::add([
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $request->quantity,
            ]);
        
            flash()->addSuccess('Successfully updated the product in your cart');
            return redirect()->route('front.cart');
        } catch (\Throwable $th) {
            flash()->addError($th->getMessage());
            return redirect()->route('front.cart');
        }

    }


    public function destroy(Request $request, $item){

        if($item === null){
            flash()->addError('Item not found');
            return redirect()->route('front.cart');
        }

        Cart::remove($item);
        flash()->addSuccess('Successfully deleted the item to your cart');
        return  redirect()->route('front.cart');
    }
}
