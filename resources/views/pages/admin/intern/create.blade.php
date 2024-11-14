@extends('layouts.app')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    {{-- <div class="page-heading"> --}}
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Pemagang</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Pemagang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{-- {!! Breadcrumbs::render('intern.create') !!} --}}
                    {{ Breadcrumbs::render('intern.create') }}

                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form method="POST" action="{{ route('intern.store') }}" enctype="multipart/form-data"
                                id="formIntern">
                                @csrf
                                <div class="">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="card">

                                                <div class="card-body mt-3">

                                                    <p class="text-uppercase text-sm">User Information</p>

                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="example-text-input"
                                                                    class="form-control-label mb-2">Email address<span
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
                                                                    class="form-control-label  mb-2">Nama Lengkap<span
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
                                                                    class="form-control-label  mb-2">Nama Panggilan<span
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
                                                                    class="form-control-label  mb-2">No Telephone<span
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
                                                                    class="form-control-label  mb-2">Jenis Kelamin<span
                                                                        class="text-danger"> *</span></label>



                                                                <select
                                                                    class="form-select  @error('gender') is-invalid @enderror"
                                                                    name="gender">

                                                                    <option value="" selected disabled>Pilih Jenis

                                                                        Kelamin</option>

                                                                    <option value="male"
                                                                        {{ old('gender') == 'male' ? 'selected' : '' }}>Laki -

                                                                        Laki</option>

                                                                    <option value="female"
                                                                        {{ old('gender') == 'female' ? 'selected' : '' }}>

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
                                                                    class="form-control-label mb-2">Asal Sekolah<span
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
                                                                    class="form-control-label mb-2">Jurusan / Prodi<span
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
                                                                    class="form-control-label mb-2">Alamat<span
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
                                                                    class="form-control-label mb-2">Posisi<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id">

                                                                    <!-- Ubah 'position' menjadi 'position_id' -->

                                                                    <option value="" selected disabled>Pilih Posisi Magang</option>

                                                                    {{-- @foreach ($activePositions as $position)
                                                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                                    @endforeach --}}

                                                                    @foreach ($positions as $position)
                                                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                                    @endforeach

                                                                </select>

                                                                @error('position_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="example-text-input"
                                                                    class="form-control-label mb-2">Periode<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('periode_id') is-invalid @enderror"
                                                                    name="periode_id">

                                                                    <option value="" selected disabled>Pilih Periode</option>

                                                                    @foreach ($periodes as $periode)
                                                                        <option value="{{ $periode->id }}">{{ $periode->name }}</option>
                                                                    @endforeach

                                                                </select>

                                                                @error('position_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>
                                                        {{-- <input type="number" name="periode_id" value=""> --}}

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="example-text-input"
                                                                    class="form-control-label mb-2">Tanggal Mulai<span
                                                                        class="text-danger"> *</span></label>

                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control flatpickr-no-config @error('start_date') is-invalid @enderror"
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
                                                                    class="form-control-label mb-2">Tanggal Selesai<span
                                                                        class="text-danger"> *</span></label>

                                                                <div class="input-group date">

                                                                    <input type="date" id="end_date"
                                                                        class="form-control  flatpickr-no-config  @error('end_date') is-invalid @enderror"
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

                                                                <label for="fileCV"
                                                                    class="form-control-label mb-2">CV<span
                                                                        class="text-danger"> *</span></label>

                                                                <div class="custom-file">

                                                                    <input
                                                                        class="form-control @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png">

                                                                </div>

                                                                @error('cv')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="fileMotivation"
                                                                    class="form-control-label mb-2">Motivation Letter<span
                                                                        class="text-danger"> *</span></label>

                                                                <div class="custom-file">

                                                                    <input
                                                                        class="form-control @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png">

                                                                </div>

                                                                @error('motivation_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="fileSurat"
                                                                    class="form-control-label mb-2">Surat

                                                                    Pengantar</label>

                                                                <div class="custom-file">

                                                                    <input
                                                                        class="form-control @error('cover_letter') is-invalid @enderror"
                                                                        type="file" id="fileSurat" name="cover_letter"
                                                                        accept=".pdf, .docx, .png">



                                                                </div>

                                                                @error('cover_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="fileSurat"
                                                                    class="form-control-label  mb-2">Portfolio<span
                                                                        class="text-danger"> *</span></label>

                                                                <div class="custom-file">

                                                                    <input
                                                                        class="form-control @error('portfolio') is-invalid @enderror"
                                                                        type="file" id="filePortfolio"
                                                                        name="portfolio" accept=".pdf, .docx, .png">



                                                                </div>

                                                                @error('portfolio')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">

                                                                <label for="filefoto" class="form-control-label mb-2">Pas

                                                                    Foto<span class="text-danger"> *</span></label>

                                                                <div class="custom-file">

                                                                    <input
                                                                        class="form-control @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".jpg, .jpeg, .png, .webp">



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

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit"
                                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                                        <button onclick="window.history.back();"
                                                            class="btn btn-light-secondary me-1 mb-1">Back</button>
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
        $(document).ready(function() {
            $('select[name="position_id"]').on('change', function() {
                var positionId = $(this).val();

                $.ajax({
                    url: '{{ route('get.periode.id', ':positionId') }}'.replace(':positionId', positionId),
                    type: 'GET',
                    success: function(response) {
                        $('input[name="periode_id"]').val(response.periode_id);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            var today = new Date();
            today.setHours(0, 0, 0, 0);

            endDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate) {

                    Swal.fire({

                        icon: 'error',

                        title: 'Oopss...',

                        text: 'Tanggal selesai harus setelah tanggal mulai',

                        confirmButtonText: 'Ok'

                    });

                    endDateInput.value = '';

                }
                //  else if (endDate < today) {

                //     Swal.fire({

                //         icon: 'error',

                //         title: 'Oopss...',

                //         text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',

                //         confirmButtonText: 'Ok'

                //     });



                //     endDateInput.value = '';

                // }

            });

            // startDateInput.addEventListener('change', function() {

            //     // Parse tanggal mulai ke dalam objek Da
            //     var startDate = new Date(startDateInput.value);



            //     // Bandingkan tanggal mulai dengan tanggal hari ini

            //     if (startDate < today) {

            //         Swal.fire({

            //             icon: 'error',

            //             title: 'Oopss...',

            //             text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',

            //             confirmButtonText: 'Ok'

            //         });



            //         startDateInput.value = '';

            //     }

            // });

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
