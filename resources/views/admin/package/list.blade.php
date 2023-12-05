@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Packages</h1>
                </div>
                <div class="col-sm-6 text-right">
                         <a href="{{route('packages.create')}}"><button class="btn btn-primary">Create</button></a>       
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
                            <th>duration</th>
                            <th>duration_unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($packages))
                        @foreach ($packages as $package )
                        <tr>
                            <td>{{$package->title}}</td>
                            <td>{{$package->description}}</td>
                            <td>{{$package->price}}</td>
                            <td>{{$package->duration}}</td>
                            <td>{{$package->duration_unit}}</td>
                            <td style="display: flex;">
                              <a href="{{route('packages.edit',$package->id)}}"><button class="btn btn-secondary">Edit</button></a>
                              <form action="{{route('packages.delete',$package->id)}}" method="post" onsubmit="return confirm('Are you sure You want to delete this package')">
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