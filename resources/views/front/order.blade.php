@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
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
                     <th>Order Person</th>
                     <th>Payment id</th>
                     <th>Status</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                 @if (!empty($orders))
                 @foreach ($orders as $order )
                 <tr>
                     <td>{{$user}}</td>
                   
                     <td>{{($order->payment_id)}}</td>
                     <td>{{$order->status}}</td>
                     <td><a href="{{route('order.product',$order->id)}}">View products</a></td>
                   
                 </tr>
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