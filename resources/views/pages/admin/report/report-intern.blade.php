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
                <h3>Laporan Harian</h3>
                <p class="text-subtitle text-muted">Berikut laporan harian <strong
                        class="text-primary">{{ $intern->full_name }}</strong></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Laporan Harian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $intern->full_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a href="{{ route('reports.periode.interns', $intern->periode->id) }}"
                                    class="btn btn-primary me-3" style="width: 10%">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                                <div class="">
                                    {{-- <a class="btn btn-success verif-all" data-intern-id="{{ $intern->id }}"
                                        id="verifyAll"><i class="bi bi-check-all mr-2"
                                            style="margin-right: 10px"></i>Verifikasi
                                        Semua</a> --}}
                                    <a class="btn btn-primary btn-export-pdf " id="exportPDFReport"
                                        data-intern-id="{{ $intern->id }}" data-intern-name="{{ $intern->full_name }}"><i
                                            class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>Print PDF</a>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="mt-2 mb-4">
                                    <input type="hidden" name="intern_id" id="intern_id" value="{{ $intern->id }}">
                                    <p>Nama Lengkap : <strong class="text-primary">{{ $intern->full_name }}</strong></p>
                                    <p>Asal Sekolah : <strong class="text-primary">{{ $intern->school }}</strong></p>
                                    <p>Posisi Magang : <strong
                                            class="text-primary">{{ $intern->position->name ?? '-' }}</strong></p>
                                </div>
                                @include('components.alert')
                                <table class="table" id="tableReportByIntern" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Presensi</th>
                                            <th>Jam Hadir</th>
                                            <th>Instansi</th>
                                            <th>Nama Project</th>
                                            <th>Pekerjaan</th>
                                            <th>Keterangan</th>
                                            <th>Terlambat</th>
                                            <th>Konsekuensi</th>
                                            {{-- <th>Status</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        {{-- Modal Detail Keterlambatan --}}
                        <div class="modal fade" id="detailLateness" data-bs-backdrop="static" data-bs-keyboard="false"
                            aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <input type="hidden" class="form-control" id="report_id" name="report_id">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Detail Keterlambatan
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" class="form-control" id="report_id" name="report_id">
                                                <p>Terlambat <strong class="text-danger" id="lateness-duration"></strong>
                                                    dari
                                                    jam kehadiran</p>
                                                <div class="form-group">
                                                    <label for="">Total keterlambatan</label>
                                                    <div class="d-flex">
                                                        <p id="total-lateness-info">
                                                        <p>x pada <span class="text-primary" id="lateness-dates"></span></p>
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
                                                                        name="is_consequence_done" id="is_consequence_done"
                                                                        disabled>
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
                                                        name="consequence_description" readonly></textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Status Laporan</label>
                                                    <p><span id="status_report" class="badge bg-primary"></span></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Dibuat pada</label>
                                                    <p id="created_at"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Terakhir diubah pada</label>
                                                    <p id="updated_at"></p>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="">Alasan Admin</label>
                                                    <p id="admin_reason_detail"></p>
                                                </div> --}}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="backBtn">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Verifikasi --}}
                        <div class="modal fade" id="verifReport" data-bs-backdrop="static"
                            data-bs-keyboard="false"aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
                            tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-md">

                                <input type="hidden" class="form-control" id="report_id" name="report_id">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Tolak Laporan Harian
                                        </h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Alasan</label>
                                            <textarea name="admin_reason" id="admin_reason" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="backBtn">Kembali</button>
                                        <button type="submit" class="btn btn-primary" id="confirmReject">Ya,
                                            Tolak</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

        </section>
    </div>

    @push('table-report-interns')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Tooltip
            $(document).ready(function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                $('#tableReportByIntern').on('draw.dt', function() {
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
                        '[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                });
            });

            // Datatable
            $(document).ready(function() {
                let internId = $('#intern_id').val();

                if (!internId) {
                    console.error('Intern ID tidak ditemukan');
                    return;
                }

                let isResponsive = window.matchMedia("(max-width: 1024px)").matches;
                let tableReportByIntern = new DataTable('#tableReportByIntern', {
                    processing: true,
                    serverSide: true,
                    scrollX: !isResponsive,
                    responsive: isResponsive,
                    fixedHeader: true,
                    fixedColumns: {
                        start: 1,
                        end: 2
                    },
                    ajax: {
                        url: '{{ route('reports.intern.daily', ':internId') }}'.replace(':internId', internId),
                        type: 'GET',
                    },
                    columns: [{
                            data: 'date',
                            name: 'date',
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
                            class: 'table-fit'
                        },
                        {
                            data: 'attendance_time',
                            name: 'attendance_time',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                if (type === 'display' && data) {
                                    let time = data.split(':').slice(0, 2).join(':');
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
                                let isLate = (data === "1" || data === 1 || data === true);
                                if (isLate) {
                                    return '<a href="javascript:void(0)" data-report-id="' + row.id +
                                        '" class="openLatenessModal"><span class="badge bg-danger"><i class="bi bi-eye me-2"></i> Terlambat</span></a>';
                                } else {
                                    return '<span class="badge bg-info">Tidak Terlambat</span>';
                                }
                            },

                        },
                        {
                            data: 'is_consequence_done',
                            name: 'is_consequence_done',
                            render: function(data, type, row) {
                                let isLate = (row.is_late === "1" || row.is_late === 1 || row.is_late === true);

                                if (isLate) {
                                    let isConsequenceDone = (data === "1" || data === 1 || data === true);

                                    return isConsequenceDone ?
                                        '<span class="badge bg-primary">Sudah Melaksanakan</span>' :
                                        '<span class="badge bg-warning">Belum Melaksanakan</span>';
                                }
                                return '';
                            }


                        }
                    ]
                });
            });


            // Modal
            $(document).on('click', '.openLatenessModal', function() {
                var reportId = $(this).data('report-id');


                $.ajax({
                    // url: '{{ route('report.intern.lateness', '') }}/' + reportId,
                    url: '{{ route('report.intern.lateness', ':reportId') }}'.replace(':reportId', reportId),
                    method: 'GET',
                    success: function(response) {
                        var createdAt = new Date(response.result.created_at);
                        var updatedAt = new Date(response.result.updated_at);

                        $('#report_id').val(reportId);
                        $('#lateness-duration').text(response.lateness_duration);
                        $('#total-lateness-info').text(response.total_lateness);
                        $('#lateness-dates').text(response.lateness_dates);
                        $('#consequence_description').val(response.consequence_description);


                        if (response.is_consequence_done === "1" || response.is_consequence_done === 1 || response.is_consequence_done === true) {
                            $('#is_consequence_done').prop('checked', true);
                        } else {
                            $('#is_consequence_done').prop('checked', false);
                        }

                        $('#status_report').text(response.result.status);
                        $('#admin_reason_detail').text(response.result.admin_reason ? response.result
                            .admin_reason : '-');
                        $('#created_at').text(createdAt.toLocaleString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        }));

                        $('#updated_at').text(updatedAt.toLocaleString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        }));

                    },
                });
                $('#detailLateness').modal('show');
            });

            // Verify
            $(document).on('click', '#verifyBtn', function() {
                var reportId = $(this).data('report-id');

                Swal.fire({
                    icon: 'question',
                    title: 'Verifikasi',
                    text: 'Verifikasi laporan harian ini?',
                    confirmButtonText: 'Ya, Verifikasi',
                    confirmButtonColor: "#435EBE",
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Harap tunggu sebentar',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: '{{ route('report.intern.verify', '') }}/' + reportId,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                report_id: reportId
                            },
                            success: function(response) {
                                Swal.close();
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Laporan harian berhasil diverifikasi.',
                                        confirmButtonColor: "#435EBE",
                                    });

                                    $('#tableReportByIntern').DataTable().ajax.reload(null, false);
                                    $('#detailLateness').modal('hide');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: 'Gagal memverifikasi laporan. Coba lagi.',
                                        confirmButtonColor: "#435EBE",
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan!',
                                    text: 'Ada masalah saat memverifikasi laporan. Silakan coba lagi.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        });
                    }
                });
            });

            // Reject
            $(document).on('click', '#rejectBtn', function() {
                $('#verifReport').modal('show');
                var reportId = $(this).data('report-id');
                $('#report_id').val(reportId);

                $('#admin_reason').val('');
            });

            $(document).on('click', '#confirmReject', function() {
                var reportId = $('#report_id').val();
                var admin_reason = $('#admin_reason').val();

                Swal.fire({
                    title: 'Memproses...',
                    text: 'Harap tunggu sebentar',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('report.intern.reject', '') }}/' + reportId,
                    method: 'POST',
                    data: {
                        admin_reason: admin_reason
                    },
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            $('#verifReport').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Laporan berhasil ditolak.',
                                confirmButtonColor: "#435EBE",
                            });
                            $('#tableReportByIntern').DataTable().ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menolak laporan.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghubungi server.',
                            confirmButtonColor: "#435EBE",
                        });
                    }
                });
            });

            // Export PDF
            $('#exportPDFReport').on('click', function() {
                let id = $(this).data('intern-id');
                let internName = $(this).data('intern-name');

                Swal.fire({
                    title: 'Processing...',
                    text: 'Generating PDF, please wait...',
                    allowOutsideClick: false,
                    didOpen: function() {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('export.pdf.report', ':id') }}'.replace(':id', id),
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        Swal.close();

                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'Laporan Magang' + ' - ' + internName + '.pdf';
                        link.click();
                    },
                    error: function(xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to generate PDF. Please try again later.'
                        });
                        console.log(xhr.responseText);
                    }
                });
            });

            // Verify All
            $('#verifyAll').on('click', function() {

            });
        </script>
    @endpush
@endsection
