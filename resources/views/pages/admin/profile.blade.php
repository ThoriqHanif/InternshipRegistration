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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Profile</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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

                // Ambil data yang diperlukan dari form
                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var password = $("#inputPassword")
                    .val(); // Pastikan Anda memiliki input dengan id "password"

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
                    url: '{{ route('admin.profile.update', ['admin' => ':adminId']) }}'.replace(
                        ':adminId', adminId),
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
                                    window.location.href =
                                        '{{ route('admin.profile') }}';
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
