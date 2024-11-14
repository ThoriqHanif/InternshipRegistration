@extends('layouts.app')

@section('content')
    {{-- @push('button-datatable')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        @endpush --}}

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Report</h3>
                <p class="text-subtitle text-muted">Berikut daftar Daily Report </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
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
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-2"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <a class="float-left text-white">
                                </a>
                                <a class="btn btn-primary btn-export-pdf display float-right" id="pdfPrint"
                                    data-intern-id="{{ $internId }}" data-intern-name="{{ $interns->name }}">
                                    <i class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>
                                    Print PDF
                                </a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                @include('components.alert')
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tableReport">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Presensi</th>
                                                <th>Jam Hadir</th>
                                                <th>Instansi</th>
                                                <th>Nama Project</th>
                                                <th>Pekerjaan</th>
                                                <th>Keterangan</th>
                                                <th>Terlambat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    {{-- Modal Daily Report --}}
                                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                                        aria-labelledby="reportModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportModalLabel">Daily Report</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" class="form-control" id="report_id"
                                                        name="report_id">
                                                    <div class="form-group">
                                                        <label for="presence">Tanggal</label>
                                                        <input type="hidden" class="form-control" id="id"
                                                            name="id">
                                                        <input type="date" class="form-control" id="date"
                                                            name="date" placeholder="Tanggal" disabled>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="presence">Presensi</label>
                                                                <select
                                                                    class="form-select form-control @error('presence') is-invalid @enderror"
                                                                    name="presence" id="presence" required>
                                                                    <option value="" selected disabled>Pilih Presensi
                                                                    </option>
                                                                    <option value="Masuk"
                                                                        {{ old('presence') == 'Masuk' ? 'selected' : '' }}>
                                                                        Masuk
                                                                    </option>
                                                                    <option value="Izin"
                                                                        {{ old('presence') == 'Izin' ? 'selected' : '' }}>
                                                                        Izin
                                                                    </option>
                                                                    <option value="Alpa"
                                                                        {{ old('presence') == 'Alpa' ? 'selected' : '' }}>
                                                                        Alpa
                                                                    </option>
                                                                    <option value="Libur"
                                                                        {{ old('presence') == 'Libur' ? 'selected' : '' }}>
                                                                        Libur
                                                                    </option>

                                                                </select>

                                                                @error('presence')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="attendance_time">Jam Kehadiran</label>
                                                                <input type="time" name="attendance_time"
                                                                    class="form-control  @error('attendance_time') is-invalid @enderror"
                                                                    id="attendance_time" placeholder="e.g. 08.00" required>
                                                                <p class="mt-1 d-none" id="lateWarning"><small>Kamu <strong
                                                                            class="text-danger">Terlambat</strong> silahkan
                                                                        lanjut ke formulir keterlambatan</small></p>
                                                                @error('attendance_time')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="agency">Instansi</label>
                                                        <input type="text" name="agency"
                                                            class="form-control @error('agency') is-invalid @enderror"
                                                            id="agency" placeholder="e.g. Kadang Koding" required>
                                                        @error('agency')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_name">Nama Project</label>
                                                        <input type="text" name="project_name"
                                                            class="form-control @error('project_name') is-invalid @enderror"
                                                            id="project_name" placeholder="e.g. Website Pendaftaran"
                                                            required>
                                                        @error('project_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="job">Pekerjaan</label>
                                                        <input type="text" name="job"
                                                            class="form-control @error('job') is-invalid @enderror"
                                                            id="job" placeholder="e.g. Backend" required>
                                                        @error('job')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Keterangan</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                                            placeholder="e.g. Mastering Data Intern" name="description" required></textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="button" class="btn btn-primary update-btn"
                                                        type="submit" id="saveReportBtn">Simpan</button>
                                                    <button type="submit" class="btn btn-primary d-none"
                                                        id="continueButton">Formulir
                                                        Keterlambatan</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Form Keterlambatan --}}
                                    <div class="modal fade" id="modalLate" data-bs-backdrop="static"
                                        data-bs-keyboard="false" aria-hidden="true"
                                        aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <input type="hidden" class="form-control" id="report_id" name="report_id">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportModalLabel">Formulir Keterlambatan
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Kamu terlambat <strong class="text-danger"
                                                            id="lateness-duration"></strong> dari
                                                        jam kehadiran</p>
                                                    <div class="form-group">
                                                        <label for="">Total keterlambatan</label>
                                                        <div class="d-flex">
                                                            <p id="total-lateness-info">
                                                            <p>x pada <span class="text-primary"
                                                                    id="lateness-dates"></span></p>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="is_consequence_done" class="mb-2">Sudah melaksanakan
                                                            konsekuensi?</label>
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="d-inline-block me-2 mb-1">
                                                                <div class="form-check">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox"
                                                                            class="form-check-input form-check-success form-check-glow"
                                                                            name="is_consequence_done"
                                                                            id="is_consequence_done">
                                                                        <label class="form-check-label"
                                                                            for="done">Sudah</label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Keterangan</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" id="consequence_description" placeholder=""
                                                            name="consequence_description"></textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-target="#reportModal"
                                                        data-bs-toggle="modal" id="backBtn">Kembali</button>
                                                    <button class="btn btn-primary" type="submit"
                                                        id="saveLateBtn">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @include('pages.users.report.detail')
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>

    @push('script-report')
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tableReport = new DataTable('#tableReport', {
                // dom: 'Bfrtip',
                // buttons: [{
                //         extend: 'copyHtml5',
                //         exportOptions: {
                //             columns: ':not(.exclude)'
                //         }
                //     },
                //     {
                //         extend: 'excelHtml5',
                //         exportOptions: {
                //             columns: ':not(.exclude)'
                //         }
                //     },
                //     {
                //         extend: 'csvHtml5',
                //         exportOptions: {
                //             columns: ':not(.exclude)'
                //         }
                //     },

                // ],
                processing: true,
                serverSide: true,
                scrollX: true,
                fixedHeader: true,
                fixedColumns: {
                    start: 2,
                    end: 2
                },
                ajax: {
                    url: "{{ route('daily-reports.index') }}",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit',
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'table-fit',
                        render: function(data, type, row) {
                            let dateReport = new Date(data);
                            return dateReport.toLocaleDateString(
                                'id-ID', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                        }
                    },
                    {
                        data: 'presence',
                        name: 'presence',
                        class: 'table-fit',
                    },
                    {
                        data: 'attendance_time',
                        name: 'attendance_time',
                        class: 'table-fit',
                        render: function(data, type, row) {
                            if (type === 'display' && data) {
                                let time = data.split(':').slice(0,
                                    2).join(':');
                                return time;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'agency',
                        name: 'agency'
                    },
                    {
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'job',
                        name: 'job'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'is_late',
                        name: 'is_late',
                        class: 'table-fit',
                        render: function(data, type, row) {
                            if (row.presence) {
                                let isLate = (data === "1" || data === 1 || data === true);
                                if (isLate) {
                                    return '<span class="badge bg-danger"><i class="bi bi-clock me-2"></i> Terlambat</span>';
                                } else {
                                    return '<span class="badge bg-info">Tidak Terlambat</span>';
                                }
                            } else {
                                return '';
                            }

                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'table-fit',

                    },
                ]
            });

            // Edit
            let originalData = {};

            // Script Cek Keterlambatan
            function isLate() {
                let reportId = $('#report_id').val();
                let attendanceTime = $('#attendance_time').val();

                $.ajax({
                    url: '{{ route('api.check.late') }}',
                    method: 'POST',
                    data: {
                        report_id: reportId,
                        attendance_time: attendanceTime,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        if (response.isLate) {
                            $('#lateWarning').removeClass('d-none');
                            $('#continueButton').removeClass('d-none');
                            $('.update-btn').addClass('d-none');
                        } else {
                            $('#lateWarning').addClass('d-none');
                            $('#continueButton').addClass('d-none');
                            $('.update-btn').removeClass('d-none');
                        }
                    }
                });
            }

            function getAllData(id) {
                $.ajax({
                    url: '{{ route('daily-reports.edit', ':id') }}'.replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);

                        $('#reportModal').modal('show');
                        $('#report_id').val(response.result.id);
                        $('#date').val(response.result.date);
                        $('#presence').val(response.result.presence);
                        $('#attendance_time').val(response.result.attendance_time);
                        $('#agency').val(response.result.agency);
                        $('#project_name').val(response.result.project_name);
                        $('#job').val(response.result.job);
                        $('#description').val(response.result.description);
                        $('#consequence_description').val(response.result.consequence_description);
                        if (response.result.is_consequence_done === "1" || response.result.is_consequence_done === 1 || response.result.is_consequence_done === true) {
                            $('#is_consequence_done').prop('checked', true);
                        } else {
                            $('#is_consequence_done').prop('checked', false);
                        }



                        $('#lateness-duration').text(response.lateness_duration);
                        $('#total-lateness-info').text(response.total_late);
                        $('#lateness-dates').text(response.lateness_dates);

                        originalData = {
                            date: response.result.date,
                            presence: response.result.presence,
                            attendance_time: response.result.attendance_time,
                            agency: response.result.agency,
                            project_name: response.result.project_name,
                            job: response.result.job,
                            description: response.result.description,
                        };

                        $('#backBtn').data('report-id', response.result.id);
                        isLate();
                    }
                });
            }

            // Edit
            $(document).on('click', '#btn-edit', function(e) {
                var reportDate = new Date($(this).data('report-date'));
                var currentDate = new Date();

                if (reportDate > currentDate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Belum waktunya mengisi report',
                        text: 'Apakah Anda ingin mengajukan izin?',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, ajukan izin',
                        cancelButtonText: 'Tidak',
                        confirmButtonColor: "#435EBE",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = $(this).data('report-id');
                            $('#presence').html('<option value="Izin" selected>Izin</option>');
                            getAllData(id);
                        }
                    });
                } else {
                    var id = $(this).data('report-id');
                    $('#presence').html(`
                        <option value="" selected disabled>Pilih Presensi</option>
                        <option value="Masuk">Masuk</option>
                        <option value="Izin">Izin</option>
                        <option value="Alpa">Alpa</option>
                        <option value="Libur">Libur</option>
                    `);
                    getAllData(id);
                }
            });


            // Back modal Daily Report
            $(document).on('click', '#backBtn', function(e) {
                let reportId = $(this).data('report-id');
                if (reportId) {
                    getAllData(reportId);
                }

            })

            // Cek Keterlambatan
            $('#attendance_time').on('change', function() {
                isLate();
            });

            // Update
            $(document).on('click', '#continueButton, #saveLateBtn, #saveReportBtn', function(e) {
                let isContinue = this.id === 'continueButton';
                let isNotLate = this.id === 'saveReportBtn';
                let reportId = $('#report_id').val();
                let var_url = '{{ route('daily-reports.update', ':reportId') }}'.replace(':reportId',
                    reportId);
                let var_type = 'PUT';
                let data = {};

                if (isContinue) {
                    data = {
                        date: $('#date').val(),
                        presence: $('#presence').val(),
                        attendance_time: $('#attendance_time').val(),
                        agency: $('#agency').val(),
                        project_name: $('#project_name').val(),
                        job: $('#job').val(),
                        description: $('#description').val(),
                    };

                    let hasChanges = Object.keys(data).some(key => data[key] !== originalData[key]);

                    if (!hasChanges) {
                        $('#reportModal').modal('hide');
                        $('#modalLate').modal('show');
                        return;
                    }
                } else if (isNotLate) {
                    data = {
                        date: $('#date').val(),
                        presence: $('#presence').val(),
                        attendance_time: $('#attendance_time').val(),
                        agency: $('#agency').val(),
                        project_name: $('#project_name').val(),
                        job: $('#job').val(),
                        description: $('#description').val(),
                    };
                } else {
                    var_url = '{{ route('daily-reports.updateLate', ':reportId') }}'.replace(':reportId', reportId);
                    data = {
                        is_consequence_done: $('#is_consequence_done').is(':checked') ? 1 : 0,
                        consequence_description: $('#consequence_description').val(),
                    };
                }

                $.ajax({
                    url: var_url,
                    type: var_type,
                    data: data,
                    success: function(response) {
                        console.log(response);

                        if (response.errors) {
                            console.log(response.errors);
                            showError('Gagal!', 'Data gagal disimpan.');
                        } else {
                            let successMessage = isContinue ?
                                'Data berhasil disimpan. Lanjutkan mengisi form keterlambatan.' :
                                'Data berhasil disimpan.';

                            $('#lateness-duration').text(response.lateness_duration);

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: successMessage,
                                confirmButtonColor: "#435EBE",
                            });

                            $('#reportModal').modal('hide');
                            if (isContinue) {
                                $('#modalLate').modal('show');
                            } else if (isNotLate) {
                                tableReport.ajax.reload(null, false);
                            } else {
                                $('#modalLate').modal('hide');
                                tableReport.ajax.reload(null, false);
                            }
                        }
                    },
                    error: function(xhr) {
                        let errorMessages = '';
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                        } else {
                            errorMessages = 'Terjadi kesalahan saat update data.';
                        }
                        showError('Gagal!', errorMessages);
                    },
                });
            });

            function showError(title, message) {
                Swal.fire({
                    icon: 'error',
                    title: title,
                    html: message,
                    confirmButtonColor: "#435EBE",
                });
            }

            // Detail Report
            $(document).ready(function() {
                $('#tableReport').on('click', 'a#detailReportBtn', function() {
                    var id = $(this).data('report-id');

                    $.ajax({
                        url: '{{ route('report.detail', ':id') }}'.replace(':id', id),
                        method: 'GET',
                        success: function(response) {
                            console.log(response.result);
                            $('#modalDetailReport').modal('show');
                            $('#report_id').val(response.result.id);
                            $('#date_detail').text(response.result.date);
                            $('#presence_detail').text(response.result.presence);
                            $('#attendance_time_detail').text(response.result.attendance_time);
                            $('#agency_detail').text(response.result.agency);
                            $('#project_name_detail').text(response.result.project_name);
                            $('#job_detail').text(response.result.job);
                            $('#description_detail').text(response.result.description);
                            $('#lateness-duration_detail').text(response.lateness_duration);
                            $('#total-lateness-info_detail').text(response.total_lateness);
                            $('#lateness-dates_detail').text(response.lateness_dates);

                            if (response.result.is_consequence_done === "1" || response.result.is_consequence_done === 1 || response.result.is_consequence_done === true) {
                                $('#is_consequence_done_detail').prop('checked', true);
                            } else {
                                $('#is_consequence_done_detail').prop('checked', false);
                            }

                            $('#consequence_description_detail').text(response.result.consequence_description ? response.result.consequence_description : '-');
                            $('#is_late_detail').text(response.result.is_late == 1 ? 'Terlambat' : 'Tidak Terlambat');
                            $('#created_at_detail').text(new Date(response.result.created_at).toLocaleString('id-ID'));
                            $('#updated_at_detail').text(new Date(response.result.updated_at).toLocaleString('id-ID'));
                            // $('#status_report_detail').text(response.result.status);
                            // $('#admin_reason_detail').text(response.result.admin_reason ? response.result.admin_reason : '-');

                            if (response.result.is_late == 1) {
                                $('#lateness').removeClass('d-none');
                            } else {
                                $('#lateness').addClass('d-none');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });

            $('#reportModal').on('hidden.bs.modal', function() {
                $('#date').val('');
                $('#presence').val('');
                $('#attendance_hours').val('');
                $('#agency').val('');
                $('#project_name').val('');
                $('#job').val('');
                $('#description').val('');

                $('.alert-danger').addClass('d-none');
                $('.alert-danger').html('');

                $('.alert-success').addClass('d-none');
                $('.alert-success').html('');

            });

            // Export PDF
            $(document).on('click', '.btn-export-pdf', function() {

                let internId = $(this).data('intern-id');

                let internName = $(this).data('intern-name');

                console.log(internId)

                console.log(internName)



                Swal.fire({

                    title: 'Mohon Tunggu!',

                    html: 'Generate PDF..',

                    allowOutsideClick: false,

                    showConfirmButton: false,

                    willOpen: () => {

                        Swal.showLoading();

                    },

                });



                fetch('{{ route('intern.export.report.pdf', ':internId') }}'.replace(':internId',
                        internId))

                    .then(response => {

                        Swal.close();

                        return response.blob();

                    })

                    .then(blob => {

                        const url = window.URL.createObjectURL(blob);

                        const link = document.createElement('a');

                        link.href = url;

                        link.download = 'Laporan Harian Magang - ' + internName + '.pdf';



                        // Tambahkan tautan ke dokumen dan klik otomatis

                        document.body.appendChild(link);

                        link.click();



                        // Hapus tautan setelah diunduh

                        document.body.removeChild(link);

                    })

                    .catch(error => {

                        console.error(error);



                        Swal.fire({

                            icon: 'error',

                            title: 'Oops...',

                            text: 'Terjadi Kesahalahan',
                            confirmButtonColor: "#435EBE",

                        });

                    });

            });
        </script>
    @endpush
@endsection
