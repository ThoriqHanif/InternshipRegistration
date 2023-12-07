@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Report</a></li>
                            <li class="breadcrumb-item active">Report Management</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <a class="btn btn-sm btn-secondary float-left text-white"
                                        id="buttonBack"><i id="backIcon" class="fas fa-arrow-circle-left mr-2 color-white"></i> Kembali</a>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-4">

                                </div>

                                @include('components.alert')
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="tablePeriode">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Nama</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>

                                                <th style="width: 140px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <table class="table table-bordered table-hover display" id="internByPeriode"
                                        style="display: none">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Nama</th>
                                                <th>Sekolah</th>
                                                <th>Posisi</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Status</th>
                                                <th style="width: 140px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <table class="table table-bordered table-hover display" id="reportByIntern"
                                        style="display: none">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Tanggal</th>
                                                <th>Presensi</th>
                                                <th>Jam Hadir</th>
                                                <th>Instansi</th>
                                                <th>Nama Project</th>
                                                <th>Pekerjaan</th>
                                                <th>Keterangan</th>
                                                <th style="width: 140px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>

    @push('table-report-intern')
        {{-- <script>
            $(document).ready(function() {
                // Fungsi untuk memuat status 'vermin' saat halaman dimuat
                function loadStatusVermin() {
                    $.ajax({
                        url: "{{ route('admin.report.status') }}",
                        method: 'GET',
                        success: function(response) {
                            // Loop melalui data 'vermin' yang diterima dari server
                            response.forEach(function(report) {
                                let reportId = report.id;
                                console.log(reportId);

                                // Temukan tombol dengan ID yang sesuai dan ubahnya menjadi 'Terverifikasi'
                                $(`.btn-vermin[data-report-id="${reportId}"]`).html(
                                    '<i class="nav-icon fas fa-check-circle mr-1"></i> Terverifikasi'
                                    );
                                $(`.btn-vermin[data-report-id="${reportId}"]`).removeClass(
                                    'btn-primary').addClass('btn-success');
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }

                // Panggil fungsi untuk memuat status 'vermin' saat halaman dimuat pertama kali
                loadStatusVermin();

                // ... Sisanya dari kode Anda tetap seperti yang Anda miliki sebelumnya
            });
        </script> --}}
        <script>
            let tablePeriode;
            let internByPeriode;
            let reportByIntern;

            $(document).ready(function() {

                // table Periode
                let tablePeriode = $('#tablePeriode').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('admin.report.index') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                });


                // table Intern
                $(document).on('click', '.btn-view-interns', function() {
                    let periodeId = $(this).data('periode-id');
                    console.log(periodeId);

                    $.ajax({
                        url: '/admin/intern/' + periodeId,
                        method: 'GET',
                        success: function(response) {
                            console.log(response)

                            tablePeriode.destroy();

                            let internByPeriode = $('#internByPeriode').DataTable({
                                "createdRow": function(row, data, dataIndex) {
                                    let badgeClass = '';
                                    let textColor = 'text-white';

                                    if (data['status'] === 'diterima') {
                                        badgeClass = 'bg-green';
                                    }

                                    $(row).find('td:eq(6)').html(
                                        '<span class="badge text-capitalize text-white px-2 ' +
                                        badgeClass + ' ' + textColor + '">' + data[
                                            'status'] + '</span>');

                                },
                                data: response,
                                processing: true,
                                responsive: true,
                                columns: [{
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return meta.row + meta.settings
                                                ._iDisplayStart + 1;
                                        },
                                        orderable: false,
                                        searchable: false
                                    },
                                    {
                                        data: 'full_name',
                                        name: 'full_name'
                                    },
                                    {
                                        data: 'school',
                                        name: 'school'
                                    },
                                    {
                                        data: 'position.name',
                                        name: 'position.name'
                                    },
                                    {
                                        data: 'start_date',
                                        name: 'start_date'
                                    },
                                    {
                                        data: 'end_date',
                                        name: 'end_date'
                                    },
                                    {
                                        data: 'status',
                                        name: 'status'
                                    },
                                    {
                                        data: null,
                                        render: function(data, type, row) {
                                            // console.log(row.id); 
                                            return '<a class="btn btn-sm btn-primary btn-view-report" data-intern-id="' +
                                                row.id +
                                                '"><i class="nav-icon fas fa-clipboard mr-1"></i> Daily Report</a>';
                                        },
                                        orderable: false,
                                        searchable: false
                                    }

                                ],
                                "drawCallback": function(settings) {
                                    $('#tablePeriode').hide();
                                    $('#reportByIntern').hide();
                                    $('#internByPeriode').show();
                                }
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });

                // tableReport
                $(document).on('click', '.btn-view-report', function() {
                    let internId = $(this).data('intern-id');
                    console.log(internId);

                    $.ajax({
                        url: '/admin/daily/' + internId,
                        method: 'GET',
                        success: function(response) {
                            console.log(response);

                            tablePeriode.destroy();
                            $('#internByPeriode').DataTable().destroy();

                            let reportByIntern = $('#reportByIntern').DataTable({
                                "createdRow": function(row, data, dataIndex) {
                                    let badgeClass = '';
                                    let textColor = 'text-white';

                                    if (data['presence'] !== null) {
                                        if (data['presence'] === 'masuk') {
                                            badgeClass = 'bg-green';
                                        } else if (data['presence'] === 'remote') {
                                            badgeClass = 'bg-purple';
                                        } else if (data['presence'] === 'izin') {
                                            badgeClass = 'bg-orange';
                                        } else if (data['presence'] === 'libur') {
                                            badgeClass = 'bg-red';
                                        }

                                        // Tambahkan badge ke dalam sel jika nilai presence tidak null
                                        $(row).find('td:eq(2)').html(
                                            '<span class="badge text-capitalize text-white px-2 ' +
                                            badgeClass + ' ' + textColor + '">' +
                                            data['presence'] + '</span>');
                                    } else {
                                        // Kosongkan sel jika nilai presence null
                                        $(row).find('td:eq(2)').html('');
                                    }

                                },
                                data: response,
                                processing: true,
                                responsive: true,
                                columns: [{
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return meta.row + meta.settings
                                                ._iDisplayStart + 1;
                                        },
                                        orderable: false,
                                        searchable: false
                                    },
                                    {
                                        data: 'date',
                                        name: 'date'
                                    },
                                    {
                                        data: 'presence',
                                        name: 'presence'
                                    },
                                    {
                                        data: 'attendance_hours',
                                        name: 'attendance_hours'
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
                                        data: null,
                                        render: function(data, type, row) {
                                            let buttonHtml = '';

                                            if (row.status === 'vermin') {
                                                buttonHtml =
                                                    '<a class="btn btn-sm btn-success btn-verified"><i class="nav-icon fas fa-check-circle mr-1"></i> Terverifikasi</a>';
                                            } else {
                                                buttonHtml =
                                                    '<a class="btn btn-sm btn-primary btn-view-report" data-intern-id="' +
                                                    row.id +
                                                    '"><i class="nav-icon fas fa-clipboard mr-1"></i> Daily Report</a>';
                                            }

                                            return buttonHtml;
                                        },
                                        orderable: false,
                                        searchable: false
                                    }
                                ],
                                "drawCallback": function(settings) {

                                    $('#tablePeriode').hide();
                                    $('#internByPeriode').hide();
                                    $('#reportByIntern').show();
                                }
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });
            });

            // Menangani klik pada tombol 'Vermin'
            $(document).on('click', '.btn-vermin', function(e) {
                e.preventDefault();
                let reportId = $(this).data('report-id');
                console.log(reportId);

                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Verifikasi Admin Laporan',
                    text: "Verifikasi laporan harian ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Verifikasi!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Sedang verifikasi admin...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });
                        // Lakukan pembaruan status ke 'vermin' di sini melalui AJAX
                        $.ajax({
                            method: 'POST',
                            url: '/admin/report/verify/' + reportId,
                            data: {
                                _token: '{{ csrf_token() }}',
                                report_id: reportId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terverifikasi!',
                                    'Berhasil Verifikasi Admin',
                                    'success'
                                );
                                let verminButton = $('.btn-vermin[data-report-id="' + reportId +
                                    '"]');
                                verminButton.html(
                                    '<i class="nav-icon fas fa-check-circle mr-1"></i> Terverifikasi'
                                );
                                verminButton.removeClass('btn-primary').addClass('btn-success');
                                verminButton.removeClass('btn-vermin').addClass('btn-verified');
                                reportByIntern.ajax.reload();
                            },
                            error: function(error) {
                                console.error(error);
                                // Tampilkan pesan kesalahan jika ada kesalahan dalam pembaruan
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat memverifikasi laporan.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
