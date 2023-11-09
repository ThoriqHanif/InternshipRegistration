@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Periode</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Periode Management</li>
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
                                <h3 class="card-title">Form Tambah Periode</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('periode.store') }}" enctype="multipart/form-data"
                                id="formPeriode">
                                @csrf
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">Periode Information</p>
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
                                                <label for="example-text-input" class="form-control-label">Tanggal Mulai<span class="text-danger" > *</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" id="start_date" class=" form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date"/>
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
                                                    <input type="date" id="end_date" class="form-control  @error('end_date') is-invalid @enderror" id="end_date" name="end_date"/>
                                                    @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input"
                                                    class="form-control-label">Kuota Pemagang<span
                                                        class="text-danger"> *</span></label>
                                                <input
                                                    class="form-control  @error('quota') is-invalid @enderror"
                                                    type="number" value="" name="quota"
                                                    placeholder="Masukkan Jumlah Kuota">
                                                @error('quota')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input"
                                                    class="form-control-label">Deskripsi</label>
                                                <textarea
                                                    class="form-control  @error('description') is-invalid @enderror"
                                                    type="text" value="" name="description"
                                                    placeholder="Masukkan Deskripsi"></textarea>
                                                @error('description')
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
        $(document).ready(function() {
            $("#formPeriode").on("submit", function(e) {
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
                    url: '{{ route('periode.store') }}',
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
                                window.location.href = '{{ route('periode.index') }}';
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
@endsection
