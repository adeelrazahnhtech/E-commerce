@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
                <h1>Create Package</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{route('packages.index')}}"><button class="btn btn-primary">Back</button></a>
    </div>

    </div>

</div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{route('packages.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                       <div class="mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter The Title">
                        @error('title')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                       </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-2">
                         <label for="title">Description</label>
                         <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                        </textarea>
                         @error('description')
                             <div class="alert alert-danger">{{$message}}</div>
                         @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="mb-2">
                         <label for="price">Price</label>
                         <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter The Price">
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
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                                <option value="years">years</option>
                             </select>
                         </div>
                         <input type="number" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" placeholder="Enter The Duration">
                         </div>
                         @error('duration')
                             <div class="alert alert-danger">{{$message}}</div>
                         @enderror
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