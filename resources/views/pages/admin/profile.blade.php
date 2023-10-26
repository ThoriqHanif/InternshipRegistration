@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Account Pages</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset ('img/admin.jpg') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">@auth
                                        {{ auth()->user()->name }}
                                    @else
                                        User
                                    @endauth
                                </h3>

                                <p class="text-muted text-center">Admin</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-user mr-3"></i>Nama</strong>

                                <p class="text-muted">
                                    {{$name}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-envelope mr-3"></i>  Email</strong>

                                <p class="text-muted">{{$email}}</p>

                                <hr>

                                <strong><i class="fas fa-briefcase mr-3"></i>Role</strong>

                                <p class="text-muted">
                                    {{$role}}
                                </p>

                                <hr>

                            
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    
                                    <li class="nav-item"><a class="active nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="active tab-pane" id="settings">
                                        @include('components.alert')
                                        <form class="form-horizontal" method="post" action="{{ url('admin/profile')}}" id="formProfileAdmin">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Name" name="name" value="{{$name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputEmail"
                                                        placeholder="Email" name="email" value="{{$email}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="inputPassword" name="password"
                                                        value="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="offset-sm-2 mt-2 col-sm-10">
                                                    <button type="submit" class="btn btn-md btn-success">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>


    <script>
$(document).ready(function() {
    $("#formProfileAdmin").on("submit", function(e) {
        e.preventDefault();

        var adminId = "{{ $admin->id }}";

        // Ambil data yang diperlukan dari form
        var name = $("#inputName").val();
        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val(); // Pastikan Anda memiliki input dengan id "password"

        // Inisialisasi variabel yang menunjukkan apakah terjadi perubahan pada email atau password
        var emailChanged = email !== "{{ $admin->email }}";
        var passwordChanged = password !== "";

        if (name === "{{ $admin->name }}" && !emailChanged && !passwordChanged) {
            // Tidak ada perubahan, tampilkan pesan "Data tidak ada yang berubah"
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Data tidak ada yang berubah.',
            });
            return; // Keluar dari fungsi jika tidak ada perubahan
        }

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
            url: '{{ route('admin.profile.update', ['admin' => ':adminId']) }}'.replace(':adminId', adminId),
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                // Tutup pesan "loading" saat berhasil
                Swal.close();

                if (response.success) {
                    if (emailChanged || passwordChanged) {
                        // Logout jika email atau password berubah
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diupdate. Silahkan login ulang.',
                        }).then(function() {
                            window.location.href = '{{ route('login') }}';
                        });
                    } else {
                        // Redirect ke halaman profile jika hanya nama yang diubah
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil diupdate.',
                        }).then(function() {
                            window.location.href = '{{ route('admin.profile') }}';
                        });
                    }
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
                        Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data', 'error');
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
    <!-- /.content -->
    {{-- <script>
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
            var password = formData.get('password');
    
            // Mengecek apakah admin yang sedang login sedang mengedit data pengguna lain
            if (userId !== loggedInUserId) {
                // Perubahan data pada pengguna lain, kirim permintaan AJAX dan tampilkan SweetAlert
                // User yang sedang login mengedit dirinya sendiri
                $.ajax({
                    type: 'POST',
                    url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(':userId', userId),
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
                                        window.location.href = '{{ route('login') }}';
                                        
                            
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
            }
        });
    });
    
    </script> --}}

{{-- <script>
        $(document).ready(function() {
    $("#formProfileAdmin").on("submit", function(e) {
        e.preventDefault();

        var adminId = "{{ $admin->id }}";
        var url = '{{ route('admin.profile.update', ['user' => ':userId']) }}'.replace(':userId', adminId);
        var formData = new FormData(this);

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
            url: url,
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
                        // Redirect ke halaman login setelah menutup SweetAlert
                        window.location.href = '{{ route('login') }}';
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
                        Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data', 'error');
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

</script> --}}
        
@endsection
