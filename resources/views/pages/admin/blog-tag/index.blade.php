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
                <h3>Daftar Tag Blog</h3>
                <p class="text-subtitle text-muted">Berikut daftar Tag Blog </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('tags') }}">Tags Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Tag Blog</li>
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
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Tag" data-bs-toggle="modal"
                        data-bs-target="#createTag">
                        + Tambah Tag
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm" id="tableTag">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Nama</th>
                                <th>Slug</th>
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

        @include('pages.admin.blog-tag.create')
        @include('pages.admin.blog-tag.show')
        @include('pages.admin.blog-tag.edit')

        @push('table-tag')
            <script>
                let tableTag = new DataTable('#tableTag', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('tags.index') }}",
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
                            data: 'slug',
                            name: 'slug',
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
                    $("#formTag").on("submit", function(e) {
                        e.preventDefault();
                        $('#createTag').modal('hide');

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
                            url: '{{ route('tags.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formTag')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableTag').DataTable().ajax
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
                    $('#tableTag').on('click', 'a.detail-tag', function() {
                        var id = $(this).data('tag-id');

                        $.ajax({
                            url: '{{ route('tags.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                console.log(response.result);
                                $('#detailTag').modal('show');
                                $('#id').val(response.result.id);
                                $('#name_detail').text(response.result.name);
                                $('#slug_detail').text(response.result.slug);
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
                    $('#tableTag').on('click', 'a.edit-tag', function() {

                        var id = $(this).data('tag-id');
                        console.log(id);


                        $.ajax({
                            url: '{{ route('tags.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editTag').modal('show');
                                $('#tag_id').val(response.result.id);
                                $('#name_edit').val(response.result.name);

                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let tagId = $('#tag_id').val();
                    var var_url = '{{ route('tags.update', ':tagId') }}'.replace(
                        ':tagId', tagId);
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

                                $('#tableTag').DataTable().ajax.reload(null, false);

                                $('#tableTag').modal('hide');

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
