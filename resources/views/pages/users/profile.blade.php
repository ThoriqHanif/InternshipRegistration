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
                        {{-- <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li> --}}
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


        <section>
            <div class="card mt-2">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            @if ($photoUrl)
                                <img src="{{ $photoUrl }}" alt="User Image">
                            @else
                                <img src="{{ asset('admin/assets/static/images/2.jpg') }}" alt="User Image">
                            @endif
                        </div>
                        <div class="ms-4 name">
                            <h4 class="font-bold">{{ $user->intern ? $user->intern->full_name : '' }}</h4>
                            <p class="text-small">
                                {{ $user->intern ? $user->intern->position->name ?? '-' :''}}</p>

                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <form class="form-horizontal" method="post" action="{{ url('profile') }}" id="formProfileUser">
                    @csrf
                    @method('PUT')
                    <section id="multiple-column-form">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Link External</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">URL Portolio</label>
                                                        <input type="text" name="url" id="inputUrl"
                                                            class="form-control"
                                                            placeholder="https://internship.kadangkoding.com/name" value="{{ $user->intern ? $user->intern->url : '' }}">
                                                    </div>
                                                </div>
                                                {{-- @foreach ($social_medias as $sosmed)
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="full_name" class="form-label">URL
                                                                {{ $sosmed->name }}</label>
                                                            <input type="text" name="" id=""
                                                                class="form-control"
                                                                placeholder="https://internship.kadangkoding.com/name"
                                                                value="{{ $sosmed->url ? $sosmed->url : '' }}">
                                                        </div>
                                                    </div>
                                                @endforeach --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            </div>
        </section>
        <section class="section">
            <div class="row">

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Informasi Pengguna</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="full_name" id="inputFullName"
                                                        class="form-control" placeholder="Your Name"
                                                        value="{{ $user->intern ? $user->intern->full_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Nama Panggilan</label>
                                                    <input type="text" name="name" id="inputName" class="form-control"
                                                        placeholder="Username" value="{{ $name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="inputPhoneNumber" class="form-label">No
                                                        Handphone</label>
                                                    <input type="number" name="phone_number" id="inputPhoneNumber"
                                                        class="form-control" placeholder="No Handphone"
                                                        value="{{ $user->intern ? $user->intern->phone_number : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="inputAddress" class="form-label">Alamat</label>
                                                    <textarea type="text" name="address" id="inputAddress" class="form-control" placeholder="Alamat">{{ $user->intern ? $user->intern->address : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="inputSchool" class="form-label">Asal Sekolah</label>
                                                    <input type="text" name="school" id="inputSchool"
                                                        class="form-control" placeholder="Asal Sekolah"
                                                        value="{{ $user->intern ? $user->intern->school : '' }}"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="inputMajor" class="form-label">Jurusan</label>
                                                    <input type="text" name="major" id="inputMajor"
                                                        class="form-control" placeholder="Jurusan"
                                                        value="{{ $user->intern ? $user->intern->major : '' }}"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" name="email" id="inputEmail"
                                                        class="form-control" placeholder="Your Email"
                                                        value="{{ $email }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <label for="password" class="form-label">Password</label>

                                                <div class="form-group position-relative has-icon-right mb-4">
                                                    <input type="password" name="password" id="inputPassword"
                                                        class="form-control" value=""
                                                        aria-describedby="passwordToggle">
                                                    <div class="form-control-icon px-3" style="margin-bottom: 10px"
                                                        id="togglePassword">
                                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="file" class="form-label">Pas Foto</label>
                                                    <input type="file" accept=".jpg, .jpeg, .png, .webp"
                                                        name="photo" id="filefoto"
                                                        class="form-control @error('photo') is-invalid @enderror">
                                                </div>
                                                <div class="form-group">
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
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Save
                                                    Changes</button>
                                                {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

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
            $("#formProfileUser").on("submit", function(e) {
                e.preventDefault();

                var userId = "{{ $user->id }}";

                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var full_name = $("#inputFullName").val();
                var phone_number = $("#inputPhoneNumber").val();
                var address = $("#inputAddress").val();
                var school = $("#inputSchool").val();
                var url = $("#inputUrl").val();
                var major = $("#inputMajor").val();
                var password = $("#inputPassword").val();
                var photo = $("#filefoto")[0].files[0];

                var emailChanged = email !== "{{ $user->email }}";
                var passwordChanged = password !== "";

                var prevFullName = "{{ $user->intern ? $user->intern->full_name : '' }}";
                var prevPhoneNumber = "{{ $user->intern ? $user->intern->phone_number : '' }}";
                var prevAddress = "{{ $user->intern ? $user->intern->address : '' }}";
                var prevSchool = "{{ $user->intern ? $user->intern->school : '' }}";
                var prevMajor = "{{ $user->intern ? $user->intern->major : '' }}";
                var prevUrl = "{{ $user->intern ? $user->intern->url : '' }}";
                var prevPhoto = "{{ $photoUrl ?? '' }}";


                var internChanged = full_name !== prevFullName || phone_number !== prevPhoneNumber ||
                    address !== prevAddress ||
                    school !== prevSchool ||
                    url !== prevUrl || major !== prevMajor ||
                    ($("#filefoto")[0].files.length > 0);

                if (name === "{{ $user->name }}" && !emailChanged && !passwordChanged && !
                    internChanged) {
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
                        Swal.close();

                        if (response.success) {
                            if (emailChanged || passwordChanged) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diupdate. Silahkan login ulang.',
                                    confirmButtonColor: "#435EBE",
                                }).then(function() {
                                    window.location.href = '{{ route('login', ['locale' => app()->getLocale()]) }}';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diupdate.',
                                    confirmButtonColor: "#435EBE",
                                }).then(function() {
                                    window.location.href = '{{ route('profile') }}';
                                });
                            }
                        } else {
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    html: errorMessages,
                                    confirmButtonColor: "#435EBE",
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat memperbarui data.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: errorMessages,
                                confirmButtonColor: "#435EBE",
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat memperbarui data.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
