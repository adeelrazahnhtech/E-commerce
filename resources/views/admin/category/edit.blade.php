@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                     <a href="{{route('categories.index')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{route('categories.update',$category->id)}}" method="post" name="" id="" enctype="multipart/form-data">
          @csrf
          @method('put')
            <div class="row">
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                   <input type="text" name="name" id="name" value="{{$category->name}}" class="@error('name') is-invalid @enderror form-control" placeholder="Enter The Name">
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="image">Image</label>
                   <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control">
                  @if (!empty($category->image))
                      <div>
                        <img src="{{asset('uploads/category/'.$category->image)}}" alt="current-image" style="max-width: 100%;">
                         <input type="hidden" name="existing_image" value="{{$category->image}}" class="form-control">  
                    </div>
                  @endif
                   @error('image')
                   <div class="alert alert-danger">{{$message}}</div>
               @enderror
                </div>
               </div>
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{($category->status == 1 ) ? 'selected': '' }} value="1">Yes</option>
                        <option {{($category->status == 0 ) ? 'selected': '' }} value="0">No</option>
                    </select>
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