@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
           
            <div class="col-sm-6 text-right">
                     <a href="{{route('seller')}}"><button class="btn btn-primary">Back</button></a>       
             </div>
        </div>
     </div>
</section>
<section class="content">
    <div class="container-fluid">
        <form action="{{('categories.store')}}" method="post" name="" id="" >
          @csrf
            <div class="row">
               
              
               <div class="col-md-6">
                <div class="mb-3">
                    <label for="status">Permission</label>
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