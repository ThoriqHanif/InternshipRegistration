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
                <h3>Daftar Penilai</h3>
                <p class="text-subtitle text-muted">Berikut daftar Penilai </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Penilai</li>
                    </ol>
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
        <section class="section mt-2">
            <div class="card">
                <div class="card-header mb-2 justify-content-end"
                    style="display: flex; align-items: center; justify-content: space-between;">

                    <button class="btn btn-sm btn-primary tombol-create float-right text-end" data-placement="top"
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Penilai" data-bs-toggle="modal"
                        data-bs-target="#createEvaluator">
                        + Tambah Penilai
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    <table class="table table-hover" id="tableEvaluator">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th>Nama</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @include('pages.admin.evaluator.create')
        @include('pages.admin.evaluator.show')
        @include('pages.admin.evaluator.edit')

        @push('table-evaluators')
            <script>
                let tableEvaluator = new DataTable('#tableEvaluator', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('evaluators.index') }}",
                        // type: 'GET'
                    },
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
                            class: 'table-fit'
                        },


                    ]
                });
            </script>

            {{-- Create --}}
            <script>
                $(document).ready(function() {
                    $("#formEvaluator").on("submit", function(e) {
                        e.preventDefault();
                        $('#createEvaluator').modal('hide');


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
                            url: '{{ route('evaluators.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formEvaluator')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableEvaluator').DataTable().ajax
                                            .reload();
                                    });
                                } else {
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

            {{-- Detail --}}
            <script>
                $(document).ready(function() {
                    $('#tableEvaluator').on('click', 'a.detail-evaluator', function() {
                        var id = $(this).data('evaluator-id');

                        $.ajax({
                            url: '{{ route('evaluators.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                console.log(response.result);
                                $('#detailEvaluator').modal('show');
                                $('#id').val(response.result.id);
                                $('#name_detail').text(response.result.name);
                                $('#created_at_detail').text(response.result.created_at_formatted);
                                $('#updated_at_detail').text(response.result.updated_at_formatted);
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
                    $('#tableEvaluator').on('click', 'a.edit-evaluator', function() {

                        var id = $(this).data('evaluator-id');
                        console.log(id);

                        $.ajax({
                            url: '{{ route('evaluators.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editEvaluator').modal('show');
                                $('#evaluator_id').val(response.result.id);
                                $('#name_edit').val(response.result.name);

                                // Clear the existing options and append new ones with selected

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let evaluatorId = $('#evaluator_id').val();
                    var var_url = '{{ route('evaluators.update', ':evaluatorId') }}'.replace(':evaluatorId', evaluatorId);
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

                                $('#tableEvaluator').DataTable().ajax.reload(null, false);

                                $('#editEvaluator').modal('hide');
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
