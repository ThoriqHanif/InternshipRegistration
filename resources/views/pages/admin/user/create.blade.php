@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">User Management</li>
                        </ol>
                    </div>
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
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data"
                                id="formUser">
                                @csrf
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">User Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="" name="name"
                                                                    placeholder="Masukkan Nama">
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
                                                                    type="email" value="" name="email"
                                                                    placeholder="Masukkan Email">
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
                                                                    <option value="" selected disabled>Pilih Role
                                                                    </option>
                                                                    <option value="admin"
                                                                        {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                                                    </option>
                                                                    <option value="user"
                                                                        {{ old('role') == 'user' ? 'selected' : '' }}>User
                                                                    </option>
                                                                </select>

                                                                @error('role')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input" class="form-control-label">Password<span class="text-danger"> *</span></label>
                                                                <div class="input-group">
                                                                    <input class="form-control @error('password') is-invalid @enderror" type="password" value="" name="password" id="password" placeholder="Masukkan Password">
                                                                    <div class="input-group-append" id="togglePassword" style="cursor: pointer">
                                                                        <div class="input-group-text bg-white">
                                                                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
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
                                                        <button type="submit" class="btn btn-md btn-success"
                                                            id="submitButton">Simpan</button>
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            onclick="window.history.back();">Cancel</button>

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
            $("#formUser").on("submit", function(e) {
                e.preventDefault();

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

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('users.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        Swal.close();

                        if (response.success) {
                            // Redirect ke halaman index dengan pesan "success"
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
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
                                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
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
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
@endsection
