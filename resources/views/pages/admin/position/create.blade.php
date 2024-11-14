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
                <h3>Tambah Posisi</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Posisi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('position.create') }}
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <form method="POST" action="{{ route('position.store') }}" id="formPosition">
                                @csrf
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body mt-2">
                                                    <p class="text-uppercase text-sm">Position Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span
                                                                        class="text-danger"> *</span></label>
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
                                                                    <div class="col-md-3">
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
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="CSS" id="flexCheckDefault2"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault2">CSS</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="Javascript" id="flexCheckDefault3"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault3">JavaScript</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="PHP" id="flexCheckDefault4"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault4">PHP</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="Laravel" id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Laravel</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="Figma"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Figma</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="Photoshop"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">Photoshop</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="MySQL"
                                                                                id="flexCheckDefault5"
                                                                                name="requirements[]>
                                                    <label class="form-check-label"
                                                                                for="flexCheckDefault5">MySQL</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
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
                                                        <a type="button" class="btn btn-md btn-light-secondary"
                                                            href="{{ route('position.index') }}">Cancel</a>
                                                        <button type="submit" id="submitButton"
                                                            class="btn btn-md btn-primary">Simpan</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="filefoto" class="form-control-label">Gambar<span class="text-danger">
                                                *</span></label>
                                        <div class="custom-file">
                                            <input
                                                class="form-control js-upload-image @error('image') is-invalid @enderror"
                                                type="file" id="filefoto" name="image"
                                                accept="image/*">
                                            <p><small class="text-muted">Maksimal Ukuran Gambar 2
                                                    MB</small></p>
                                        </div>
                                        <img src="" class="img-fluid w-100 mb-1" alt=""
                                            id="upload-img-preview">
                                        <a href="#" class="text-danger" id="upload-img-delete"
                                            style="display: none;">Delete Image</a>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </section>
    </div>

    {{-- Preview Image --}}
    <script>
        $('.js-upload-image').change(function(event) {
            makePreview(this);
            $('#upload-img-preview').show();
            $('#upload-img-delete').show();
        });

        function makePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#upload-img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#upload-img-delete').click(function(event) {
            event.preventDefault();

            $('#upload-img-preview').attr('src', '').hide();
            $('#filefoto').val(null);
            $(this).hide();
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formPosition").on("submit", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('position.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            }).then(function() {
                                window.location.href = '{{ route('position.index') }}';
                            });
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
                                    text: 'Terjadi kesalahan saat menyimpan data.',
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
                                text: 'Terjadi kesalahan saat menyimpan data.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
