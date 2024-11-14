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
                <h3>Edit User</h3>
                <p class="text-subtitle text-muted">Masukkan data yang ingin diubah Informasi User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            {{-- <form method="POST" action="{{url ('users/'.$id)}}" enctype="multipart/form-data"> --}}
                            <form method="POST" action="{{ route('users.update', $id) }}" enctype="multipart/form-data"
                                id="formUserEdit">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body mt-2">
                                                    <p class="text-uppercase text-sm">User Information</p>
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="{{ $id }}">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="{{ $name }}"
                                                                    name="name" placeholder="Masukkan Nama"
                                                                    id="name">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Email address<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    type="text" value="{{ $email }}"
                                                                    name="email" placeholder="Masukkan Email">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Role<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('role') is-invalid @enderror"
                                                                    name="role">
                                                                    <option value="" selected>Pilih Role</option>
                                                                    @foreach ($roles as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $role == $key ? 'selected' : '' }}>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                @error('role')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Password<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group">
                                                                    <input
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        type="password" value="" name="password"
                                                                        id="password">
                                                                    <div class="input-group-append" id="togglePassword"
                                                                        style="cursor: pointer">
                                                                        <div class="input-group-text bg-white">
                                                                            <i class="fas fa-eye"
                                                                                id="togglePasswordIcon"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">

                                                        <a type="button" class="btn btn-md btn-light-secondary"
                                                            href="{{ route('users.index') }}">Cancel</a>
                                                        <button type=""
                                                            class="btn btn-md btn-primary">Update</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        const passwordField = document.getElementById('password');
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

    <script>
        $(document).ready(function() {
            $("#formUserEdit").on("submit", function(e) {
                e.preventDefault();

                var userId = "{{ $user->id }}";
                var loggedInUserId = "{{ Auth::user()->id }}"; // ID pengguna yang login

                // Tampilkan pesan "loading" saat akan mengirim permintaan AJAX
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                // Mengambil data yang ada di form
                var formData = new FormData(this);
                var name = formData.get('name');
                var email = formData.get('email');
                var role = formData.get('role');
                var password = formData.get('password');

                // Mengecek apakah admin yang sedang login sedang mengedit data pengguna lain
                if (userId !== loggedInUserId) {
                    // Perubahan data pada pengguna lain, kirim permintaan AJAX dan tampilkan SweetAlert
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(
                            ':userId', userId),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Tutup pesan "loading" saat berhasil
                            Swal.close();

                            if (response.success) {
                                // Tampilkan pesan SweetAlert untuk perubahan data pengguna lain
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data pengguna berhasil diupdate.',
                                    confirmButtonColor: "#435EBE",

                                }).then(function() {
                                    // Redirect ke halaman indeks setelah menutup SweetAlert
                                    window.location.href =
                                    '{{ route('users.index') }}';
                                });
                            } else {
                                // Jika validasi gagal, tampilkan pesan-pesan kesalahan
                                if (response.errors) {
                                    var errorMessages = '';
                                    for (var key in response.errors) {
                                        if (response.errors.hasOwnProperty(key)) {
                                            errorMessages += response.errors[key][0] + '<br>';
                                        }
                                    }
                                    Swal.fire('Gagal', errorMessages, 'error');
                                } else {
                                    Swal.fire('Gagal',
                                        'Terjadi kesalahan saat memperbarui data',
                                        'error');
                                }
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422) {
                                // Menampilkan pesan validasi error SweetAlert
                                var errorMessages = '';
                                var errors = xhr.responseJSON.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages += errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat update data.',
                                    'error');
                            }
                        },
                    });
                } else {
                    // Admin yang sedang login mengedit dirinya sendiri
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(
                            ':userId', userId),
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Tutup pesan "loading" saat berhasil
                            Swal.close();

                            if (response.success) {
                                // Tampilkan pesan SweetAlert untuk perubahan data admin yang sedang login
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data profile telah diperbarui',
                                }).then(function() {
                                    window.location.href =
                                        '{{ route('login', ['locale' => app()->getLocale()]) }}';


                                });

                            } else {
                                // Jika validasi gagal, tampilkan pesan-pesan kesalahan
                                if (response.errors) {
                                    var errorMessages = '';
                                    for (var key in response.errors) {
                                        if (response.errors.hasOwnProperty(key)) {
                                            errorMessages += response.errors[key][0] + '<br>';
                                        }
                                    }
                                    Swal.fire('Gagal', errorMessages, 'error');
                                } else {
                                    Swal.fire('Gagal',
                                        'Terjadi kesalahan saat memperbarui data',
                                        'error');
                                }
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422) {
                                // Menampilkan pesan validasi error SweetAlert
                                var errorMessages = '';
                                var errors = xhr.responseJSON.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages += errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat update data.',
                                    'error');
                            }
                        },
                    });
                }
            });
        });
    </script>
@endsection
