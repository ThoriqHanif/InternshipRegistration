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
                <h3>Sosial Media</h3>
                <p class="text-subtitle text-muted">Daftar Sosial Media Anda</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Sosial Media</li>
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
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Sosmed" data-bs-toggle="modal"
                        data-bs-target="#createSocialMedia">
                        + Tambah Social Media
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm" id="tableSocialMedia">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th>Nama</th>
                                <th class="table-fit">Url</th>
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
        @include('pages.users.sosmed.create')
        @include('pages.users.sosmed.show')
        @include('pages.users.sosmed.edit')

        @push('table-sosmed')
            <script>
                let tableSocialMedia = new DataTable('#tableSocialMedia', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('social-medias.index') }}",
                        type: 'GET'
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
                            data: 'url',
                            name: 'url',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'table-fit'
                        },


                    ]
                });
            </script>
        @endpush

        @push('script-sosmed')
            <script>
                $('#icon').keyup(function(event) {
                    const iconClass = $(this).val();
                    const iconPreview = $(this).siblings('.input-group-text').find('i');

                    iconPreview.removeClass();
                    if (iconClass) {
                        iconPreview.addClass(iconClass);
                    }
                });
            </script>
            {{-- Get Icon --}}
            <script>
                function updateIconPreview() {
                    const iconClass = $('#icon_edit').val();
                    const iconPreview = $('#icon_preview');

                    iconPreview.removeClass();
                    if (iconClass) {
                        iconPreview.addClass(iconClass);
                    }
                }
            </script>
            {{-- Create --}}
            <script>
                $(document).ready(function() {
                    $("#formSocialMedia").on("submit", function(e) {
                        e.preventDefault();
                        $('#createSocialMedia').modal('hide');

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
                            url: '{{ route('social-medias.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formSocialMedia')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableSocialMedia').DataTable().ajax.reload();
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
                    $('#tableSocialMedia').on('click', 'a.detail-social-media', function() {
                        var id = $(this).data('social-media-id');

                        $.ajax({
                            url: '{{ route('social-medias.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#detailSocialMedia').modal('show');
                                $('#id').val(response.result.id);
                                $('#name_detail').text(response.result.name);
                                $('#url_detail').text(response.result.url);
                                $('#url_detail').attr('href', response.result.url);
                                $('#icon_detail').attr('class', response.result.icon);

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
                    $('#tableSocialMedia').on('click', 'a.edit-social-media', function() {

                        var id = $(this).data('social-media-id');

                        $.ajax({
                            url: '{{ route('social-medias.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editSocialMedia').modal('show');
                                $('#social_media_id').val(response.result.id);
                                $('#name_edit').val(response.result.name);
                                $('#url_edit').val(response.result.url);
                                $('#icon_edit').val(response.result.icon);
                                $('#icon_preview').attr('class', response.result.icon);

                                updateIconPreview();

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let socialMediaId = $('#social_media_id').val();
                    var var_url = '{{ route('social-medias.update', ':socialMediaId') }}'.replace(
                        ':socialMediaId', socialMediaId);
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
                            url: $('#url_edit').val(),
                            icon: $('#icon_edit').val(),
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

                                $('#tableSocialMedia').DataTable().ajax.reload(null, false);

                                $('#editSocialMedia').modal('hide');

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
