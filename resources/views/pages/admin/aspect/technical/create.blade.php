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
                <h3>Tambah Aspek Teknis</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Aspek Teknis</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('technical-aspects.create') }}
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
            </div>
        </section>
        <section class="section">
            <div class="row">
                <form method="POST" action="{{ route('technical-aspects.store') }}" enctype="multipart/form-data"
                    id="formTechnicalAspect">
                    @csrf
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label mb-2">Posisi Magang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="form-select form-control @error('category_id') is-invalid @enderror"
                                                name="position_id">
                                                <option value="" selected disabled>Pilih Posisi
                                                </option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}">
                                                        {{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="type" value="technical">
                                        </div>
                                    </div>

                                </div>
                                <div id="aspect-container">
                                    <div class="row aspect-row">
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label for="aspect_name" class="form-control-label mb-2">Aspek Teknis <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    type="text" name="name[]" placeholder="Masukkan Aspek Teknis"
                                                    required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-3 text-end align-self-center mt-3 mb-0">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="addAspect">+
                                                Tambah Aspek</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-block mt-3">
                                    <a type="button" class="btn btn-md btn-light-secondary"
                                        href="{{ route('technical-aspects.index') }}">Cancel</a>
                                    <button type="submit" class="btn btn-md btn-primary"
                                        id="submitButton">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    @push('script-create-technical-aspect')
        {{-- Add Remove Input --}}
        <script>
            $('#addAspect').click(function() {
                let newAspect = `<div class="row aspect-row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name[]" placeholder="Masukkan Aspek Teknis" required>
                                        </div>
                                    </div>
                                    <div class="col-3 text-end align-self-center">
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm removeAspect">Hapus</a>
                                    </div>
                                </div>`;
                $('#aspect-container').append(newAspect);
            });

            $(document).on('click', '.removeAspect', function() {
                $(this).closest('.aspect-row').remove();
            });
        </script>

        {{-- Save --}}
        <script>
             $(document).ready(function() {
            $("#formTechnicalAspect").on("submit", function(e) {
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
                    url: '{{ route('technical-aspects.store') }}',
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
                                window.location.href = '{{ route('technical-aspects.index') }}';
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
    @endpush
@endsection
