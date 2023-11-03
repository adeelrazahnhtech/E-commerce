@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Reviews</h1>
        </div>
         <!-- <div class="col-sm-6 text-right">
                 <a href="{{('reviews.create')}}"><button class="btn btn-primary">Add</button></a>       
         </div>  -->
    
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
                <th>Product</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @if (!empty($reviews))
            @foreach ($reviews as $review)
            @if ($review->reviewable_id)
              @php
              $user = App\Models\User::find($review->reviewable_id);
              $role = App\Models\Role::find($user->role); 
              @endphp
               @endif
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$role->role_type}}</td>
                    <td>{{$review->product_id}}</td>
                    <td>{{$review->rating}}</td>
                    <td>{{$review->review}}</td>
                    <td>
                        @if ($review->status == 0)
                            <button class="btn btn-secondary">Pending</button>
                        @else
                            <button class="btn btn-success">Approved</button>
                        @endif
                    </td>
                    @if ($review->status === 0)
                    <td style="display: flex;">
                        <a href="{{route('review.approved',$review->id)}}"><button class="btn btn-success">Approved</button></a>
                    </td>
                    @else
                    <td style="display: flex;">
                        <a href="{{route('review.disapproved',$review->id)}}"><button class="btn btn-danger">Disapproved</button></a>
                    </td>
                    @endif
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