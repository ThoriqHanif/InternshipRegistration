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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    {{-- @foreach ($user->intern as $intern) --}}
                    <div class="col-md-5">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if ($photoUrl)
                                        <img src="{{ $photoUrl }}" class="img-fluid elevation-1 mb-2 rounded"
                                            width="200px" height="200px" alt="User Image">
                                    @else
                                        <img src="{{ asset('img/profile1.jpg') }}" class="img-circle elevation-2"
                                            alt="User Image">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{ $user->intern ? $user->intern->full_name : '' }}
                                </h3>

                                <p class="text-muted text-center">{{ $user->intern ? $user->intern->position->name : '' }}
                                </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Tanggal Mulai</b> 
                                        <a class="float-right text-success">
                                            {{ $user->intern ? \Carbon\Carbon::parse($user->intern->start_date)->locale('id')->translatedFormat('l, j F Y') : '' }}

                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Selesai</b> 
                                        <a class="float-right text-danger">
                                            {{ $user->intern ? \Carbon\Carbon::parse($user->intern->end_date)->locale('id')->translatedFormat('l, j F Y') : '' }}
                                        </a>
                                    </li>

                                </ul>

                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
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
                                <strong><i class="fas fa-user mr-2"></i> Nama Lengkap</strong>

                                <p class="text-muted">
                                    {{ $user->intern ? $user->intern->full_name : '' }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-2"></i> Alamat</strong>

                                <p class="text-muted">{{ $user->intern ? $user->intern->address : '' }}</p>

                                <hr>

                                <strong><i class="fas fa-phone mr-2"></i> No Telp</strong>

                                <p class="text-muted">
                                    {{ $user->intern ? $user->intern->phone_number : '' }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-venus-mars mr-2"></i> Jenis Kelamin</strong>

                                <p class="text-muted">{{ $user->intern ? $user->intern->gender : '' }}</p>
                                <hr>
                                <strong><i class="fas fa-school mr-2"></i> Asal Sekolah</strong>

                                <p class="text-muted">
                                    {{ $user->intern ? $user->intern->school : '' }}
                                </p>

                                <hr>
                                <strong><i class="fas fa-graduation-cap mr-2"></i> Jurusan / Prodi</strong>

                                <p class="text-muted">
                                    {{ $user->intern ? $user->intern->major : '' }}
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
                                    <li class="nav-item"><a class="nav-link active" href="#timeline"
                                            data-toggle="tab">Timeline</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane active" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                {{-- <span class="bg-danger"> --}}
                                                {{-- {{$intern->created_at}} --}}
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i>
                                                        {{ $user->intern ? $user->intern->created_at : '' }}
                                                    </span>

                                                    <h3 class="timeline-header"><a href="#">Kadang Koding
                                                            Indonesia </a> sent you an message</h3>

                                                    <div class="timeline-body">
                                                        Terimakasih {{ $user->intern ? $user->intern->full_name : '' }}
                                                        telah mendaftarkan diri
                                                        untuk magang di Kadang Koding Indonesia. Mohon ditunggu untuk
                                                        Update selanjutnya.
                                                    </div>
                                                    <div class="timeline-footer">

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-success"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Kadang Koding
                                                            Indonesia </a> sent you an update</h3>

                                                    <div class="timeline-body">
                                                        Hii {{ $user->intern ? $user->intern->full_name : '' }},
                                                        terimakasih telah mendaftar
                                                        magang di Kadang Koding Indonesia. Status pendaftaran anda <a
                                                            class="badge badge-success text-capitalize">{{ $user->intern ? $user->intern->status : '' }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal" method="post" action="{{ url('profile') }}"
                                            id="formProfileUser">
                                            {{-- @foreach ($user->interns as $intern) --}}
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="inputFullName" class="col-sm-3 col-form-label">Nama
                                                    Lengkap</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputFullName"
                                                        placeholder="Nama Lengkap" name="full_name"
                                                        value="{{ $user->intern ? $user->intern->full_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Username" name="name"
                                                        value="{{ $name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPhoneNumber" class="col-sm-3 col-form-label">No
                                                    Handphone</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="inputPhoneNumber"
                                                        placeholder="No Handphone" name="phone_number"
                                                        value="{{ $user->intern ? $user->intern->phone_number : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAddress" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" class="form-control" id="inputAddress" placeholder="Alamat" name="address"
                                                        value="">{{ $user->intern ? $user->intern->address : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSchool" class="col-sm-3 col-form-label">Asal
                                                    Sekolah</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputSchool"
                                                        placeholder="Asal Sekolah" name="school"
                                                        value="{{ $user->intern ? $user->intern->school : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputMajor" class="col-sm-3 col-form-label">Jurusan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputMajor"
                                                        placeholder="Jurusan" name="major"
                                                        value="{{ $user->intern ? $user->intern->major : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputEmail"
                                                        name="email" placeholder="Email" value="{{ $email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="inputPassword"
                                                            name="password" value=""
                                                            aria-describedby="passwordToggle">
                                                        <div class="input-group-append" id="togglePassword">
                                                            <div class="input-group-text bg-white"
                                                                style="cursor: pointer">
                                                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label for="inputFoto" class="col-sm-3 col-form-label">Foto</label>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input
                                                            class="custom-file-input form-control @error('photo') is-invalid @enderror"
                                                            type="file" id="filefoto" name="photo"
                                                            accept=".jpg, .jpeg, .png, .webp">
                                                        <label class="custom-file-label" for="fileSurat">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-5">
                                                    @if ($photoUrl)
                                                        <a data-fancybox data-caption="Pas Foto"
                                                            href="{{ $photoUrl }}">
                                                            <img src="{{ $photoUrl }}"
                                                                class="mt-3 mb-3 elevation-1 mb-2 rounded-lg"
                                                                alt="PAS Foto" width="200">
                                                        </a>
                                                    @else
                                                        <p class="text-sm text-danger">Belum ada Foto</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </div>
                                            {{-- @endforeach --}}
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
                    {{-- @endforeach --}}
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        const passwordField = document.getElementById('inputPassword');
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
            $("#formProfileUser").on("submit", function(e) {
                e.preventDefault();

                var userId = "{{ $user->id }}";

                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var full_name = $("#inputFullName").val();
                var phone_number = $("#inputPhoneNumber").val();
                var address = $("#inputAddress").val();
                var school = $("#inputSchool").val();
                var major = $("#inputMajor").val();
                var password = $("#inputPassword").val();
                var photo = $("#filefoto")[0].files[0]; // Ambil foto yang diunggah

                // console.log(name, email, full_name, phone_number, school, major);

                var emailChanged = email !== "{{ $user->email }}";
                var passwordChanged = password !== "";

                var prevFullName = "{{ $user->intern ? $user->intern->full_name : '' }}";
                var prevPhoneNumber = "{{ $user->intern ? $user->intern->phone_number : '' }}";
                var prevAddress = "{{ $user->intern ? $user->intern->address : '' }}";
                var prevSchool = "{{ $user->intern ? $user->intern->school : '' }}";
                var prevMajor = "{{ $user->intern ? $user->intern->major : '' }}";
                var prevPhoto = "{{ $photoUrl ?? '' }}";


                var internChanged = full_name !== prevFullName || phone_number !== prevPhoneNumber ||
                    address !== prevAddress ||
                    school !== prevSchool || major !== prevMajor ||
                    ($("#filefoto")[0].files.length > 0);

                if (name === "{{ $user->name }}" && !emailChanged && !passwordChanged && !
                    internChanged) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Data tidak ada yang berubah.',
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

                var formData = new FormData(this);
                formData.append('_method', 'PUT');
                formData.append('photo', photo);


                $.ajax({
                    type: 'POST',
                    url: '{{ route('profile.update', ['user' => ':userId']) }}'.replace(':userId',
                        userId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        // console.log(response);
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
                                    window.location.href = '{{ route('profile') }}';
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
@endsection
