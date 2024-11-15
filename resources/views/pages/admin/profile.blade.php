@extends('layouts.app')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile Account</h3>
                <p class="text-subtitle text-muted">Pengguna dapat mengubah informasinya</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('admin.profile') }}
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="section">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ asset('img/admin.jpg') }}" alt="Avatar">
                                </div>

                                <h3 class="mt-3">
                                    @auth
                                        {{ auth()->user()->name }}
                                    @else
                                        User
                                    @endauth
                                </h3>
                                <p class="text-small text-capitalize">{{ auth()->user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            @include('components.alert')
                            <form class="form-horizontal" method="post" action="{{ url('admin/profile') }}"
                                id="formProfileAdmin">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="inputName" class="form-control"
                                        placeholder="Your Name" value="{{ $name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" id="inputEmail" class="form-control"
                                        placeholder="Your Email" value="{{ $email }}">
                                </div>

                                <label for="password" class="form-label">Password</label>

                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="password" name="password" id="inputPassword" class="form-control"
                                        value="" aria-describedby="passwordToggle">
                                    <div class="form-control-icon px-3" style="margin-bottom: 10px" id="togglePassword">
                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const passwordField = document.getElementById('inputPassword');
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

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


    <script>
        $(document).ready(function() {
            $("#formProfileAdmin").on("submit", function(e) {
                e.preventDefault();

                var adminId = "{{ $admin->id }}";
                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var password = $("#inputPassword").val();

                let emailChanged = email !== "{{ $admin->email }}";
                let passwordChanged = password !== "";

                if (name === "{{ $admin->name }}" && !emailChanged && !passwordChanged) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Data tidak ada yang berubah.',
                        confirmButtonColor: "#435EBE",
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.profile.update', ['admin' => ':adminId']) }}'.replace(
                        ':adminId', adminId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            let message = email !== "{{ $admin->email }}" || password ?
                                'Data berhasil diupdate. Silahkan login ulang.' :
                                'Data berhasil diupdate.';

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: message,
                                confirmButtonColor: "#435EBE",
                            }).then(() => {
                                let redirectUrl = email !== "{{ $admin->email }}" ||
                                    password ?
                                    '{{ route('login', ['locale' => app()->getLocale()]) }}' :
                                    '{{ route('admin.profile') }}';
                                window.location.href = redirectUrl;
                            });
                        } else {
                            Swal.fire('Gagal', response.message ||
                                'Terjadi kesalahan saat memperbarui data', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        let errorMessages = xhr.status === 422 ?
                            Object.values(xhr.responseJSON.errors).map(msg => msg[0]).join(
                                '<br>') :
                            'Terjadi kesalahan saat update data.';
                        Swal.fire('Gagal', errorMessages, 'error');
                    }
                });
            });
        });
    </script>
    <!-- /.content -->
@endsection
