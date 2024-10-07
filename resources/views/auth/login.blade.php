<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Internship Admin Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('img/logo/logo2.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/auth.css') }}">
</head>

{{-- <body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="https://internship.kadangkoding.com/thoriq/pendaftaran-magang/"><img
                        src="{{ asset('img/logo/logofull.png') }}" alt="" class="mt-2 mb-2 img-fluid"></a>
            </div>
            @if (Session::has('profile-updated'))
                <div class="px-4 mt-3">
                    <div class="alert alert-danger ">
                        {{ Session::get('profile-updated') }}
                    </div>
                </div>
            @endif
            <div class="card-body">
                <p class="login-box-msg">Pintu ke Dashboard. Selamat Datang!</p>

                <form action="{{ route('login') }}" method="post" class="mt-2">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" id="form2Example17"
                            class="form-control form-control-md @error('email') is-invalid @enderror" name="email"
                            placeholder="Email" />


                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" id="form2Example27"
                            class="form-control form-control-md @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" />
                        <div class="input-group-append" id="togglePassword">
                            <div class="input-group-text bg-white">
                                <i class="fas fa-eye sm" id="togglePasswordIcon"></i>
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
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        const passwordField = document.getElementById('form2Example27');
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePasswordIcon.classList.remove('fa-eye');
                togglePasswordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                togglePasswordIcon.classList.remove('fa-eye-slash');
                togglePasswordIcon.classList.add('fa-eye');
            }
        });
    </script>

</body> --}}

<body>
    <script src="{{ asset('admin/assets/static/js/initTheme.js') }}"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="https://internship.kadangkoding.com/thoriq/pendaftaran-magang/"><img
                                src="{{ asset('img/logo/logofull.png') }}" alt="Logo"></a>
                    </div>
                    @if (Session::has('profile-updated'))
                        <div class=" mt-3">
                            <div class="alert alert-danger ">
                                {{ Session::get('profile-updated') }}
                            </div>
                        </div>
                    @endif
                    <h1 class="auth-title">@lang('login.title')</h1>
                    <p class="auth-subtitle mb-5">@lang('login.desc')</p>

                    <form action="{{ route('login', ['locale' => app()->getLocale()]) }}" method="post" class="mt-2">
                        @csrf
                        <div class="form-group position-relative has-icon-right mb-4">
                            <input type="email"
                                class="form-control form-control-xl @error('email') is-invalid @enderror" name="email"
                                placeholder="Email">
                            <div class="form-control-icon px-5">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-right mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" id="password">
                            <div class="form-control-icon px-5">
                                <i class="bi bi-eye" type="button" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">@lang('login.btn')</button>
                    </form>
                    {{-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="auth-register.html"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script>
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordIcon = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePasswordIcon.classList.remove('bi-eye');
                togglePasswordIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                togglePasswordIcon.classList.remove('bi-eye-slash');
                togglePasswordIcon.classList.add('bi-eye');
            }
        });
    </script>
</body>

</html>
