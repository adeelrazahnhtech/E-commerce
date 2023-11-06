<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\Order;
use App\Models\orderProduct;
use App\Models\Package;
use App\Models\Product;
use App\Models\User;
use App\Models\UserPackage;
use Exception;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Mail;
use Cart;

class CheckoutController extends Controller
{
    public function createPackage(Request $request, Package $package)
    {
       
        $amount = $package->price;
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                    $checkout_session = $stripe->checkout->sessions->create([
                // 'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'USD',
                            'product_data' => [
                                'name' => 'Package',
                            ],
                            'unit_amount' => $amount * 100 ,
                        ],
                        'quantity' => 1,
                    ]],
                    'customer_email' => auth()->user()->email,
                
                'metadata' => [
                    'package' => $package->id,
                    'user' => auth()->user()->id,
                ],
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                
            ]);
          
            return redirect($checkout_session->url);
            // return response()->json(['id' => $session->url]);
           
        } catch (\Throwable $th) {
                    return response()->json(['status' => false, 'error' => $th->getMessage()]);
        }
       
    }

   


    public function storePackage(){

        $checkout_session_id = $_GET['session_id'];

        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $session = $stripe->checkout->sessions->retrieve($checkout_session_id);
            
            if(UserPackage::where('payment_id',$session->payment_intent)->exists()) 
            {
                flash()->addError('invalid request payment already exists on this session id');
                return redirect()->route('account.package');
            }
            UserPackage::create(['user_id' => $session->metadata->user, 'package_id'=>$session->metadata->package, 'payment_id' =>$session->payment_intent  ]);
            // User::find($session->metadata->user)->update(['expire_mail_sent'=>0]);
            // Mail::to(User::find($session->metadata->user)->email)->send(new PaymentMail);
            flash()->addSuccess('Thank you for subscribing to our platform :)');
            return redirect()->route('account.profile');
            // return redirect(env('COMPANY_PAYMENT_URL') . '/company/dashboard/success');
        } catch (Exception $e) {
            return redirect()->route('account.package')->with('error', $e->getMessage());
            
        }
        
        // return redirect(env('COMPANY_PAYMENT_URL').'?failed='.$e->getMessage());
    }

    public function cancelPackage(){
        return "cancel";
    }


    //payment
    public function createOrder(Order $request){
        $items = Cart::getContent();
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $line_items = [];

            foreach ($items as $key => $value) {
                $product = Product::find($value['id']);

                $line_items[] = [
                    
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                            'name' => $product->title,
                            'description' => $product->description,
                             ],
                            'unit_amount' => $value['price'] * 100,
                        ],
                        'quantity' => $value['quantity'],
                    ];
                   
            }

            $checkout_session = $stripe->checkout->sessions->create([
                            'line_items' => $line_items,
                            'metadata' => ['items'=>json_encode($items)],
                            'customer_email' => auth()->user()->email,
                            'mode' => 'payment',
                            'success_url' => route('order.pay').'?session_id={CHECKOUT_SESSION_ID}',
                            'cancel_url' => route('order.cancel') . '/?cancel',
                        ]);
          
            return redirect($checkout_session->url);
           
        } catch (\Throwable $th) {
                    return response()->json(['status' => false, 'error' => $th->getMessage()]);
        }
    }

    public function storeOrder(){
        $order_session_id = $_GET['session_id'];

        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $session = $stripe->checkout->sessions->retrieve($order_session_id);
            if(Order::where('payment_id',$session->payment_intent)->exists()) 
            {
                flash()->addError('invalid request order already exists on this session id');
                return redirect()->route('account.package');
            }
            $order = Order::create(['user_id' => auth()->user()->id, 'payment_id' =>$session->payment_intent]);
            $cartItems  = Cart::getContent();
            foreach ($cartItems as $cartItem) {
               $product = Product::find($cartItem);
               $order->products()->attach($product,['quantity' => $cartItem->quantity]);
            }
            Cart::clear();
          
            flash()->addSuccess('Thank you for ordering to our product :)');
            return redirect()->route('account.profile');
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'error' => $th->getMessage()]);
        }

    }

    public function cancelOrder(){
        dd('cancel');

    }

}




    // function order(StoreOrderRequest $request)
    // {
    //     $validatedData = $request->validated();
    //     $validatedData['user']=auth()->id();
     
    //     try {
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //         $lineItems = [];

    //         foreach ($validatedData['cart'] as $key => $d) {
    //             $product = Product::with('media', 'offer.offer')->find($d['product']);
    //             $lineItems[] = [
    //                 'price_data' => [
    //                     'currency' => 'usd',
    //                     'product_data' => [
    //                         'name' => $product->title .=$product->is_discounted?' (Discount: '.$product->discount_percent.'%)':'',
    //                         'description' => $product->description,
    //                     ],
    //                     'unit_amount' => round($product->discounted_amount,2) * 100,
    //                 ],
    //                 'quantity' => $d['quantity'],
    //             ];
    //         }
    //         $checkout_session = $stripe->checkout->sessions->create([
    //             'line_items' => $lineItems,
    //             'metadata' => ['items'=>json_encode($validatedData)],
    //             'customer_email' => auth()->user()->email,
    //             'mode' => 'payment',
    //             'success_url' => route('order.pay').'?session_id={CHECKOUT_SESSION_ID}',
    //             'cancel_url' => env('WEEDOWL_PAYMENT_URL') . '/?cancel',
    //         ]);
    //         return response()->json(['status' => true, 'response' => 'Record Created', 'data' => $checkout_session->url]);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status' => false, 'error' => $th->getMessage()]);
    //     }
    // }


// PLAN MANAGEMENT
    // public function create(Plan $plan)
    // {
    //     // TRAIL SUBSCRIPTION
    //     $existingPlans = auth()->user()->plans;
    //     if($existingPlans->isEmpty())
    //     {
    //         try {
    //             auth()->user()->plans()->create(['plan_id'=>1, 'payment_id'=>'Trial Plan']);
    //             // return redirect(env('COMPANY_PAYMENT_URL') . '/company/dashboard/success');
    //             return response()->json(['status'=>true, 'response'=>'Trail Plan Subscribed']);
    //         } catch (\Throwable $th) {
    //             return response()->json(['status'=>false, 'error'=>$th->getMessage()]);
                
    //         }
    //     }

    //     $amount = $plan->price;
    //     try {
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //         $checkout_session = $stripe->checkout->sessions->create([
    //             'line_items' => [[
    //                 'price_data' => [
    //                     'currency' => 'usd',
    //                     'product_data' => [
    //                         'name' => 'Prochub',
    //                     ],
    //                     'unit_amount' =>  $amount * 100,
    //                 ],
    //                 'quantity' => 1,
    //             ]],
    //             'metadata' => [
    //                 'plan' => $plan->id,
    //                 'company' => auth()->id(),
    //             ],
    //             'customer_email' => auth()->user()->email,
    //             'mode' => 'payment',
    //             'success_url' => route('companies.plan.subscribe') . '?session_id={CHECKOUT_SESSION_ID}',
    //             'cancel_url' => env('COMPANY_PAYMENT_URL').'?cancel',
    
    //         ]);
    //         return response()->json(['status' => true, 'response' => 'Record Created', 'data' => $checkout_session->url]);
    //     } catch (\Throwable $th) {
    //         return response()->json(['status' => false, 'error' => $th->getMessage()]);
    //     }
    // }

    // protected function planStore()
    // {
    //     $checkout_session_id = $_GET['session_id'];

    //     try {
    //         $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //         $session = $stripe->checkout->sessions->retrieve($checkout_session_id);
    //         if(CompanyPlan::where('payment_id',$session->payment_intent)->exists()) redirect(env('COMPANY_PAYMENT_URL').'?failed=invalid request payment already exists on this session id');
    //         CompanyPlan::create(['company_id'=>$session->metadata->company, 'plan_id'=>$session->metadata->plan, 'payment_id'=>$session->payment_intent]);
    //         Company::find($session->metadata->company)->update(['expire_mail_sent'=>0]);
    //         Mail::to(Company::find($session->metadata->company)->email)->send(new PaymentMail);
            
    //         return redirect(env('COMPANY_PAYMENT_URL') . '/company/dashboard/success');
    //     } catch (Exception $e) {
    //         return redirect(env('COMPANY_PAYMENT_URL').'?failed='.$e->getMessage());
    //     }
    // }
