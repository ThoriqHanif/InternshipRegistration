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
                <h3>Daftar Pelanggan</h3>
                <p class="text-subtitle text-muted">Berikut daftar Pelanggan </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('subscriptions') }}">Pelanggan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Pelanggan</li>
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
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Kategori" data-bs-toggle="modal"
                        data-bs-target="#createSubscriptions">
                        + Tambah Pelanggan
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm" id="tableSubscriptions">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                {{-- <th classs="table-fit">Nama</th> --}}
                                <th>Email</th>
                                <th class="table-fit">Status</th>
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

        @include('pages.admin.subscription.create')
        @include('pages.admin.subscription.show')
        @include('pages.admin.subscription.edit')

        @push('table-subscriptions')
            <script>
                let tableSubscriptions = new DataTable('#tableSubscriptions', {
                    "createdRow": function(row, data, dataIndex) {
                        let badgeClass = '';
                        let textColor = 'text-white';

                        if (data['status'] === 1) {
                            badgeClass = 'bg-success';
                            data['status'] = 'Aktif';
                        } else if (data['status'] === 0) {
                            badgeClass = 'bg-danger';
                            data['status'] = 'Nonaktif';
                        }

                        $(row).find('td:eq(2)').html('<span class="badge text-capitalize text-white px-2 ' +
                            badgeClass + ' ' + textColor + '">' + data['status'] + '</span>');
                    },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('subscriptions.index') }}",
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
                            data: 'email',
                            name: 'email',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                return data == 1 ? 'Aktif' : 'Nonaktif';
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
                    $("#formSubscriptions").on("submit", function(e) {
                        e.preventDefault();
                        $('#createSubscriptions').modal('hide');


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
                            url: '{{ route('subscriptions.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formSubscriptions')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableSubscriptions').DataTable().ajax
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

            {{-- Detail --}}
            <script>
                $(document).ready(function() {
                    $('#tableSubscriptions').on('click', 'a.detail-subscription', function() {
                        var id = $(this).data('subscription-id');

                        $.ajax({
                            url: '{{ route('subscriptions.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                console.log(response.result);
                                $('#detailSubscriptions').modal('show');
                                $('#id').val(response.result.id);
                                $('#email_detail').text(response.result.email);
                                var statusText = response.result.status === 1 ? 'Aktif' : 'Nonaktif';
                                $('#status_detail').text(statusText);
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
                    $('#tableSubscriptions').on('click', 'a.edit-subscription', function() {

                        var id = $(this).data('subscription-id');
                        console.log(id);

                        $.ajax({
                            url: '{{ route('subscriptions.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editSubscriptions').modal('show');
                                $('#subscription_id').val(response.result.id);
                                $('#email_edit').val(response.result.email);
                                $('#status_edit').val(response.result.status);

                                // Clear the existing options and append new ones with selected

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let subscriptionsId = $('#subscription_id').val();
                    var var_url = '{{ route('subscriptions.update', ':subscriptionsId') }}'.replace(
                        ':subscriptionsId', subscriptionsId);
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
                            email: $('#email_edit').val(),
                            status: $('#status_edit').val(),
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

                                $('#tableSubscriptions').DataTable().ajax.reload(null, false);

                                $('#tableSubscriptions').modal('hide');

                            }
                        },
                        error: function(xhr) {
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
