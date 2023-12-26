@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah pemagang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item active">Intern Management</li>
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
                                <h3 class="card-title">Form Tambah Pemagang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('intern.store') }}" enctype="multipart/form-data"
                                id="formIntern">
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
                                                                    class="form-control-label">Nama Lengkap<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('full_name') is-invalid @enderror"
                                                                    type="text" value="" name="full_name"
                                                                    placeholder="Masukkan Nama Lengkap">
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Panggilan<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    type="text" value="" name="username"
                                                                    placeholder="Masukkan Nama Panggilan">
                                                                @error('username')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">No Telephone<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    type="number" value="" name="phone_number"
                                                                    placeholder="Masukkan Telp">
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jenis Kelamin<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('gender') is-invalid @enderror"
                                                                    name="gender">
                                                                    <option value="" selected disabled>Pilih Jenis
                                                                        Kelamin</option>
                                                                    <option value="L"
                                                                        {{ old('gender') == 'L' ? 'selected' : '' }}>Laki -
                                                                        Laki</option>
                                                                    <option value="P"
                                                                        {{ old('gender') == 'P' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                </select>

                                                                @error('gender')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">School Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Asal Sekolah<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('school') is-invalid @enderror"
                                                                    type="text" value="" name="school"
                                                                    placeholder="Masukkan Asal Sekolah">
                                                                @error('school')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jurusan / Prodi<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    type="text" value="" name="major"
                                                                    placeholder="Masukkan Jurusan">
                                                                @error('major')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Contact Information</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Alamat<span
                                                                        class="text-danger"> *</span></label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text" value="" name="address"
                                                                    placeholder="Masukkan Alamat"></textarea>
                                                                @error('address')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Intern Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Posisi<span
                                                                        class="text-danger"> *</span></label>
                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id">
                                                                    <!-- Ubah 'position' menjadi 'position_id' -->
                                                                    <option value="" selected disabled>Pilih Posisi
                                                                        Magang</option>
                                                                    @foreach ($activePositions as $position)
                                                                        <option value="{{ $position->id }}">
                                                                            {{ $position->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('position_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <input type="" name="periode_id" value="">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Mulai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control @error('start_date') is-invalid @enderror"
                                                                        id="start_date" name="start_date" />
                                                                    @error('start_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Selesai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date">
                                                                    <input type="date" id="end_date"
                                                                        class="form-control  @error('end_date') is-invalid @enderror"
                                                                        id="end_date" name="end_date" />
                                                                    @error('end_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">File Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileCV" class="form-control-label">CV<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>
                                                                @error('cv')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileMotivation"
                                                                    class="form-control-label">Motivation Letter<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>
                                                                @error('motivation_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat" class="form-control-label">Surat
                                                                    Pengantar</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('cover_letter') is-invalid @enderror"
                                                                        type="file" id="fileSurat" name="cover_letter"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>
                                                                @error('cover_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat"
                                                                    class="form-control-label">Portfolio<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('portfolio') is-invalid @enderror"
                                                                        type="file" id="filePortfolio"
                                                                        name="portfolio" accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>
                                                                @error('portfolio')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefoto" class="form-control-label">Pas
                                                                    Foto<span class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".jpg, .jpeg, .png, .webp">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>
                                                                @error('photo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12" hidden>
                                                                <div class="form-group">
                                                                    <label for="example-text-input"
                                                                        class="form-control-label">messages<span
                                                                            class="text-danger"> *</span></label>
                                                                    <textarea class="form-control @error('messages') is-invalid @enderror" type="text" value=""
                                                                        name="messages" placeholder="Masukkan Alamat">Terimakasih telah mendaftarkan diri magang di Kadang Koding Indonesia. Data anda sedang kami proses.</textarea>
                                                                    @error('messages')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="form-control invisible" value="pending"
                                                                id="status" name="status">

                                                        </div>
                                                        
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        <button type="submit"
                                                            class="btn btn-md btn-success">Simpan</button>
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
        $(document).ready(function () {
            // Event handler ketika posisi dipilih
            $('select[name="position_id"]').on('change', function () {
                var positionId = $(this).val();
                console.log(positionId);
    
                // Lakukan AJAX request untuk mendapatkan periode_id
                $.ajax({
                    url: '{{ route("get.periode.id", ":positionId") }}'.replace(':positionId', positionId),
                    type: 'GET',
                    success: function (response) {
                        // Set nilai periode_id sesuai dengan hasil dari server
                        $('input[name="periode_id"]').val(response.periode_id);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan elemen input tanggal mulai dan tanggal selesai
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            // Parse tanggal hari ini
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Atur jam ke tengah malam

            // Tambahkan event listener pada perubahan input tanggal selesai
            endDateInput.addEventListener('change', function() {
                // Parse tanggal mulai dan tanggal selesai ke dalam objek Date
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                // Bandingkan tanggal dan lakukan validasi
                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                }
            });

            // Tambahkan event listener pada perubahan input tanggal mulai
            startDateInput.addEventListener('change', function() {
                // Parse tanggal mulai ke dalam objek Date
                var startDate = new Date(startDateInput.value);

                // Bandingkan tanggal mulai dengan tanggal hari ini
                if (startDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    startDateInput.value = '';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formIntern").on("submit", function(e) {
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
                    url: '{{ route('intern.store') }}',
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
                                window.location.href = '{{ route('intern.index') }}';
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
                                Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data',
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
                            Swal.fire('Gagal', 'Terjadi kesalahan saat simpan data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
@endsection
