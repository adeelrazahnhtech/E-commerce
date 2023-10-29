@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                     <a href="{{route('categories.index')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{route('categories.store')}}" method="post" name="" id="" enctype="multipart/form-data">
          @csrf
            <div class="row">
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                   <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" placeholder="Enter The Name">
               @error('name')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="image">Image</label>
                   <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control">
                   @error('image')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
               </div>

            </div>

            <div class="col-md-6">
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
               </div>
        </form>
     </div>
</section>

    
@endsection


@section('customJs')
    
@endsection