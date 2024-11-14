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
                <h3>Daftar Aspek Non Teknis</h3>
                <p class="text-subtitle text-muted">Berikut daftar Aspek Non Teknis </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" href="{{ route('aspects.index') }}">Daftar Aspek Penilaian</li>
                        <li class="breadcrumb-item active" aria-current="page">Aspek Non Teknis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a href="{{ route('aspects.index') }}" class="btn btn-primary"><i
                                        class="bi bi-arrow-left me-2"></i> Kembali</a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#createNonTechnicalAspect" class="btn btn-primary"><i
                                        class="bi bi-plus me-2"></i> Tambah Aspek Non Teknis</a>
                            </div>
                            <div class="card-body">
                                <table class="table" id="tableNonTechnicalAspect">
                                    <thead>
                                        <tr>
                                            <th class="table-fit">No</th>
                                            <th>Nama Aspek</th>
                                            <th class="table-fit">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('pages.admin.aspect.non-technical.create')
            @include('pages.admin.aspect.non-technical.show')
            @include('pages.admin.aspect.non-technical.edit')

        </section>
    </div>

    @push('table-non-technical-aspect')
        <script>
            let tableNonTechnicalAspect = new DataTable('#tableNonTechnicalAspect', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('non-technical-aspects.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit'
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'table-fit',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        </script>

        {{-- Create --}}
        <script>
            $(document).ready(function() {
                $("#formNonTechnicalAspect").on("submit", function(e) {
                    e.preventDefault();
                    $('#createNonTechnicalAspect').modal('hide');

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
                        url: '{{ route('non-technical-aspects.store') }}',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                $('#formNonTechnicalAspect')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disimpan.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    $('#tableNonTechnicalAspect').DataTable().ajax
                                        .reload();
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

        {{-- Detail Aspek --}}
        <script>
            $(document).ready(function() {
                $('#tableNonTechnicalAspect').on('click', 'a.detail-aspect', function() {
                    var id = $(this).data('aspect-id');

                    $.ajax({
                        url: '{{ route('non-technical-aspects.show', ':id') }}'.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('#id_detail').text(response.result.id);
                            $('#name_detail').text(response.result.name);
                            $('#created_at_detail').text(response.result.created_at_formatted);
                            $('#updated_at_detail').text(response.result.updated_at_formatted);

                            $('#detailTechnicalAspect').modal('show');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>

        {{-- Edit --}}
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                $('#tableNonTechnicalAspect').on('click', 'a.edit-aspect', function() {
                    var id = $(this).data('aspect-id');

                    $.ajax({
                        url: '{{ route('non-technical-aspects.edit', ':id') }}'.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('#aspect_id').val(response.result.id);
                            $('#name_edit').val(response.result.name);
                            $('#type_edit').val(response.result.type);
                            $('#editNonTechnicalAspect').modal('show');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

            $(document).on('click', '.btn-update', function(e) {
                let aspectId = $('#aspect_id').val();
                var var_url = '{{ route('non-technical-aspects.update', ':aspectId') }}'.replace(':aspectId', aspectId);
                var var_type = 'PUT';

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
                    url: var_url,
                    type: var_type,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: $('#name_edit').val(),
                        type: $('#type_edit').val(),
                    },
                    success: function(response) {
                        Swal.close();

                        if (response.errors) {
                            console.log(response.errors);

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            });


                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            });

                            $('#tableNonTechnicalAspect').DataTable().ajax.reload(null, false);

                            $('#editNonTechnicalAspect').modal('hide');

                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Menampilkan pesan validasi error SweetAlert
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                html: errorMessages,
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat update data.',
                            });
                        }
                    },
                });
                // }
            });
        </script>
    @endpush
@endsection
