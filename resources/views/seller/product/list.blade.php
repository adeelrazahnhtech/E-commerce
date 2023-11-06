@extends('seller.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Products</h1>
        </div>
        <div class="col-sm-6 text-right">
                 <a href="{{route('seller.products.create')}}"><button class="btn btn-primary">Add</button></a>       
         </div>
    
    </div>
    </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                @extends('message')
          <table class="table table-striped">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Track Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @if (!empty($products))
                
            {{-- @dd($products) --}}
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->track_qty}}</td>
                    <td>{{($product->status == 1 ) ? 'Yes' : 'No' }}</td>
                    <td style="display: flex;">
                        @if ($product->reviews->where('reviewable_id','=',auth('seller')->id() AND 'reviewable_type','=','App\Models\User')->isEmpty())
                        <a href="{{route('seller.give_review',$product->id)}}"><button class="btn btn-sm btn-success">Write a Review</button></a>  
                        @endif

                        <a href="{{route('seller.products.edit',$product->id)}}"><button class="btn btn-sm btn-secondary">Edit</button></a>
                   <form action="{{route('products.delete',$product->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this product')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button> 
                   </form>
                    </td>
                </tr>
            @endforeach
            @endif
    
          </table>
            </div>
        
        </div>
        </div>
        </section>
    
@endsection


@section('customJs')
    
@endsection