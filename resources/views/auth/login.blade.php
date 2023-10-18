<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Internship Kadang Koding</title>

  <link rel="shortcut icon" href="{{asset('img/logo/logo2.png')}}" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{asset('img/logo/logofull.png')}}" alt=""  class="mt-2 mb-2 img-fluid" >
    </div>
    @include('components.alert-login')
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="post" class="mt-2">
        @csrf
        <div class="input-group mb-3">
            <input type="email" id="form2Example17" class="form-control form-control-md @error('email') is-invalid @enderror"  name="email" placeholder="Email"/>
           
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
              
          @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" id="form2Example27" class="form-control form-control-md @error('password') is-invalid @enderror" name="password" placeholder="Password"/>
            
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
                
            @enderror
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block mt-3">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="mt-3 text-center">
        <a href="#!" class="small text-muted">Terms of use.</a>
        <a href="#!" class="small text-muted">Privacy policy</a>
      </div>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
