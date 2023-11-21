@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
           
            <div class="col-sm-12 text-right">
                     <a href="{{route('seller')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid ml-5">
        <form action="{{route('permission.store',$seller->id)}}" method="post" name="" id="" >
          @csrf
            <div class="row">
                <div class="mb-3">
                    <label for="permission">Permission</label>
                    <div class="form-check">
                        {{-- @dd($seller->permissions->toArray()) --}}
                        @foreach ($permissions as $key => $permission)
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->name }}" {{$permission->seller!=null?'checked':''}}>
                        <label class="form-check-label" for="{{$permission->name}}">{{$permission->name}}</label>
                        </div>
                        @endforeach
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