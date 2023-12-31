<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreProductRequest;
use App\Models\Category;
use App\Models\SellerPermission;
use App\Models\User;
use App\Models\Product;
// use App\Models\SellerPermission; 
use App\Models\SubAdmin;
use App\Policies\ProductPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
  public function index()
  {
    $product = Product::with('category', 'seller', 'sub_admin')->orderByDesc('id')->get();
    $user = auth()->user();
    $data['products'] = $product;
    $data['user'] = $user;
    return view('admin.product.list', $data);

  }

  public function sellerIndex()
  {
    // $this->authorize('index', Product::class);
    // $products = Product::with('category', 'seller')->where('seller_id', auth('seller')->id())->get();
    $products = auth('seller')->user()->products;
    return view('seller.product.list', compact('products'));
  }

  public function subAdminIndex(){
    $products = auth('sub_admin')->user()->products;
    return view('sub_admin.product.list', compact('products'));

  }

  public function create()
  {
    $categories = Category::orderBy('name', 'ASC')->get();
    $sellers = User::get()->where('role', 2);
    $data['sellers'] = $sellers;
    $data['categories'] = $categories;
    
    return view('admin.product.create', $data);
  }

  // public function sellerCreate()
  public function sellerCreate()
  {

    // $this->authorize('create', Product::class);

    $categories = Category::orderBy('name', 'ASC')->get();
    $data['categories'] = $categories;

    return view('seller.product.create', $data);
  }


  public function subAdminCreate(){
    $categories = Category::orderBy('name', 'ASC')->get();
    $data['categories'] = $categories;

    return view('sub_admin.product.create', $data);
  }

  public function store(StoreProductRequest $request)
  {
    


    $validatedData = $request->validated();
        

          if(auth('seller')->check()){
            $this->authorize('store', Product::class);
            $validatedData['seller_id'] =  auth('seller')->id();
            
          }elseif(auth('sub_admin')->check()){
            $validatedData['sub_admin_id'] = auth('sub_admin')->id();
          }else{
            $validatedData['seller_id'] = auth('seller')->check() ? auth('seller')->id() : $request->seller_id;
          }
          
      $product = Product::create($validatedData);
    
      if(auth('seller')->check())
      {
        flash()->addSuccess('Successfully product created');
        return redirect()->route('seller.products.index');
      } 
      elseif(auth('sub_admin')->check())
      {
        flash()->addSuccess('Successfully product created');
        return redirect()->route('sub_admin.product.index');
      } 
      flash()->addSuccess('Product created successfully');
      return redirect()->route('products.index');

 
  }

  public function edit($productId)
  {
    $product = Product::find($productId);
    $categories = Category::orderBy('name', 'ASC')->get();
    $sellers = User::get()->where('role', 2);

    if (empty($product)) {
      return redirect()->route('products.index')->with('error', 'Data is empty');
    }
    $data['categories'] = $categories;
    $data['sellers'] = $sellers;
    $data['product'] = $product;
    return view('admin.product.edit', $data);
  }


  public function seller_edit($productId)
  {
    // $this->authorize('edit', Product::class);

    $product = Product::find($productId);
    $categories = Category::orderBy('name', 'ASC')->get();
    if (empty($product)) {
      return redirect()->route('products.index')->with('error', 'Data is empty');
    }
    $data['categories'] = $categories;
    $data['product'] = $product;
    return view('seller.product.edit', $data);
  }

  public function update(Request $request, $productId)
  {

    $this->authorize('update', product::class);
    
    $product = Product::find($productId);
    $validator = Validator::make($request->all(), [
      'title' => 'required|min:3',
      'description' => 'required',
      'price' => 'required|numeric',
      'track_qty' => 'required|numeric',
      'category_id' => 'required',
      'status' => 'required',
    ]);
    $validatedData = $validator->validated();
    if ($validator->passes()) {
      $validatedData['seller_id'] = auth('seller')->check() ? auth('seller')->id() : $request->seller_id;

      $product->update($validatedData);
    
      if(auth('seller')->check()) {
        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully');
      }
      return redirect()->route('products.index')->with('success', 'Product updated successfully');

    } else {
      return redirect()->route('products.index')->withErrors($validator)->withInput();
    }
  }

  public function destroy($productId)
  {
    if (auth('seller')->check()) {
      //policies via controller not authroize for url
      $this->authorize('destroy',Product::class);
      $product = auth('seller')->user()->products()->find(request()->product);
      if ($product) {
        // if(Gate::denies('is-admin')){   //gate via controller not authroize for url
          //   abort(403);
          // }
          
         
         $product->delete();
         return redirect()->route('products.index')->with('success', 'product deleted successfully');
        } else
        return redirect()->back()->with('error', 'Unauthorized');
      }

    $product = Product::find($productId);
    if (empty($product)) {
      return redirect()->route('products.index')->with('error', 'Record is empty');
    }
    $product->delete();
    return redirect()->route('products.index')->with('success', 'product deleted successfully');

  }
}