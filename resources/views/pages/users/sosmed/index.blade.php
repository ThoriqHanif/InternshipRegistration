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
                    <table class="table table-hover" id="tableSocialMedia">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Nama</th>
                                <th>Url</th>
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
                $(document).ready(function() {
                    function updateIconPreview(iconInput, previewElement) {
                        const iconClass = $(iconInput).val();
                        $(previewElement).removeClass().addClass(iconClass);
                    }

                    $(document).on('keyup', '#icon, #manualIcon, #iconEdit, #manualIconEdit', function() {
                        const inputId = $(this).attr('id');
                        let previewElement = '';

                        if (inputId === 'iconEdit') {
                            previewElement = '#preview-icon-edit i';
                        } else if (inputId === 'manualIconEdit') {
                            previewElement = '#preview-icon-manual-edit i';
                        }

                        updateIconPreview(this, previewElement);
                    });


                    $('#socialMedia, #socialMediaEdit').change(function() {
                        const selectedOption = $(this).find(':selected');
                        const value = selectedOption.val();
                        const isManual = selectedOption.data('manual');
                        const baseUrl = selectedOption.data('url');
                        const hintText = selectedOption.data('hint');

                        const autoField = $('.auto-field');
                        const manualField = $('.manual-field');
                        const usernameInput = $(this).is('#socialMedia') ? $('#username') : $('#usernameEdit');
                        const iconInput = $(this).is('#socialMedia') ? $('#icon') : $('#iconEdit');
                        const iconPreview = $(this).is('#socialMedia') ? '#preview-icon i' : '#preview-icon-edit i';
                        const hintTextElement = $(this).is('#socialMedia') ? $('#hint-text') : $('#hint-text-edit');
                        const baseUrlElement = $(this).is('#socialMedia') ? $('#base-url') : $('#base-url-edit');

                        if (isManual) {
                            manualField.removeClass('d-none');
                            autoField.addClass('d-none');
                            hintTextElement.text("");
                            iconInput.val('');
                            $(iconPreview).attr('class', '');
                        } else {
                            baseUrlElement.text(baseUrl);
                            iconInput.val(selectedOption.data('icon'));
                            $(iconPreview).attr('class', selectedOption.data('icon'));
                            hintTextElement.text(hintText);

                            autoField.removeClass('d-none');
                            manualField.addClass('d-none');
                            usernameInput.val('');
                        }
                    });

                    $('#manualIcon').keyup(function() {
                        updateIconPreview(this, '#preview-icon i');
                    });

                    // CSRF Token
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // Store
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

                        let socialMediaData = {
                            name: $('#socialMedia').val(),
                            username: $('#username').val(),
                            icon: $('#icon').val(),
                            manualName: $('#manualName').val(),
                            manualUrl: $('#manualUrl').val(),
                            manualIcon: $('#manualIcon').val(),
                        };

                        if (socialMediaData.name === 'other') {
                            // Manual input
                            socialMediaData = {
                                name: socialMediaData.manualName,
                                url: socialMediaData.manualUrl,
                                icon: socialMediaData.manualIcon,
                            };
                        } else {
                            // Auto input
                            socialMediaData.url = `${$('#base-url').text()}${socialMediaData.username}`;
                        }

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('social-medias.store') }}',
                            data: socialMediaData,
                            processData: true,
                            contentType: 'application/x-www-form-urlencoded',
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
                                    handleErrors(response);
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                handleAjaxError(xhr);
                            },
                        });
                    });

                    // Detail
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

                    // Edit
                    $('#tableSocialMedia').on('click', 'a.edit-social-media', function() {
                        var id = $(this).data('social-media-id');

                        $.ajax({
                            url: '{{ route('social-medias.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editSocialMedia').modal('show');
                                $('#social_media_id').val(response.result.id);

                                const optionExists = $('#socialMediaEdit option[value="' + response
                                    .result.name + '"]').length > 0;

                                if (optionExists) {
                                    $('#socialMediaEdit').val(response.result.name).trigger('change');
                                    $('#usernameEdit').val(response.result.url.split('/').pop());
                                    $('#iconEdit').val(response.result.icon);
                                    $('#preview-icon-edit i').attr('class', response.result.icon);
                                    updateIconPreview('#iconEdit', '#preview-icon-edit i');

                                    $('.auto-field').removeClass('d-none');
                                    $('.manual-field').addClass('d-none');
                                } else {
                                    $('#socialMediaEdit').val('other').trigger('change');

                                    $('.manual-field').removeClass('d-none');
                                    $('.auto-field').addClass('d-none');
                                    $('#manualNameEdit').val(response.result.name);
                                    $('#manualUrlEdit').val(response.result.url);
                                    $('#manualIconEdit').val(response.result.icon);
                                    $('#preview-icon-edit i').attr('class', response.result.icon);
                                    updateIconPreview('#manualIconEdit', '#preview-icon-manual-edit i');
                                }

                                const selectedOption = $('#socialMediaEdit option:selected');
                                if (!selectedOption.data('manual')) {
                                    $('.auto-field').removeClass('d-none');
                                    $('.manual-field').addClass('d-none');
                                    $('#base-url-edit').text(selectedOption.data('url'));
                                    $('#hint-text-edit').text(selectedOption.data('hint'));
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });

                    // Update
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

                        let socialMediaData = {
                            id: $('#social_media_id').val(),
                            name: $('#socialMediaEdit').val(),
                            username: $('#usernameEdit').val(),
                            icon: $('#iconEdit').val(),
                            manualName: $('#manualNameEdit').val(),
                            manualUrl: $('#manualUrlEdit').val(),
                            manualIcon: $('#manualIconEdit').val(),
                        };

                        if (socialMediaData.name === 'other') {
                            // Manual input
                            socialMediaData = {
                                id: socialMediaData.id,
                                name: socialMediaData.manualName,
                                url: socialMediaData.manualUrl,
                                icon: socialMediaData.manualIcon,
                            };
                        } else {
                            // Auto input
                            socialMediaData.url = `${$('#base-url-edit').text()}${socialMediaData.username}`;
                        }

                        $.ajax({
                            url: var_url,
                            type: var_type,
                            data: socialMediaData,
                            processData: true,
                            contentType: 'application/x-www-form-urlencoded',
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
                                Swal.close();
                                handleAjaxError(xhr);
                            },
                        });
                    });

                    // Error handling functions
                    function handleErrors(response) {
                        let errorMessages = '';
                        if (response.errors) {
                            for (let key in response.errors) {
                                if (response.errors.hasOwnProperty(key)) {
                                    errorMessages += response.errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data', 'error');
                        }
                    }

                    function handleAjaxError(xhr) {
                        if (xhr.status === 422) {
                            let errorMessages = '';
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    }
                });
            </script>
        @endpush
    @endsection
