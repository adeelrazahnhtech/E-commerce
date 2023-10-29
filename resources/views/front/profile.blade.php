@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6" style="padding-left: 500px;">
                     <a href="{{route('front.cart')}}"><button style="padding: 5px; border:1px solid orange; background-color:white;">Go To Cart</button></a>       
                     <a href="{{route('front.order')}}"><button style="padding: 5px; border:1px solid orange; background-color:white;">Orders</button></a>       
             </div>
        </div>
     </div>
</section>
<section class=" content pt-5">
    <div class="container">
            <div class="row pb-3">
                @if (!empty($products))
                @foreach ($products as $product)
                <div class="col-md-4">
                    
                <div class="card text-center">
                    <div class="card-footer">
                        <form action="{{ route('front.addToCart',$product->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                        </form>
                    </div>
                    <div class="card-body text-center mt-3">
                        <a href="{{route('product',$product->id)}}">
                            <span class="h6 link">{{ $product->title}}</span>
                            <div class="price mt-2">
                                <span class="h5"><strong>${{ $product->price }}</strong></span>
                            </div>
                        </a>
                            @if ($product->reviews->isNotEmpty())
                            <div class="mt-2">
                                <p>Rating:</p>
                                    {{$product->reviews->where('status',1)->avg('rating')}}({{$product->reviews->where('status',1)->count('rating')}})
                            </div>
                        @else
                            <div class="mt-2">
                                <p>No ratings</p>
                            </div>
                        @endif
                                
                    </div> 
                </div>
            </div>
                @endforeach
                @endif
            </div>
                
    </div>
</section>
@endsection


@section('customJs')
    
@endsection



