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
                <h3>Edit Posisi</h3>
                <p class="text-subtitle text-muted">Masukkan data yang ingin diubah Informasi Pemagang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('position.index') }}">Posisi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Posisi</li>
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('position.update', $id) }}" id="formEditPosition">
                                @csrf
                                @method('PUT')
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
                                                                    type="text" value="{{ $name }}"
                                                                    name="name" placeholder="Masukkan Nama">
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
                                                                    class="form-control-label">Syarat<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="row mt-2">
                                                                    @foreach (['HTML', 'CSS', 'Javascript', 'PHP', 'Laravel', 'Figma', 'Photoshop', 'MySQL', 'Bootstrap'] as $requirement)
                                                                        <div class="col-md-2 mb-2">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox" name="requirements[]"
                                                                                    value="{{ $requirement }}"
                                                                                    id="flexCheckDefault{{ $loop->index + 1 }}"
                                                                                    name="requirements[]"
                                                                                    @if (in_array($requirement, explode(', ', $requirements))) checked @endif>
                                                                                <label
                                                                                    class="form-check-label">{{ $requirement }}</label><br>
                                                                                @error('requirements')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        @if (($loop->index + 1) % 5 == 0)
                                                                </div>
                                                                <div class="row">
                                                                    @endif
                                                                    @endforeach

                                                                </div>
                                                                <div class="inline-block mt-3">
                                                                    <a type="button" class="btn btn-md btn-secondary"
                                                                        href="{{ route('position.index') }}">Cancel</a>
                                                                    <button type="submit"
                                                                        class="btn btn-md btn-primary">Simpan</button>


                                                                </div>

                                                            </div>
                                                        </div>
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
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="filefimage" class="form-control-label">Gambar
                                            <span class="text-danger"> *</span></label>
                                        <div class="custom-file mb-2">
                                            <input class="form-control js-upload-image @error('image') is-invalid @enderror" type="file"
                                                id="fileimage" name="image" accept="image/*">
                                        </div>
                                        <img src="" class="img-fluid w-100 mb-1" alt=""
                                            id="upload-img-preview">
                                        <a href="#" class="text-danger" id="upload-img-delete"
                                            style="display: none;">Delete Image</a>

                                        @if ($imageUrl)
                                            <a data-fancybox data-caption="Gambar Posisi " href="{{ $imageUrl }}" id="fancybox">
                                                <img src="{{ $imageUrl }}" class="mt-3" alt="Gambar Posisi"
                                                    width="70">
                                            </a>
                                        @else
                                            <p class="text-sm text-danger">Belum ada Gambar</p>
                                        @endif

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
        </section>
    </div>

    {{-- Preview Image --}}
    <script>
        $('.js-upload-image').change(function(event) {
            makePreview(this);
            $('#upload-img-preview').show();
            $('#upload-img-delete').show();
            $('#fancybox').hide();
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
            $('#fileimagedb').val(null);
            $('#fancybox').show();

            $(this).hide();
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formEditPosition").on("submit", function(e) {
                e.preventDefault();

                var positionId = "{{ $position->id }}";

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
                    url: '{{ route('position.update', ['position' => ':positionId']) }}'.replace(
                        ':positionId', positionId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
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
