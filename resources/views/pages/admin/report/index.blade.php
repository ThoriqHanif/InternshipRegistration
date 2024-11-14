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
                <h3>Daftar Periode</h3>
                <p class="text-subtitle text-muted">Berikut daftar Periode Magang Kadang Koding Indonesia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Report</li>
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- @foreach ($interns as $intern)
                                    <a class="btn btn-primary btn-export-pdf display" style="display: none" id="pdfPrint"
                                        data-intern-id="{{ $intern->id }}" data-intern-name="{{ $intern->full_name }}"><i
                                            class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>Print PDF</a>
                                @endforeach

                                @foreach ($periode as $periode)
                                    <a class="btn btn-primary btn-export-pdf-intern display" style="display: none"
                                        id="pdfPrintIntern" data-periode-id="{{ $periode->id }}"
                                        data-periode-name="{{ $periode->name }}"><i class="bi bi-printer-fill mr-2"
                                            style="margin-right: 10px;"></i>Print
                                        PDF</a>
                                @endforeach

                                @foreach ($interns as $intern)
                                    <a class="btn btn-success display verif-all" data-intern-id="{{ $intern->id }}"
                                        style="display: none" id="verifAll"><i class="bi bi-check-all mr-2"
                                            style="margin-right: 10px"></i>Verifikasi
                                        Semua</a>
                                @endforeach --}}
                            </div>


                            <div class="card-body">
                                @include('components.alert')
                                <table class="table table-hover" id="tablePeriode">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th class="table-fit">Tanggal Mulai</th>
                                            <th class="table-fit">Tanggal Selesai</th>
                                            <th class="table-fit">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>

    @push('table-reports')
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
                        url: "{{ route('reports.index') }}",
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
                            name: 'name'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            class: 'table-fit',
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
                            class: 'table-fit',
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
                            name: 'action',
                            class: 'table-fit'

                        },
                    ],
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
                                            '<i class="nav-icon bi bi-check-circle-fill mr-1"></i> Terverifikasi'
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
