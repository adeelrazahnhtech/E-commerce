@extends('front.layouts.app');

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Review</h1>
                </div>
                <div class="col-sm-6 text-right">
                         <a href="{{route('product',$product->id)}}"><button class="btn btn-primary">Back</button></a>       
                 </div>
            </div>
         </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('review.process')}}" method="post" name="" id="">
              @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rating">Rating</label>
                            <select name="rating" id="rating" class="form-control">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
    
                   <div class="col-md-6">
                    <div class="mb-3">
                        <label for="review">Review</label>
                       <textarea name="review" id="review" class="@error('image') is-invalid @enderror form-control"></textarea>
                       @error('review')
                       <div class="alert alert-danger">{{$message}}</div>
                   @enderror
                    </div>
                   </div>
    
                  <div class="col-md-6">
                    <div class="mb-3">
                        <label for="product">Product</label>
                        <select name="product_id" id="product" class="form-control">
                         @if (!empty($product))
                            <option value="{{$product->id}}">{{$product->title}}</option>
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