<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css')}}">
</head>
<body class="hold-transition login-page">
    <div class="register-box">
        <!-- /.login-logo -->
        @include('seller.message')
        <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <a href="#" class="h3">Seller Panel</a>
              </div>
              <div class="card-body">
                <p class="login-box-msg">Sign up to start your session</p>
                <form action="{{ route('register.process') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                        <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                        </div>
                        @error('name')
                           <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="input-group mb-3">
                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                        </div>
                        @error('email')
                           <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                        </div>
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password">
                        <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                        </div>
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="input-group mb-3">
                        <select class="form-control" name="role" id="role">
                          <option>Select A Role</option>
                          @if (!empty($roles))
                          @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->role_type}}</option>
                          @endforeach
                            
                          @endif
                        </select>
                        <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                        </div>
                        @error('password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                              <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                      </div>
                </form>
                <div class="row">
                  <div class="col-md-12">
                     <a href="{{route('seller.login')}}">If you have login account<button class="btn btn-primary btn-block">Sign In</button></a>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<!-- <script src="js/demo.js"></script> -->
    
</body>
</html>