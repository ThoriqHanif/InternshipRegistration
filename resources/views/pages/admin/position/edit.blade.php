@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Posisi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
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
                                <h3 class="card-title">Form Edit Posisi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('position.update', $id) }}" id="formEditPosition">
                                @csrf
                                @method('PUT')
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
                                                                    type="text" value="{{ $name }}"
                                                                    name="name" placeholder="Masukkan Nama">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefimage" class="form-control-label">Gambar
                                                                    <span class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                                        type="file" id="fileimage" name="image"
                                                                        accept=".jpg, .jpeg, .png, .webp">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($imageUrl)
                                                                    <a data-fancybox data-caption="Gambar Posisi "
                                                                        href="{{ $imageUrl }}">
                                                                        <img src="{{ $imageUrl }}" class="mt-3"
                                                                            alt="Gambar Posisi" width="70">
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Gambar</p>
                                                                @endif

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
                                                                    name="description" placeholder="Masukkan Deskripsi">{{ $description }}</textarea>
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
                                                                    class="form-control-label">Syarat<span class="text-danger"> *</span></label>
                                                                <div class="row mt-2">
                                                                    @foreach (['HTML', 'CSS', 'Javascript', 'PHP', 'Laravel', 'Figma', 'Photoshop', 'MySQL', 'Bootstrap'] as $requirement)
                                                                    <div class="col-md-2 mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="requirements[]" value="{{ $requirement }}"
                                                                                id="flexCheckDefault{{ $loop->index + 1 }}"
                                                                                name="requirements[]"
                                                                                @if(in_array($requirement, explode(', ', $requirements))) checked @endif>   
                                                                            <label class="form-check-label">{{ $requirement }}</label><br>
                                                                            @error('requirements')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    @if(($loop->index + 1) % 5 == 0)
                                                                        </div><div class="row">
                                                                    @endif
                                                                    @endforeach
                                                                    
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
        $(document).ready(function() {
            $("#formEditPosition").on("submit", function(e) {
                e.preventDefault();

                var positionId = "{{ $position->id }}";
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
                    url: '{{ route('position.update', ['position' => ':positionId']) }}'.replace(':positionId', positionId),
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
