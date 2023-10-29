@extends('seller.layouts.app');

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                         <a href="{{route('seller.products.index')}}"><button class="btn btn-primary">Back</button></a>       
                 </div>
            </div>
         </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('seller.products.store')}}" method="post" name="" id="">
              @csrf
                <div class="row">
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title">Title</label>
                       <input type="text" name="title" id="title" class="@error('title') is-invalid @enderror form-control" placeholder="Enter The Title">
                   @error('title')
                       <div class="alert alert-danger">{{$message}}</div>
                   @enderror
                    </div>
                   </div>
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description">Description</label>
                       <textarea name="description" id="description" class="@error('image') is-invalid @enderror form-control"></textarea>
                       @error('description')
                       <div class="alert alert-danger">{{$message}}</div>
                   @enderror
                    </div>
                   </div>
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price">Price</label>
                     <input type="text" name="price" id="price" class="@error('price') is-invalid @enderror form-control" placeholder="Enter The Price">
                     @error('price')
                       <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>
                   </div>
    
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="track_qty">Track-Qty</label>
                     <input type="text" name="track_qty" id="track_qty" class="@error('track_qty') is-invalid @enderror form-control" placeholder="Enter The Quentity">
                     @error('track_qty')
                       <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>
                   </div>
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
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
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        @endif
                            
                         </select>
                    </div>
                   </div> 
    
                </div>
    
                <div class="col-md-6">
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                   </div>
            </form>
         </div>
    </section>
@endsection


@section('customJs')
    
@endsection