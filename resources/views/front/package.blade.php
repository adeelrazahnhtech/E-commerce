@extends('front.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
                <a href="{{route('account.profile')}}"><button class="btn btn-primary">Back</button></a>       
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
                     <th>Package name</th>
                     <th>Start day</th>
                     <th>Expire day</th>
                     <th>Remaining days</th>
                 </tr>
             </thead>
             <tbody>
                 @if (!empty($package))
                 <tr>
                     <td>{{$package->title}}</td>
                     <td>{{$package->pivot->created_at}}</td>
                     <td>{{$expire}}</td>
                     <td>{{$remainingDays}}</td>
                 </tr>
                     
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