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
                <h3>Daftar Skala Penilaian</h3>
                <p class="text-subtitle text-muted">Berikut daftar Skala Penilaian </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Skala Penilaian</li>
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
                        data-bs-target="#createGradeRange">
                        + Tambah Skala
                    </button>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover" id="tableGradeRange">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Min</th>
                                <th class="table-fit">Max</th>
                                <th class="table-fit">Nilai Huruf</th>
                                <th>Predikat</th>
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

        @include('pages.admin.grade-range.create')
        @include('pages.admin.grade-range.show')
        @include('pages.admin.grade-range.edit')

        @push('table-grade-ranges')
            <script>
                let tableGradeRange = new DataTable('#tableGradeRange', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('grade-ranges.index') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'min',
                            name: 'min',
                            class: 'table-fit',
                            render: function(data) {
                                return parseFloat(data).toString();
                            }
                        },
                        {
                            data: 'max',
                            name: 'max',
                            class: 'table-fit',
                            render: function(data) {
                                return parseFloat(data).toString();
                            }
                        },
                        {
                            data: 'letter_grade',
                            name: 'letter_grade',
                            class: 'table-fit'
                        },
                        {
                            data: 'predicate',
                            name: 'predicate',
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
                    $("#formGradeRange").on("submit", function(e) {
                        e.preventDefault();
                        $('#createGradeRange').modal('hide');

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
                            url: '{{ route('grade-ranges.store') }}',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    $('#formGradeRange')[0].reset();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        $('#tableGradeRange').DataTable().ajax.reload();
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
                    $('#tableGradeRange').on('click', 'a.detail-grade-range', function() {
                        var id = $(this).data('grade-range-id');

                        $.ajax({
                            url: '{{ route('grade-ranges.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                console.log(response.result);
                                $('#detailGradeRange').modal('show');
                                $('#id').val(response.result.id);
                                $('#min_detail').text(parseFloat(response.result.min));
                                $('#max_detail').text(parseFloat(response.result.max));
                                $('#letter_grade_detail').text(response.result.letter_grade);
                                $('#predicate_detail').text(response.result.predicate);
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
                    $('#tableGradeRange').on('click', 'a.edit-grade-range', function() {
                        var id = $(this).data('grade-range-id');

                        $.ajax({
                            url: '{{ route('grade-ranges.edit', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#editGradeRange').modal('show');
                                $('#grade_range_id').val(response.result.id);
                                $('#min_edit').val(parseFloat(response.result.min));
                                $('#max_edit').val(parseFloat(response.result.max));
                                $('#letter_grade_edit').val(response.result.letter_grade);
                                $('#predicate_edit').val(response.result.predicate);
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let gradeRangeId = $('#grade_range_id').val();
                    var var_url = '{{ route('grade-ranges.update', ':gradeRangeId') }}'.replace(':gradeRangeId',
                        gradeRangeId);
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
                            min: $('#min_edit').val(),
                            max: $('#max_edit').val(),
                            letter_grade: $('#letter_grade_edit').val(),
                            predicate: $('#predicate_edit').val(),
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

                                $('#tableGradeRange').DataTable().ajax.reload(null, false);
                                $('#editGradeRange').modal('hide');

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

            {{-- Validation --}}
            <script>
                function validateMinMax(minSelector, maxSelector) {
                    const minVal = parseFloat($(minSelector).val());
                    const maxVal = parseFloat($(maxSelector).val());

                    if (!isNaN(minVal) && !isNaN(maxVal)) {
                        if (minVal > maxVal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Nilai Tidak Valid',
                                text: 'Nilai minimum tidak boleh lebih besar dari nilai maksimum.',
                                confirmButtonText: 'OK'
                            });
                            $(minSelector).val(''); // Reset input min
                        } else if (maxVal < minVal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Nilai Tidak Valid',
                                text: 'Nilai maksimum tidak boleh lebih kecil dari nilai minimum.',
                                confirmButtonText: 'OK'
                            });
                            $(maxSelector).val(''); // Reset input max
                        }
                    }
                }

                $('#min, #max, #min_edit, #max_edit').on('change blur', function() {
                    if (this.id === 'min' || this.id === 'max') {
                        validateMinMax('#min', '#max');
                    } else if (this.id === 'min_edit' || this.id === 'max_edit') {
                        validateMinMax('#min_edit', '#max_edit');
                    }
                });
            </script>

        @endpush
    @endsection
