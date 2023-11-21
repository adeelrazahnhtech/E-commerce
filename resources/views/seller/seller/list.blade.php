@extends('seller.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        {{-- <div class="col-sm-6">
            <h1>Reviews</h1>
        </div> --}}
         {{-- <!-- <div class="col-sm-6 text-right">
                 <a href="{{('reviews.create')}}"><button class="btn btn-primary">Add</button></a>       
         </div>  --> --}}
    
    </div>
    </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
          <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            @if (!empty($sellers))
            @foreach ($sellers as $seller)
                <tr>
                    <td>{{$seller->name}}</td>
                    <td>{{$seller->user_role->role_type}}</td>
                    <td>{{$seller->email}}</td>
                    <td style="display: flex;">
                    <a href="{{route('sellers.edit',$seller->id)}}"><button class="btn btn-success">Edit</button></a>
                    <form action="{{route('sellers.destroy',$seller->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user')">
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