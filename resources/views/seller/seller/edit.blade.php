@extends('seller.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Seller</h1>
            </div>
            <div class="col-sm-6 text-right">
                     <a href="{{route('sellers.index')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{route('sellers.update',$seller->id)}}" method="post" name="" id="">
          @csrf
          @method('put')
            <div class="row">
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                   <input type="text" name="name" id="name" value="{{$seller->name}}" class="@error('name') is-invalid @enderror form-control" placeholder="Enter The Name">
               @error('name')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="email">email</label>
                   <textarea name="email" id="email" class="@error('email') is-invalid @enderror form-control">{{$seller->email}}</textarea>
                   @error('email')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
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