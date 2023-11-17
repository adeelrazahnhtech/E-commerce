@extends('sub_admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Products</h1>
        </div>
        <div class="col-sm-6 text-right">
                 <a href="{{route('sub_admin.product.create')}}"><button class="btn btn-primary">Add</button></a>       
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
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->track_qty}}</td>
                    <td>{{($product->status == 1 ) ? 'Yes' : 'No' }}</td>
                    <td style="display: flex;">
                        @if ($product->reviews->where('reviewable_id','=',auth('sub_admin')->id() AND 'reviewable_type','=','App\Models\SubAdmin' AND 'product_id','=',$product->id)->isEmpty())
                        <a href="{{route('sub_admin.give_review',$product->id)}}"><button class="btn btn-sm btn-success">Write a Review</button></a>  
                        @endif
                        <a href="{{('sub_admin.products.edit')}}"><button class="btn btn-sm btn-secondary">Edit</button></a>
                        
                   <form action="{{('sub_admin.products.delete')}}" method="post" onsubmit="return confirm('Are you sure you want to delete this product')">
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