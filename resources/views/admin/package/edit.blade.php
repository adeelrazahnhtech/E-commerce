@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
                <h1>Edit Package</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{route('packages.index')}}"><button class="btn btn-primary">Back</button></a>
    </div>

    </div>

</div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('packages.update',$package->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                       <div class="mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{$package->title}}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter The Title">
                        @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                       </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-2">
                         <label for="title">Description</label>
                         <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                        {{$package->description}}
                        </textarea>
                         @error('description')
                             <div class="alert alert-danger">{{$message}}</div>
                         @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="mb-2">
                         <label for="price">Price</label>
                         <input type="text" name="price" id="price" value="{{$package->price}}" class="form-control @error('price') is-invalid @enderror" placeholder="Enter The Price">
                         @error('price')
                             <div class="alert alert-danger">{{$message}}</div>
                         @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="mb-2">
                         <label for="duration">Duration</label>
                         <div class="input-group">
                         <div class="input-group-append">
                             <select name="duration_unit" class="form-control">
                                <option {{($package->duration_unit == "weeks") ? 'selected': '' }} value="weeks">Weeks</option>
                                <option {{($package->duration_unit == "months") ? 'selected': '' }} value="months">Months</option>
                                <option {{($package->duration_unit == "years") ? 'selected': '' }} value="years">years</option>
                             </select>
                         </div>
                         <input type="number" name="duration" id="duration" value="{{$package->duration}}" class="form-control @error('duration') is-invalid @enderror" placeholder="Enter The Duration">
                         </div>
                         @error('duration')
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