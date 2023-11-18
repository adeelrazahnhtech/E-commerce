@extends('admin.layouts.app')

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
                    @if ($seller->email_verified === 0)
                        <a href="{{route('seller.approved',$seller->id)}}"><button class="btn btn-primary">Approved</button></a>
                    @else
                        <a href="{{route('seller.disapproved',$seller->id)}}"><button class="btn btn-danger">Disapproved</button></a>
                    @endif
                    <a href="{{route('seller.permission',$seller->id)}}"><button class="btn btn-success">Permission</button></a>
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