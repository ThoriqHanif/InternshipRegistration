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
                <h3>Daftar Tugas</h3>
                <p class="text-subtitle text-muted">Berikut daftar Tugas dan Pembobotan </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Tugas</li>
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
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Tugas" data-bs-toggle="modal"
                        data-bs-target="#createTask">
                        + Tambah Tugas
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover" id="tableTask">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Nama</th>
                                <th>Bobot</th>
                                <th class="table-fit">Teknis</th>
                                <th class="table-fit">Non Teknis</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </section>

        @include('pages.admin.task.create')
        @include('pages.admin.task.show')
        @include('pages.admin.task.edit')

        @push('table-task')
            {{-- Datatable --}}
            <script>
                let tableTask = new DataTable('#tableTask', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('tasks.index') }}",
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
                            class: 'table-fit'
                        },
                        {
                            data: 'weight',
                            name: 'weight',
                            render: function(data) {
                                return parseFloat(data).toFixed(data % 1 === 0 ? 0 : 2) + ' %';
                            }
                        },
                        {
                            data: 'has_technical_aspects',
                            name: 'has_technical_aspects',
                            class: 'table-fit',
                            render: function(data) {
                                let isChecked = (data === "1" || data === 1 || data === true);

                                return `
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input form-check-glow form-check-primary" name="has_technical_aspects" id="has_technical_aspects" value="1" ${isChecked ? 'checked disabled' : 'disabled'}>
                                    </div>
                                `;
                            }
                        },
                        {
                            data: 'has_non_technical_aspects',
                            name: 'has_non_technical_aspects',
                            class: 'table-fit',
                            render: function(data) {
                                let isChecked = (data === "1" || data === 1 || data === true);

                                return `
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input form-check-glow form-check-primary" name="has_non_technical_aspects" id="has_non_technical_aspects" value="1" ${isChecked ? 'checked disabled' : 'disabled'}>
                                    </div>
                                `;
                            }
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
                    $("#formTask").on("submit", function(e) {
                        e.preventDefault();
                        $('#formTask').modal('hide');

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
                            url: '{{ route('tasks.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formTask')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableTask').DataTable().ajax.reload();
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

            {{-- Detail --}}
            <script>
                $(document).ready(function() {
                    $('#tableTask').on('click', 'a.detail-task', function() {
                        var id = $(this).data('task-id');

                        $.ajax({
                            url: '{{ route('tasks.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#id').val(response.result.id);
                                $('#name_detail').text(response.result.name);
                                $('#weight_detail').text(parseFloat(response.result.weight).toFixed(
                                    response.result.weight % 1 === 0 ? 0 : 2) + ' %');
                                $('#has_technical_aspect_detail').text(
                                    (response.result.has_technical_aspects === "1" || response.result.has_technical_aspects === 1 || response.result.has_technical_aspects === true) ? 'Ya' : 'Tidak'
                                );
                                $('#has_non_technical_aspect_detail').text(
                                    (response.result.has_non_technical_aspects === "1" || response.result.has_non_technical_aspects === 1 || response.result.has_non_technical_aspects === true) ? 'Ya' : 'Tidak'
                                );

                                $('#created_at_detail').text(response.result.created_at_formatted);
                                $('#updated_at_detail').text(response.result.updated_at_formatted);
                                $('#detailTask').modal('show');
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
                    $('#tableTask').on('click', 'a.edit-task', function() {
                        var id = $(this).data('task-id');

                        $.ajax({
                            url: '{{ route('tasks.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editTask').modal('show');
                                $('#task_id').val(response.result.id);
                                $('#name_edit').val(response.result.name);
                                $('#weight_edit').val(parseFloat(response.result.weight).toFixed(response.result.weight % 1 === 0 ? 0 : 2) );
                                $('#has_technical_aspect_edit').prop('checked',
                                    (response.result.has_technical_aspects === "1" || response.result.has_technical_aspects === 1 || response.result.has_technical_aspects === true)
                                );

                                $('#has_non_technical_aspect_edit').prop('checked',
                                    (response.result.has_non_technical_aspects === "1" || response.result.has_non_technical_aspects === 1 || response.result.has_non_technical_aspects === true)
                                );

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {
                    let taskId = $('#task_id').val();
                    var var_url = '{{ route('tasks.update', ':taskId') }}'.replace(':taskId', taskId);
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
                            weight: $('#weight_edit').val(),
                            has_technical_aspects: $('#has_technical_aspect_edit').is(':checked') ? true : false,
                            has_non_technical_aspects: $('#has_non_technical_aspect_edit').is(':checked') ? true : false,
                        },
                        success: function(response) {

                            Swal.close();

                            if (response.errors) {
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

                                $('#tableTask').DataTable().ajax.reload(null, false);

                                $('#editTask').modal('hide');

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

            {{-- Checkbox --}}
        @endpush
    @endsection
