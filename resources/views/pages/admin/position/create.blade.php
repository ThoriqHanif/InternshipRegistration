@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Posisi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Position Management</li>
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
                                <h3 class="card-title">Form Tambah Posisi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('position.store') }}" id="formPosition">
                                @csrf
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">Position Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    type="text" value="" name="name"
                                                                    placeholder="Masukkan Nama">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefoto" class="form-control-label">Gambar<span class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input class="custom-file-input @error('image') is-invalid @enderror" type="file" id="filefoto" name="image" accept=".jpg, .jpeg, .png, .webp">
                                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                                </div>
                                                                @error('image')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Deskripsi</label>
                                                                <textarea class="form-control  @error('description') is-invalid @enderror" type="text" value=""
                                                                    name="description" placeholder="Masukkan Deskripsi"></textarea>
                                                                @error('description')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Syarat<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="row mt-2">
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="HTML" id="flexCheckDefault1"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault1">HTML</label><br>
                                                                            @error('requirements')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="CSS" id="flexCheckDefault2"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault2">CSS</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="Javascript" id="flexCheckDefault3"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault3">JavaScript</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="PHP" id="flexCheckDefault4"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault4">PHP</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="Laravel" id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Laravel</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="Figma" id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Figma</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="Photoshop"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Photoshop</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="MySQL"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">MySQL</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="Bootstrap"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Bootstrap</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        <button type="submit" id="submitButton"
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
        $(document).ready(function() {
            $("#formPosition").on("submit", function(e) {
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
                    url: '{{ route('position.store') }}',
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
                                window.location.href = '{{ route('position.index') }}';
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
