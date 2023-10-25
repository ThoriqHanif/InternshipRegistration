@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
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
                                <h3 class="card-title">Form Edit User</h3>
                            </div>
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
                                                <div class="card-body">
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
                                                                <input
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    type="text" value="" name="password">
                                                                @error('password')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        <button type=""
                                                            class="btn btn-md btn-success">Update</button>
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

    {{-- <script>
    $(document).ready(function() {
        $("#formUserEdit").on("submit", function(e) {
            e.preventDefault();

            var userId = "{{ $user->id }}";
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
                url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(':userId', userId),
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
                            text: 'Data berhasil diupdate.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('users.index') }}';
                        });
                    } else {
                        // Redirect ke halaman index dengan pesan "error"
                        // window.location.href = '{{ route('users.index') }}';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('users.index') }}';
                        });
                    }
                },
                error: function() {
                    // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                    Swal.close();

                    // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Terjadi kesalahan saat update data.',
                    });
                }
            });
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
        $("#formUserEdit").on("submit", function(e) {
            e.preventDefault();

            var userId = "{{ $user->id }}";
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

            // Mengecek apakah hanya nama yang diubah
            if (name !== "{{ $user->name }}" && email === "{{ $user->email }}" && role === "{{ $user->role }}" && !password) {
                // Hanya ada perubahan pada nama, kirim permintaan AJAX dan tampilkan SweetAlert
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
                            // Redirect ke halaman index dengan pesan "success"
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
                            });
                        } else {
                            // Tampilkan pesan "error" jika terjadi kesalahan saat update
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: 'Terjadi kesalahan saat update data.',
                            });
                        }
                    },
                    error: function() {
                        // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                        Swal.close();

                        // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                });
            } else {
                // Ada perubahan lain selain nama, logout pengguna dan redirect ke halaman login
                Auth.logout();
                window.location.href = '{{ route('login') }}';
            }
        });
    });
</script> --}}

{{-- UTAMA --}}
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
            var role = formData.get('role');
            var password = formData.get('password');

            // Mengecek apakah hanya nama yang diubah dan pengguna yang sedang login adalah pengguna yang sedang diubah
            if (userId == loggedInUserId && (email !== "{{ $user->email }}" || role !== "{{ $user->role }}" || password)) {
                // Ada perubahan email, role, atau password pada pengguna yang sedang login, maka kita logout
                Auth.logout();
                window.location.href = '{{ route('login') }}';
            } else {
                // Perubahan lain pada pengguna lain, kirim permintaan AJAX dan tampilkan SweetAlert
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
                            // Tampilkan pesan SweetAlert untuk perubahan data pengguna lain
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data pengguna berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
                            });
                        } else {
                            // Tampilkan pesan "error" jika terjadi kesalahan saat update
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: 'Terjadi kesalahan saat update data.',
                            });
                        }
                    },
                    error: function() {
                        // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                        Swal.close();

                        // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                });
            }
        });
    });
</script> --}}

    {{-- <script>
    $(document).ready(function() {
        $("#formUserEdit").on("submit", function(e) {
            e.preventDefault();

            var userId = "{{ $user->id }}";
            var loggedInUserId = "{{ Auth::user()->id }}"; // ID pengguna yang login

            // Mengambil data yang ada di form
            var formData = new FormData(this);
            var name = formData.get('name');
            var email = formData.get('email');
            var role = formData.get('role');
            var password = formData.get('password');

            if (userId == loggedInUserId) {
                // Pengguna yang login mengubah data diri mereka sendiri
                if (name !== "{{ $user->name }}" || email !== "{{ $user->email }}" || role !== "{{ $user->role }}" || password) {
                    // Ada perubahan pada data diri mereka sendiri, maka kita logout
                    Auth.logout();
                    window.location.href = '{{ route('login') }}';
                } else {
                    // Tidak ada perubahan pada data diri mereka sendiri, tampilkan pesan SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Anda berhasil diupdate.',
                    }).then(function() {
                        // Redirect ke halaman indeks setelah menutup SweetAlert
                        window.location.href = '{{ route('users.index') }}';
                    });
                }
            } else {
                // Pengguna mengubah data pengguna lain
                // Kirim permintaan AJAX dan tampilkan SweetAlert
                $.ajax({
                    type: 'POST',
                    url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(':userId', userId),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Tampilkan pesan SweetAlert untuk perubahan data pengguna lain
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data pengguna berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
                            });
                        } else {
                            // Tampilkan pesan "error" jika terjadi kesalahan saat update
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: 'Terjadi kesalahan saat update data.',
                            });
                        }
                    },
                    error: function() {
                        // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                });
            }
        });
    });
</script> --}}

{{-- WORK 1 --}}
{{-- <script>$(document).ready(function() {
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
                url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(':userId', userId),
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
                            text: 'Data berhasil diupdate.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('users.index') }}';
                        });
                    } else {
                        // Tampilkan pesan "error" jika terjadi kesalahan saat update
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                },
                error: function() {
                    // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                    Swal.close();

                    // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Terjadi kesalahan saat update data.',
                    });
                }
            });
        } else {
            // Admin yang sedang login mengedit data dirinya sendiri
            // Check apakah hanya nama yang diubah
            if (email !== "{{ $user->email }}" || role !== "{{ $user->role}}" || password) {
                // Ada perubahan email, role, atau password pada pengguna yang sedang login, maka kita logout
                $.ajax({
                    type: 'POST',
                    url: '{{ route('logout') }}', // Gantilah dengan rute logout yang sesuai
                    success: function() {
                        // Redirect ke halaman login setelah logout
                        window.location.href = '{{ route('login') }}';
                    },
                });
            } else {
                // Hanya perubahan nama pada pengguna yang sedang login
                // Kirim permintaan AJAX untuk mengupdate nama saja
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
                            // Tampilkan pesan SweetAlert untuk perubahan nama
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Nama pengguna berhasil diupdate.',
                            }).then(function() {
                                // Refresh halaman setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
                            });
                        } else {
                            // Tampilkan pesan "error" jika terjadi kesalahan saat update
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: 'Terjadi kesalahan saat update data.',
                            });
                        }
                    },
                    error: function() {
                        // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                        Swal.close();

                        // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                });
            }
        }
    });
});
</script> --}}

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
                url: '{{ route('users.update', ['user' => ':userId']) }}'.replace(':userId', userId),
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
        } else {
            // Admin yang sedang login mengedit dirinya sendiri
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
                        // Tampilkan pesan "error" jika terjadi kesalahan saat update
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat update data.',
                        });
                    }
                },
                error: function() {
                    // Tutup pesan "loading" saat terjadi kesalahan saat melakukan AJAX
                    Swal.close();

                    // Tampilkan pesan "error" jika terjadi kesalahan saat melakukan AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Terjadi kesalahan saat update data.',
                    });
                }
            });
        }
    });
});

</script>

@endsection
