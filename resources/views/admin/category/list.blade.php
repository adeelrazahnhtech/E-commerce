@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                         <a href="{{route('categories.create')}}"><button class="btn btn-primary">Create</button></a>       
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories))
                        @foreach ($categories as $category )
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{($category->status == 1) ? 'Active' : 'Inactive' }}</td>
                            <td style="display: flex;">
                              <a href="{{route('categories.edit',$category->id)}}"><button class="btn btn-secondary">Edit</button></a>
                              <form action="{{route('categories.delete',$category->id)}}" method="post" onsubmit="return confirm('Are you sure You want to delete this category')">
                                @csrf
                                @method('DELETE')  
                                <button class="btn btn-danger">Delete</button>
                              </form>
                            </td>
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