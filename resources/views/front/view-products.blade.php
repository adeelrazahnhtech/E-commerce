@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('front.order')}}"><button class="btn btn-primary">Back</button></a>       
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
                     <th>Name</th>
                     <th>Description</th>
                     <th>Price</th>
                     {{-- <th>Action</th> --}}
                 </tr>
             </thead>
             <tbody>
                @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No products available</td>
                                </tr>
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