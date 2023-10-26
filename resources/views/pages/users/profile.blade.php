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

                    @foreach ($user->intern as $intern)
                        <div class="col-md-5">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                      @auth
                                      @if (auth()->user()->intern)
                                      <img src="{{ asset('files/photo/' . auth()->user()->intern->first()->photo) }}" class="img-fluid elevation-1 mb-2 rounded" width="200px" height="200px" alt="User Image">
                                      @else
                                          <!-- Tampilkan foto default atau pesan jika tidak ada foto -->
                                          <img src="{{ asset('img/profile1.jpg') }}" class="img-circle elevation-2" alt="User Image">
                                      @endif
                                  @endauth
                                    </div>

                                    <h3 class="profile-username text-center">{{ $intern->full_name }}</h3>

                                    <p class="text-muted text-center">{{ $intern->position->name }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Tanggal Mulai</b> <a
                                                class="float-right text-success">{{ $intern->start_date }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Tanggal Selesai</b> <a
                                                class="float-right text-danger">{{ $intern->end_date }}</a>
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
                                        {{ $intern->full_name }}
                                    </p>

                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-2"></i> Alamat</strong>

                                    <p class="text-muted">{{ $intern->address }}</p>

                                    <hr>

                                    <strong><i class="fas fa-phone mr-2"></i> No Telp</strong>

                                    <p class="text-muted">
                                        {{ $intern->phone_number }}
                                    </p>

                                    <hr>

                                    <strong><i class="fas fa-venus-mars mr-2"></i> Jenis Kelamin</strong>

                                    <p class="text-muted">{{ $intern->gender }}</p>
                                    <hr>
                                    <strong><i class="fas fa-school mr-2"></i> Asal Sekolah</strong>

                                    <p class="text-muted">
                                        {{ $intern->school }}
                                    </p>

                                    <hr>
                                    <strong><i class="fas fa-graduation-cap mr-2"></i> Jurusan / Prodi</strong>

                                    <p class="text-muted">
                                        {{ $intern->major }}
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
                                        <li class="nav-item"><a class="nav-link" href="#settings"
                                                data-toggle="tab">Settings</a></li>
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
                                                            {{ $intern->created_at }}</span>

                                                        <h3 class="timeline-header"><a href="#">Kadang Koding
                                                                Indonesia </a> sent you an message</h3>

                                                        <div class="timeline-body">
                                                            Terimakasih {{ $intern->full_name }} telah mendaftarkan diri
                                                            untuk magang di Kadang Koding Indonesia. Mohon ditunggu untuk
                                                            Update selanjutnya.
                                                        </div>
                                                        <div class="timeline-footer">
                                                            {{-- <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->

                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-envelope bg-success"></i>

                                                    <div class="timeline-item">
                                                        {{-- <span class="time"><i class="far fa-clock"></i> 27 mins ago</span> --}}

                                                        <h3 class="timeline-header"><a href="#">Kadang Koding
                                                                Indonesia </a> sent you an update</h3>

                                                        <div class="timeline-body">
                                                            Hii {{ $intern->full_name }}, terimakasih telah mendaftar
                                                            magang di Kadang Koding Indonesia. Status pendaftaran anda <a
                                                                href="">{{ $intern->status }}</a>
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="#" class="btn btn-primary btn-sm">Lihat
                                                                Laporan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">
                                            <form class="form-horizontal" method="post" action="{{ url('profile') }}" id="formProfileUser">
                                                {{-- @foreach ($user->interns as $intern) --}}
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName"
                                                            placeholder="Name" name="name" value="{{ $name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail"
                                                            name="email" placeholder="Email"
                                                            value="{{ $email }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                        class="col-sm-2 col-form-label">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputPassword"
                                                            name="password" placeholder="Password" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <div class="checkbox">
                                                            <label>
                                                                {{-- <input type="checkbox"> I agree to the <a href="#">terms and conditions</a> --}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
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
                    @endforeach
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

<script>
    $(document).ready(function() {
    $("#formProfileUser").on("submit", function(e) {
                e.preventDefault();
        
                var userId = "{{ $user->id }}";
        
                // Ambil data yang diperlukan dari form
                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var password = $("#inputPassword").val(); // Pastikan Anda memiliki input dengan id "password"
        
                // Inisialisasi variabel yang menunjukkan apakah terjadi perubahan pada email atau password
                var emailChanged = email !== "{{ $user->email }}";
                var passwordChanged = password !== "";
        
                if (name === "{{ $user->name }}" && !emailChanged && !passwordChanged) {
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
                    url: '{{ route('profile.update', ['user' => ':userId']) }}'.replace(':userId', userId),
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
@endsection
