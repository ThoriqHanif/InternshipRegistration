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
                <h3>Daftar Dokumen</h3>
                <p class="text-subtitle text-muted">Berikut daftar Dokumen </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Dokumen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Dokumen</li>
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Maganger</label>
                                        <select class="choices form-select" id="filter-intern">
                                            <option value="" selected>Pilih Maganger</option>
                                            @foreach ($interns as $intern)
                                                <option value="{{ $intern->id }}">{{ $intern->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Tipe Dokumen</label>
                                        <select class="choices form-select" id="filter-type">
                                            <option value="" selected>Pilih Tipe</option>
                                            <option value="report">Laporan</option>
                                            <option value="assesment">Penilaian</option>
                                            <option value="announcement">Pengumuman</option>
                                            <option value="certificate">Sertifikat</option>
                                            <option value="evaluation">Evaluasi</option>
                                            <option value="etc">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="btn-filter text-end">
                                    <a class="btn btn-sm btn-primary" id="btn-filter"><i class="bi bi-search me-2"></i>
                                        Filter</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header mb-2 justify-content-end"
                    style="display: flex; align-items: center; justify-content: space-between;">

                    <button class="btn btn-sm btn-primary tombol-create float-right text-end" data-placement="top"
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Dokumen" data-bs-toggle="modal"
                        data-bs-target="#createDocument">
                        + Tambah Dokumen
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover" id="tableDocuments">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Pemagang</th>
                                <th class="table-fit">Tipe</th>
                                <th>Nama</th>
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

        @include('pages.admin.document.create')

        @push('table-documents')

            <script>
                let tableDocuments = new DataTable('#tableDocuments', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('documents.index') }}",
                        data: function(d) {
                            d.intern_id = $('#filter-intern').val();
                            d.type = $('#filter-type').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'intern.full_name',
                            name: 'intern.full_name',
                            class: 'table-fit'
                        },
                        {
                            data: 'type',
                            name: 'type',
                            class: 'table-fit',
                            render: function(data) {
                                if (data === 'report') {
                                    return 'Laporan';
                                } else if (data === 'assesment') {
                                    return 'Penilaian';
                                } else if (data === 'announcement') {
                                    return 'Pengumuman';
                                } else if (data === 'certificate') {
                                    return 'Sertifikat';
                                } else if (data === 'evaluation') {
                                    return 'Evaluasi';
                                } else if (data === 'etc') {
                                    return 'Lainnya';
                                } else {
                                    return data;
                                }
                            }
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

                $('#btn-filter').on('click', function() {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang memproses data...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    tableDocuments.ajax.reload();
                });

                tableDocuments.on('draw', function() {
                    Swal.close();
                });
            </script>

            {{-- Create --}}
            <script>
                $(document).ready(function() {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('api.interns') }}',
                        success: function(response) {
                            if (response) {
                                var select = $('select[id="intern"]');
                                select.empty();
                                select.append(
                                    '<option value="" selected disabled>-- Pemagang --</option>');

                                $.each(response, function(index, intern) {
                                    select.append('<option value="' + intern.id + '">' + intern
                                        .full_name + '</option>');
                                });

                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat mengambil data pemagang.', 'error');
                        }
                    });

                    $("#formDocument").on("submit", function(e) {
                        e.preventDefault();
                        $('#createDocument').modal('hide');


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
                            url: '{{ route('documents.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formDocument')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableDocuments').DataTable().ajax.reload();
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
        @endpush
    @endsection
