@extends('front.layouts.app');

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quentity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cartcontents->isNotEmpty())
                        @foreach ($cartcontents as $item )
                        <tr>
                        <td>{{$item->name}}</td>
                        <td>${{$item->price}}</td>
                        <td>
                            {{-- <a href="{{('front.UpdateCart,$item->id')}}"><button style="background-color:black; color:white;">+</button></a> --}}
                            {{-- {{$item->quantity}} --}}
                            <form action="{{route('front.updateItem',$item->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="text" name="quantity" id="quantity" value="{{$item->quantity}}">
                                <button style="background-color:black; color:white;">Update</button>
                            </form>
                             {{-- <a href="{{('front.addToCart')}}"><button style="background-color:black; color:white;">-</button></a>  --}}
                            </td>
                        <td>${{$item->price*$item->quantity}}</td>
                        <td>
                             <form action="{{route('front.deleteItem',$item->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?')">
                             @csrf
                             @method('DELETE')
                             <button style="background-color:red; color:white;">x</button>
                             </form>
                        </td>
                        </tr>
                            
                        @endforeach
                            
                        @endif
                    </tbody>
                </table>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="sub-title">
                            <h1>Cart Summary</h1>
                        </div>
                       
                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal ({{Cart::getTotalQuantity()}} items)</div>
                            <div>${{ Cart::getSubTotal()}}</div>
                            
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping Fee</div>
                            <div>$0.00</div>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping Fee Discount</div>
                            <div>$0.00</div>
                        </div>
                        <div class="pt-2">
                            <a href="{{route('cart.checkout')}}">
                                <button class="submit btn-block w-100" style="background-color:orange; color:white;">
                                PROCEED TO CHECKOUT ({{ Cart::getTotalQuantity() }})
                            </button>
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
    </section>


@endsection

@section('customJs')
    
@endsection