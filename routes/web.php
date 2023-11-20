<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\seller\DashboardController;
// use App\Http\Controllers\seller\ProductSellerController;
use App\Http\Controllers\seller\SellerLoginController;
use App\Http\Controllers\seller\SellerRegisterController;
use App\Http\Controllers\subAdmin\SubAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPackageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//user account
Route::group(['prefix' => 'account'], function () {
    // this route is accessible without login
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/register', [AuthController::class, 'processRegister'])->name('account.process');

        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');

    });
    // this route is accessible after login
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', [UserController::class, 'logout'])->name('account.logout');


        Route::group(['middleware' => 'is_subscribed'], function () {
            Route::get('/profile', [UserController::class, 'index'])->name('account.profile');
        });
        Route::group(['middleware' => 'show_package'], function () {
            Route::get('/package', [UserPackageController::class, 'index'])->name('account.package'); 
        });
        Route::get('/product/{product}',[UserController::class,'singleProduct'])->name('product');
        //review
        Route::get('/user-review/{review}',[UserReviewController::class,'create'])->name('review');
        Route::post('/user-review',[UserReviewController::class,'store'])->name('review.process');
        
        //stripe-product
        Route::get('/packages', [UserPackageController::class, 'package'])->name('account.package.history'); 
        Route::get('/orders', [UserPackageController::class, 'order'])->name('front.order'); 
        Route::get('/products/{order}', [UserPackageController::class, 'viewProduct'])->name('order.product'); 

        
        //stripe-package
        Route::get('/checkout/{package}', [CheckoutController::class, 'createPackage'])->name('checkout');
        Route::get('/success', [CheckoutController::class, 'storePackage'])->name('checkout.success');
        Route::get('/cancel', [CheckoutController::class, 'cancelPackage'])->name('checkout.cancel');

        
        //paypal payment
        // Route::get('handle-payment', [PaypalPaymentController::class, 'handlePayment'])->name('make.payment');
        // Route::get('success-payment', [PaypalPaymentController::class, 'paymentSuccess'])->name('success.payment');
        // Route::get('cancel-payment', [PaypalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
        //cart
        Route::get('/cart-checkout', [CheckoutController::class, 'createOrder'])->name('cart.checkout');
        Route::get('/store-checkout', [CheckoutController::class, 'storeOrder'])->name('order.pay');
        Route::get('/cart-cancel', [CheckoutController::class, 'cancelOrder'])->name('order.cancel');

        Route::get('/cart',[CartController::class,'index'])->name('front.cart');
        Route::post('/add-to-Cart/{product}',[CartController::class,'create'])->name('front.addToCart');
        Route::put('/update-item/{item}',[CartController::class,'update'])->name('front.updateItem');
        Route::delete('/delete-item/{item}',[CartController::class,'destroy'])->name('front.deleteItem');

    });
});

//admin 
Route::group(['prefix' => 'admin'], function () {

    //this route is accessible without login
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    //this route is accessible with login
    Route::group(['middleware' => 'admin.auth'], function () { // when admin have logged in
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        //category
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

        //product 
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');  //policies via middleware   
        // Route::get('/products/create', [ProductController::class, 'create'])->middleware(['can:isAdmin, App\Models\Product'])->name('products.create');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');

        //Package
        Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
        Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
        Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
        Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
        Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
        Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.delete');

        //reviews
        Route::get('/admin-review/{review}',[UserReviewController::class,'adminCreate'])->name('admin.give_review');
        Route::post('/admin-review',[UserReviewController::class,'store'])->name('admin.review.process');

        Route::get('/reviews', [UserReviewController::class, 'adminReview'])->name('admin.reviews');
        Route::get('/reviews/create', [UserReviewController::class, 'create'])->name('reviews.create');

        Route::get('/reviews-approved/{review}', [UserReviewController::class, 'approve'])->name('review.approved');
        Route::get('/reviews-disapproved/{review}', [UserReviewController::class, 'disapprove'])->name('review.disapproved');

        //seller permission
        Route::get('/sellers',[PermissionController::class, 'index'])->name('seller');
        Route::get('/sellers-approve/{seller}',[PermissionController::class, 'approve'])->name('seller.approved');
        Route::get('/sellers-disapprove/{seller}',[PermissionController::class, 'disapprove'])->name('seller.disapproved');
        
       Route::get('/sellers-permission/{seller}',[PermissionController::class, 'create'])->name('seller.permission');
       Route::post('/sellers-permission/{seller}',[PermissionController::class, 'store'])->name('permission.store');

        
    });


});


Route::group(['prefix' => 'sub_admin'],function(){
    route::group(['middleware' => 'sub_admin.guest'],function(){
         Route::get('/register',[SubAdminController::class,'register'])->name('sub_admin.register');
         Route::post('/register',[SubAdminController::class,'process'])->name('sub_admin.process');
        //  verify_email
        Route::get('/account-approved/{token}',[SubAdminController::class,'verify_email'])->name('sub_admin.verify_email');

         Route::get('/login',[SubAdminController::class,'login'])->name('sub_admin.login');
         Route::post('/login',[SubAdminController::class,'authenticate'])->name('sub_admin.authenticate');

    });

    Route::group(['middleware'=> 'sub_admin.auth'],function(){
        Route::get('/dashboard',[SubAdminController::class, 'dashboard'])->name('sub_admin.dashboard');
        Route::get('/logout',[SubAdminController::class, 'logout'])->name('sub_admin.logout');

        //product
        Route::get('/products', [ProductController::class, 'subAdminIndex'])->name('sub_admin.product.index');
        Route::get('/products/create',[ProductController::class,'subAdminCreate'])->name('sub_admin.product.create');
        Route::post('/products',[ProductController::class, 'store'])->name('sub_admin.products.store');

        //review
        
        Route::get('/sub-admin-review/{review}',[UserReviewController::class,'subAdminCreate'])->name('sub_admin.give_review');
        Route::post('/sub-admin-review',[UserReviewController::class,'store'])->name('sub_admin.review.process');
        
    });
});

//seller
Route::group(['prefix' => 'seller'], function () {
    // these routes is accessible without login
    Route::group(['middleware' => 'seller.guest'], function () {
        Route::get('/register', [SellerRegisterController::class, 'showForm'])->name('seller.register');
        Route::post('/register', [SellerRegisterController::class, 'register'])->name('register.process');
        Route::get('/verify-email/{token}', [SellerRegisterController::class, 'verify_email'])->name('verify_email');

        Route::get('/login', [SellerLoginController::class, 'loginForm'])->name('seller.login');
        Route::post('/login', [SellerLoginController::class, 'authenticate'])->name('seller.authenticate');
    });

    // these routes is accessible after login
    Route::group(['middleware' => 'seller.auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('seller.logout');

        //product
        Route::group(['middleware' => 'product.owner'], function () {
            Route::get('/products/{product}/edit', [ProductController::class, 'seller_edit'])->name('seller.products.edit');
        });
        Route::get('/products', [ProductController::class, 'sellerIndex'])->name('seller.products.index');
        Route::get('/products/create', [ProductController::class, 'sellerCreate'])->name('seller.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'seller_edit'])->name('seller.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.delete');

        //review   
        Route::get('/seller-review/{review}',[UserReviewController::class,'seller_create'])->name('seller.give_review');
        Route::post('/seller-review',[UserReviewController::class,'store'])->name('seller.review.process');





    });
});