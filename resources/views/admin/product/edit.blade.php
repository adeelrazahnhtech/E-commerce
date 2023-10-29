@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                     <a href="{{route('products.index')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{route('products.update',$product->id)}}" method="post" name="" id="">
          @csrf
          @method('put')
            <div class="row">
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                   <input type="text" name="title" id="title" value="{{$product->title}}" class="@error('title') is-invalid @enderror form-control" placeholder="Enter The Title">
               @error('title')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="description">Description</label>
                   <textarea name="description" id="description" class="@error('image') is-invalid @enderror form-control">{{$product->description}}</textarea>
                   @error('description')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="price">Price</label>
                 <input type="text" name="price" id="price"  value="{{$product->price}}" class="@error('price') is-invalid @enderror form-control" placeholder="Enter The Price">
                 @error('price')
                   <div class="alert alert-danger">{{$message}}</div>
                @enderror
                </div>
               </div>

               <div class="col-md-6">
                <div class="mb-3">
                    <label for="track_qty">Track-Qty</label>
                 <input type="text" name="track_qty" id="track_qty" value="{{$product->track_qty}}" class="@error('track_qty') is-invalid @enderror form-control" placeholder="Enter The Quentity">
                 @error('track_qty')
                   <div class="alert alert-danger">{{$message}}</div>
                @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{($product->status == 1 ) ? 'selected': '' }} value="1">Yes</option>
                        <option {{($product->status == 0 ) ? 'selected': '' }} value="0">No</option>
                    </select>
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="category">Category</label>
                  
                    <select name="category_id" id="category" class="form-control">
                        <option>Select A Category</option>
                        @if (!empty($categories))
                        @foreach ($categories as $category)
                        <option {{($product->category_id == $category->id) ? 'selected': '' }} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif
                        
                    </select>
                </div>
               </div>

               <div class="col-md-6">
                <div class="mb-3">
                    <label for="seller">Seller</label>
                  
                    <select name="seller_id" id="seller" class="form-control">
                        <option>Select A seller</option>
                        @if (!empty($sellers))
                        @foreach ($sellers as $seller)
                        <option {{($product->seller_id == $seller->id) ? 'selected': '' }} value="{{$seller->id}}">{{$seller->name}}</option>
                        @endforeach
                    @endif
                        
                    </select>
                </div>
               </div>

            </div>

            <div class="col-md-6">
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
               </div>
        </form>
     </div>

</section>
    
@endsection


@section('customJs')
    
@endsection