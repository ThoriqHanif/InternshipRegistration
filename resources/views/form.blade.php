@extends('layouts.form')

@section('content')
<div class="content-wrapper mx-auto">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <h1>Form Pendaftaran</h1>
          </div>
          @include('components.alert-form')
          
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
                <h3 class="card-title">Form Daftar Pemagang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{url ('/')}}" enctype="multipart/form-data" id="formRegist">
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
                                                <label for="example-text-input" class="form-control-label">Email address<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" placeholder="Masukkan Email">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('full_name') is-invalid @enderror" type="text" value="{{ old('full_name') }}" name="full_name" placeholder="Masukkan Nama Lengkap">
                                                @error('full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Panggilan<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('username') is-invalid @enderror" type="text" value="{{ old('username') }}" name="username" placeholder="Masukkan Nama Panggilan">
                                                @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">No Telephone<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('phone_number') is-invalid @enderror" type="number" value="{{ old('phone_number') }}" name="phone_number" placeholder="Masukkan Telp">
                                                @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jenis Kelamin<span class="text-danger"> *</span></label>
                                                
                                                <select class="form-select form-control @error('gender') is-invalid @enderror" name="gender"> 
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                                                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                                <label for="example-text-input" class="form-control-label">Asal Sekolah<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('school') is-invalid @enderror" type="text" value="{{ old('school') }}" name="school" placeholder="Masukkan Asal Sekolah">
                                                @error('school')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jurusan / Prodi<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('major') is-invalid @enderror" type="text" value="{{ old('major') }}" name="major" placeholder="Masukkan Jurusan">
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
                                                <label for="example-text-input" class="form-control-label">Alamat<span class="text-danger"> *</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text"
                                                    value="" name="address" placeholder="Masukkan Alamat">{{ old('address') }}</textarea>
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
                                                <label for="example-text-input" class="form-control-label">Posisi<span class="text-danger"> *</span></label>
                                                <select class="form-select form-control @error('position_id') is-invalid @enderror" name="position_id"> <!-- Ubah 'position' menjadi 'position_id' -->
                                                    <option value="" selected disabled>Pilih Posisi Magang</option>
                                                    @foreach ($position as $position)
                                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Tanggal Mulai<span class="text-danger"> *</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" id="start_date" class=" form-control @error('start_date') is-invalid @enderror" id="date" name="start_date" value="{{ old('start_date') }}"/>
                                                    @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Tanggal Selesai<span class="text-danger"> *</span></label>
                                                <div class="input-group date" >
                                                    <input type="date" id="end_date" value="{{ old('end_date') }}" class="form-control  @error('end_date') is-invalid @enderror" id="date" name="end_date"/>
                                                    @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
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
                                                <label for="fileCV" class="form-control-label">CV<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('cv') is-invalid @enderror" type="file" id="fileCV" name="cv" value="{{ old('cv') }}" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileCV">Choose file</label>
                                                </div>
                                                @error('cv')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileMotivation" class="form-control-label">Motivation Letter<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('motivation_letter') is-invalid @enderror" type="file" value="{{ old('motivation_letter') }}" id="fileMotivation" name="motivation_letter" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileCV">Choose file</label>
                                                </div>
                                                @error('motivation_letter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileSurat" class="form-control-label">Surat Pengantar</label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input optional @error('cover_letter') is-invalid @enderror" type="file" id="fileSurat" value="{{ old('cover_letter') }}" name="cover_letter" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div> 
                                                @error('cover_letter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileSurat" class="form-control-label">Portfolio<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('portfolio') is-invalid @enderror" type="file" id="filePortfolio" value="{{ old('portfolio') }}" name="portfolio" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                @error('portfolio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="filefoto" class="form-control-label">Pas Foto<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('photo') is-invalid @enderror" type="file" id="filefoto" name="photo" value="{{ old('photo') }}" accept=".jpg, .jpeg, .png, .webp">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <input class="form-control invisible" value="pending" id="status" name="status">
                                                
                                            </div>
                                    </div>
                                    <div class="inline-block mt-3">
                                        <button type="submit" id="submitButton" class="btn btn-md btn-success">
                                            
                                            Simpan
                                        </button>
        
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
        $("#formRegist").on("submit", function(e) {
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
                url: '{{ route('store') }}',
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
                            text: 'Data berhasil disimpan. Data akan kami proses secepatnya, Terimakasih.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('index') }}';
                        });
                    }
                    else {
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include jQuery and Bootstrap Datepicker (Adjust the paths accordingly) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

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




{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitButton = document.getElementById('submitButton');

    submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah proses default pengiriman formulir

        Swal.fire({
            title: 'Saving your data...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });

        // Handle pengiriman formulir dengan cara asinkron (gunakan AJAX)
        const formData = new FormData(form);
        fetch(form.getAttribute('action'), {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            Swal.close(); // Sembunyikan pop-up loading

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil dikirim.',
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            }
        })
        .catch(error => {
            Swal.close(); // Sembunyikan pop-up loading

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat mengirim data.',
            });
        });
    });
});

</script> --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');

        submitButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Saving your data...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });

            // Handle pengiriman formulir dengan cara asinkron
            const formData = new FormData(form);
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Sembunyikan pop-up loading

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data berhasil dikirim.',
                    });

                    // Redirect ke halaman tertentu jika diperlukan
                    // window.location.href = '/success-page';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data.',
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Sembunyikan pop-up loading

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            });
        });
    });
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');

        submitButton.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir langsung

            Swal.fire({
                title: 'Menyimpan data...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });

            // Izinkan formulir untuk disubmit
            form.submit();
        });
    });
</script> --}}


{{-- !!!!! --}}

    {{-- <script>$(document).ready(function () {
        $("#registrationForm").on("submit", function (e) {
            e.preventDefault();
    
            // Nonaktifkan form saat proses pengiriman data
            $("#registrationForm").off("submit");
    
            // Tampilkan alert "loading" saat proses AJAX
            Swal.fire({
                title: 'Please Wait!',
                html: 'Uploading data...',
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
                success: function (response) {
                    // Sembunyikan alert "loading" saat sukses
                    Swal.close();
                    if (response.success) {
                        // Tampilkan alert "success" jika penyimpanan berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Good Job!',
                            text: 'Data berhasil disimpan. Terimakasih telah mendaftar di Kadang Koding Indonesia',
                        });
                    } else {
                        // Tampilkan alert "error" jika ada kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: 'Terjadi kesalahan saat menyimpan data.',
                        });
                    }
                },
                error: function () {
                    // Tampilkan alert "error" jika terjadi kesalahan saat melakukan AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });
        });
    });
    </script> --}}


{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitButton = document.getElementById('submitButton');

    submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir langsung

        // Validasi input
        

        Swal.fire({
            title: 'Please Wait!',
            html: 'Uploading data...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            },
        });

        setTimeout(function() {
                form.submit(); // Submit the form after the delay
            }, 1000);

        // Tunggu hingga halaman selesai dimuat
        window.addEventListener('load', function() {
            // Mengirim permintaan AJAX
            const formData = new FormData(form);
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Sembunyikan pop-up loading

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Sembunyikan pop-up loading

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            });
        });
    });
});


</script> --}}


{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
    
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir langsung
    
            // Kirim formulir menggunakan AJAX
            const formData = new FormData(form);
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                Swal.close(); // Sembunyikan pop-up loading
    
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Good Job!',
                        text: 'Data berhasil disimpan. Terimakasih telah mendaftarkan di Kadang Koding Indonesia',
                    });
    
                    // Redirect atau lakukan tindakan lain setelah berhasil disimpan
                    // window.location.href = '/success-page';
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            })
            .catch(error => {
                Swal.close(); // Sembunyikan pop-up loading
    
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            });
        });
    });
</script> --}}


{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir langsung

            // Kirim formulir menggunakan AJAX
            const formData = new FormData(form);
            fetch(form.getAttribute('action'), {
                method: 'POST',
                body: formData,
            })
            .then(() => {
                Swal.close(); // Sembunyikan pop-up loading

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Terimakasih telah mendaftar, Pendaftaran segera kami proses',
                });

                // Redirect atau lakukan tindakan lain setelah berhasil disimpan
                // window.location.href = '/success-page';
            })
            .catch(() => {
                Swal.close(); // Sembunyikan pop-up loading

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data.',
                });
            });
        });
    });
</script> --}}



    

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');

        submitButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Saving your data...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                },
            });

            // Handle pengiriman formulir dengan cara asinkron
            form.submit();

            // Tambahkan event listener untuk menangani respons setelah formulir terkirim
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman formulir langsung

                // Lakukan pengiriman formulir menggunakan fetch atau AJAX
                const formData = new FormData(form);
                fetch(form.getAttribute('action'), {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close(); // Sembunyikan pop-up loading

                    if (data.success) {
                        // Tampilkan alert kesuksesan dengan SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil dikirim.',
                        });

                        // Redirect ke halaman tertentu jika diperlukan
                        // window.location.href = '/success-page';
                    } else {
                        // Tampilkan alert kesalahan dengan SweetAlert2
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data.',
                        });
                    }
                })
                .catch(error => {
                    Swal.close(); // Sembunyikan pop-up loading

                    // Tampilkan alert kesalahan jika terjadi error saat mengirim data
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data.',
                    });
                });
            });
        });
    });
</script> --}}

    