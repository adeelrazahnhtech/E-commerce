@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
                @if (auth()->user()->order && !auth()->user()->review)
                <a href="{{route('review',$product->id)}}"><button class="btn btn-success">Write a Review</button></a>       
                @endif
                <a href="{{route('account.profile')}}"><button class="btn btn-primary">Back</button></a>       
       </div>
        </div>
    </div>
 </section>
<section class="content">
    <div class="container fluid">
     <div class="row mb-2">
         <div class="col-md-12">
          <table class="table table-striped">
             <thead>
                 <tr>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Price</th>
                     <th>Track Quantity</th>
                     <th>Status</th>
                 </tr>
             </thead>
             <tbody>
                @if (!empty($product))
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->track_qty }}</td>
                            <td>{{ ($product->status) ? 'Active' : 'Inactive' }}</td>
                        </tr>
                        @foreach ($product->reviews as $review)
                        <tr class="text-center"><td>Review</td></tr>
                            
                          <tr><td>   {{$review->review}}</td></tr>
                            
                        @endforeach
            @endif
             </tbody>
          </table>
         </div>

     </div>
    </div>
</section>
    
@endsection

@section('customJs')
    
@endsection