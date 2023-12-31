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
                            <div class="card-header">
                                @foreach ($interns as $intern)
                                    <a class="btn btn-primary btn-export-pdf display" style="display: none" id="pdfPrint"
                                        data-intern-id="{{ $intern->id }}" data-intern-name="{{ $intern->full_name }}"><i
                                            class="fas fa-print mr-2"></i>Print PDF</a>
                                @endforeach

                                @foreach ($periode as $periode)
                                    <a class="btn btn-primary btn-export-pdf-intern display" style="display: none"
                                        id="pdfPrintIntern" data-periode-id="{{ $periode->id }}"
                                        data-periode-name="{{ $periode->name }}"><i class="fas fa-print mr-2"></i>Print
                                        PDF</a>
                                @endforeach

                                @foreach ($interns as $intern)
                                    <a class="btn btn-success display verif-all" data-intern-id="{{ $intern->id }}"
                                        style="display: none" id="verifAll"><i
                                            class="fas fa-check-double mr-2"></i>Verifikasi
                                        Semua</a>
                                @endforeach


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-4 row">
                                    <div class="col-6">

                                        <div class="card px-3 py-3" id="internInfo" style="display: none">
                                            <h4 class="text-bold mb-4"> Detail Pemagang</h4>
                                            <div class="row px-3">
                                                <p class="text-bold mr-4">Nama Lengkap </p> <span>:</span>
                                                <p class="ml-4 text-primary" id="name"></p>
                                            </div>
                                            <div class="row px-3">
                                                <p class="text-bold mr-4">Asal Sekolah </p><span class="ml-3">:</span>
                                                <p class="ml-4 text-primary" id="school"></p>
                                            </div>
                                            <div class="row px-3">
                                                <p class="text-bold mr-4">Posisi Magang </p><span class="ml-2">:</span>
                                                <p class="ml-4 text-primary" id="position"></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="row invoice-info mb-3">
                                    
                                    <div class="col-sm-4 invoice-col">
                                        Detail Pemagang
                                        <address>
                                            <strong>{{$intern->name}}</strong><br>
                                            {{$intern->address}}<br>
                                            Phone: {{$intern->phone_number}}<br>
                                            Email: <a href="mail:to{{$intern->email}}">{{$intern->email}}</a>
                                            
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                   
                                    <!-- /.col -->
                                </div> --}}

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
                            name: 'start_date',
                            render: function(data, type, row) {
                                let startDatePeriode = new Date(data);
                                return startDatePeriode.toLocaleDateString(
                                    'id-ID', {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });
                            }
                        },
                        {
                            data: 'end_date',
                            name: 'end_date',
                            render: function(data, type, row) {
                                let endDatePeriode = new Date(data);
                                return endDatePeriode.toLocaleDateString(
                                    'id-ID', {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    });
                            }
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
                    let periodeName = $(this).data('periode-name');
                    console.log(periodeId);
                    console.log(periodeName);
                    $("#pdfPrintIntern").attr('data-periode-id', periodeId).attr('data-periode-name',
                        periodeName).show();

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
                                        name: 'start_date',
                                        render: function(data, type, row) {
                                            let startDateIntern = new Date(data);
                                            return startDateIntern
                                                .toLocaleDateString(
                                                    'id-ID', {
                                                        weekday: 'long',
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    });
                                        }
                                    },
                                    {
                                        data: 'end_date',
                                        name: 'end_date',
                                        render: function(data, type, row) {
                                            let endDateIntern = new Date(data);
                                            return endDateIntern.toLocaleDateString(
                                                'id-ID', {
                                                    weekday: 'long',
                                                    year: 'numeric',
                                                    month: 'long',
                                                    day: 'numeric'
                                                });
                                        }
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
                                                '" data-intern-name="' +
                                                row.full_name +
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
                                    $("#pdfPrintIntern").show();
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
                    let internName = $(this).data('intern-name');
                    console.log(internId);
                    console.log(internName);
                    $('#verifAll').attr('data-intern-id', internId).show();
                    $("#pdfPrint").attr('data-intern-id', internId).attr('data-intern-name', internName).show();
                    $("#verifAll").show();
                    $("#internInfo").show();
                    $("#pdfPrintIntern").hide();


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
                                        name: 'presence'
                                    },
                                    {
                                        data: 'attendance_hours',
                                        name: 'attendance_hours',
                                        render: function(data, type, row) {
                                            // Jika data adalah format waktu
                                            if (type === 'display' && data) {
                                                // Mengambil hanya jam dan menit
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
                                        data: null,
                                        render: function(data, type, row) {
                                            let buttonHtml = '';

                                            if (row.status === 'vermin') {
                                                buttonHtml =
                                                    '<a class="btn btn-sm btn-success btn-verified"><i class="nav-icon fas fa-check-circle mr-1"></i> Terverifikasi</a>';
                                            } else {
                                                buttonHtml =
                                                    '<a class="btn btn-sm btn-primary btn-vermin" data-report-id="' +
                                                    row.id +
                                                    '"><i class="nav-icon fas fa-check mr-1"></i> Vermin</a>';
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
                                    $("#pdfPrintIntern").hide();
                                }
                            });

                            $.ajax({
                                url: '/admin/intern/detail/' +
                                    internId, // URL untuk mengambil detail informasi intern berdasarkan intern_id
                                method: 'GET',
                                success: function(internInfo) {
                                    console.log(internInfo);

                                    // Update HTML elements with intern information
                                    $('#internInfo').show();
                                    $('#name').text(internInfo.full_name);
                                    $('#school').text(internInfo.school);
                                    $('#position').text(internInfo.position.name);
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });
            });

            // vermin
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

            $(document).on('click', '.verif-all', function(e) {
                e.preventDefault();
                var internId = $(this).attr('data-intern-id');
                console.log(internId);

                // Tampilkan SweetAlert konfirmasi untuk verifikasi semua
                Swal.fire({
                    title: 'Verifikasi Semua Laporan',
                    text: "Anda yakin ingin memverifikasi semua laporan?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Verifikasi Semua!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Sedang verifikasi semua laporan...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });

                        // Vermin all
                        $.ajax({
                            method: 'POST',
                            url: '/admin/report/' + internId + '/verify-all',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terverifikasi!',
                                    'Berhasil memverifikasi semua laporan.',
                                    'success'
                                );

                                $('.btn-vermin').each(function() {
                                    if ($(this).hasClass('btn-primary')) {
                                        // Hanya ubah tombol yang belum 'Terverifikasi'
                                        $(this).html(
                                            '<i class="nav-icon fas fa-check-circle mr-1"></i> Terverifikasi'
                                        );
                                        $(this).removeClass('btn-primary').addClass(
                                            'btn-success');
                                        $(this).removeClass('btn-vermin').addClass(
                                            'btn-verified');
                                    }
                                });

                                reportByIntern.ajax.reload();
                            },
                            error: function(error) {
                                console.error(error);
                                // Tampilkan pesan kesalahan jika terjadi kesalahan dalam verifikasi semua
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat memverifikasi semua laporan.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-export-pdf-intern', function() {
                let periodeId = $(this).data('periode-id');
                let periodeName = $(this).data('periode-name');
                console.log(periodeId);

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Generate PDF..',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                fetch('/admin/export/internByPeriode/' + periodeId)
                    .then(response => {
                        Swal.close();
                        return response.blob();
                    })
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'Laporan Magang Periode :' + periodeName + '.pdf';

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
                            text: 'Terjadi Kesahalahan'
                        });
                    });
            });

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

                fetch('/admin/export/reportByIntern/' + internId)
                    .then(response => {
                        Swal.close();
                        return response.blob();
                    })
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'Laporan Magang :' + internName + '.pdf';

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
                            text: 'Terjadi Kesahalahan'
                        });
                    });
            });
        </script>
    @endpush
@endsection
