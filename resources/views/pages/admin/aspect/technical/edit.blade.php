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
                <h3>Edit Aspek Teknis</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk mengubah Aspek Teknis</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('technical-aspects.edit') }}
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
                <form method="POST" action="{{ route('technical-aspects.update', $aspects->id) }}"
                    enctype="multipart/form-data" id="formEditTechnicalAspect">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label mb-2">Posisi Magang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                class="form-select form-control @error('position_id') is-invalid @enderror"
                                                name="position_id">
                                                <option value="" disabled>Pilih Posisi</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ $position->id == $aspects->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
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
                                    <div class="col-md-6">
                                        <h5 class="mt-4 mb-4">Swap Aspek Posisi Magang</h5>
                                        <div class="form-group">
                                            <label for="swap-position-1" class="form-control-label mb-2">Posisi Sekarang
                                            </label>
                                            <select class="form-select form-control" name="swap_position_1"
                                                id="swap-position-1" disabled>
                                                <option value="" disabled selected>Pilih Posisi</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ $position->id == $aspects->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="swap-position-2" class="form-control-label mb-2">Posisi yang
                                                ditukar</label>
                                            <select class="form-select form-control" name="swap_position_2"
                                                id="swap-position-2">
                                                <option value="" disabled selected>Pilih Posisi</option>
                                                @foreach ($positionAll as $position)
                                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary mt-3" id="swapButton">Tukar
                                                Posisi</button>
                                        </div>

                                    </div>
                                </div>
                                <hr>

                                <div id="aspect-container">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="form-group">
                                                    <label for="" class="form-label">Daftar Aspek Teknis</label>
                                                </div>
                                                <div class="text-end float-end">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"
                                                        id="addAspect">+ Tambah Aspek</a>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach ($aspects->technicalAspects as $aspect)
                                            <div class="row aspect-row">
                                                <div class="col-11">
                                                    <div class="form-group">
                                                        <input class="form-control @error('name.*') is-invalid @enderror"
                                                            type="text" name="name[]"
                                                            placeholder="Masukkan Aspek Teknis" value="{{ $aspect->name }}"
                                                            required>
                                                        @error('name.*')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-1 text-end align-self-center">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-danger btn-sm removeAspect"><i
                                                            class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- <div class="row aspect-row">
                                            <div class="col-11">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="name[]"
                                                        placeholder="Masukkan Aspek Teknis" required>
                                                </div>
                                            </div>
                                            <div class="col-1 text-end align-self-center">
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm removeAspect"><i
                                                        class="bi bi-trash"></i></a>
                                            </div>
                                        </div> --}}
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
                                    <div class="col-11">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="name[]" placeholder="Masukkan Aspek Teknis" required>
                                        </div>
                                    </div>
                                    <div class="col-1 text-end align-self-center">
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm removeAspect"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>`;
                $('#aspect-container .row:last').after(newAspect);
            });

            $(document).on('click', '.removeAspect', function() {
                $(this).closest('.aspect-row').remove();
            });
        </script>
        {{-- Swap Position --}}
        <script>
            $(document).ready(function() {
                $('#swapButton').click(function() {
                    const swapPosition1 = $('#swap-position-1').val();
                    const swapPosition2 = $('#swap-position-2').val();

                    if (!swapPosition1 || !swapPosition2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Silakan pilih posisi untuk ditukar.',
                            confirmButtonColor: '#435EBE',
                        });
                        return;
                    }

                    // Konfirmasi sebelum melakukan swap
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda akan menukar posisi aspek!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#435EBE',
                        cancelButtonColor: '#CDD3D8',
                        confirmButtonText: 'Ya, tukar!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
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
                                url: '{{ route('techincal-aspects.positions.swap') }}',
                                method: 'POST',
                                data: {
                                    swap_position_1: swapPosition1,
                                    swap_position_2: swapPosition2,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log(response);

                                    Swal.close();
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: 'Posisi berhasil ditukar.',
                                            confirmButtonText: 'Oke',
                                            confirmButtonColor: "#435EBE",
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        if (response.errors) {
                                            var errorMessages = '';
                                            for (var key in response.errors) {
                                                if (response.errors.hasOwnProperty(key)) {
                                                    errorMessages += response.errors[key][
                                                        0
                                                    ] + '<br>';
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
                        }
                    });
                });
            });
        </script>

        {{-- Update --}}
        <script>
            $(document).ready(function() {
                $("#formEditTechnicalAspect").on("submit", function(e) {
                    e.preventDefault();

                    var aspectId = "{{ $aspect->id }}";

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
                        url: '{{ route('technical-aspects.update', ':aspectId') }}'.replace(
                            ':aspectId', aspectId),
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diperbarui.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    window.location.href =
                                        '{{ route('technical-aspects.index') }}';
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
    @endpush
@endsection
