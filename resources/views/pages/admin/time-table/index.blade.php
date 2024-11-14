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
                <h3>Jam Operasional</h3>
                <p class="text-subtitle text-muted">Berikut Jam Operasional Kadang Koding Indonesia </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Jam Kerja</li>
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

                    {{-- <button class="btn btn-sm btn-primary tombol-create float-right text-end" data-placement="top"
                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Tag" data-bs-toggle="modal"
                        data-bs-target="#createTag">
                        + Tambah Tag
                    </button> --}}
                </div>

                <div class="card-body">
                    @include('components.alert')
                    <table class="table table-hover" id="tableTimeTable">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th>Hari</th>
                                <th style="width: 20%">Jam Mulai</th>
                                <th style="width: 20%">Jam Selesai</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="modal fade text-left modal-borderless" id="editTimeTable" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Jam Operasional</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="time_table_id" name="id">
                                <div class="form-group">
                                    <label>Hari <span class="text-danger">*</span></label>
                                    <input type="text" name="day"
                                        class="form-control  @error('day') is-invalid @enderror" id="day" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="date" name="start_time"
                                        class="form-control flatpickr-time-picker-24h @error('start_time') is-invalid @enderror"
                                        id="start_time" placeholder="e.g. 08.00">
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="date" name="end_time"
                                        class="form-control flatpickr-time-picker-24h @error('end_time') is-invalid @enderror"
                                        id="end_time" placeholder="e.g. 17.00">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" class="btn btn-primary ms-1 btn-update" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Update</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        @push('table-time-table')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

            <script>
                let tableTimeTable = new DataTable('#tableTimeTable', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('time-tables.index') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'day',
                            name: 'day',
                            class: 'text-capitalize'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time',
                            render: function(data) {
                                return moment(data, "HH:mm:ss").format("HH:mm")
                            }

                        },
                        {
                            data: 'end_time',
                            name: 'end_time',
                            render: function(data) {
                                return moment(data, "HH:mm:ss").format("HH:mm")
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

            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('click', '.edit-time-table', function(e) {
                    var id = $(this).data('time-table-id');

                    $.ajax({
                        url: '{{ route('time-tables.edit', ':id') }}'.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('#editTimeTable').modal('show');
                            $('#time_table_id').val(response.result.id);
                            $('#day').val(response.result.day);
                            $('#start_time').val(response.result.start_time);
                            $('#end_time').val(response.result.end_time);
                        }
                    });
                });

                $(document).on('click', '.btn-update', function(e) {

                    let timeTableId = $('#time_table_id').val();
                    var var_url = '{{ route('time-tables.update', ':timeTableId') }}'.replace(':timeTableId', timeTableId);
                    var var_type = 'PUT';
                    $.ajax({
                        url: var_url,
                        type: var_type,
                        data: {
                            day: $('#day').val(),
                            start_time: $('#start_time').val(),
                            end_time: $('#end_time').val(),
                        },
                        success: function(response) {
                            if (response.errors) {
                                console.log(response.errors);

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    confirmButtonColor: "#435EBE",
                                });


                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disimpan.',
                                    confirmButtonColor: "#435EBE",
                                });

                                tableTimeTable.ajax.reload(null, false);

                                $('#editTimeTable').modal('hide');

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
                                    confirmButtonColor: "#435EBE",
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat update data.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                    });
                });

                $('#editTimeTable').on('hidden.bs.modal', function() {
                    // $('#day').val('');
                    // $('#start_time').val('');
                    // $('#end_time').val('');

                    $('.alert-danger').addClass('d-none');
                    $('.alert-danger').html('');

                    $('.alert-success').addClass('d-none');
                    $('.alert-success').html('');

                });
            </script>
        @endpush
    @endsection
