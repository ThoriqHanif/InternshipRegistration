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

                <h3>
                    Daftar Pemagang
                </h3>
                <p class="text-subtitle text-muted">Berikut daftar Pemagang dengan periode</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                                <a href="{{ route('reports.index') }}" class="btn btn-primary me-3" style="width: 10%">
                                    <i class="bi bi-arrow-left"></i>
                                </a>
                                <a class="btn btn-primary btn-export-pdf" id="exportPDFIntern"
                                    data-periode-id="{{ $periode->id }}" data-periode-name={{ $periode->name }}>
                                    <i class="bi bi-printer-fill me-3"></i>
                                    Print PDF
                                </a>
                            </div>

                            <div class="card-body">
                                @include('components.alert')
                                <table class="table table-hover" id="tableInternByPeriode">
                                    <thead>
                                        <tr>
                                            <th class="table-fit">No</th>
                                            <th>Nama</th>
                                            <th class="table-fit">Posisi</th>
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

    @push('table-periode-interns')
        <script>
            $(document).ready(function() {
                let tableInternByPeriode = new DataTable('#tableInternByPeriode', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('reports.periode.interns', $periode->id) }}",
                        type: 'GET',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'full_name',
                            name: 'full_name',
                        },
                        {
                            data: 'position.name',
                            name: 'position.name',
                            class: 'table-fit',
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                let startDatePeriode = new Date(data);
                                return startDatePeriode.toLocaleDateString('id-ID', {
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
                                return endDatePeriode.toLocaleDateString('id-ID', {
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
                            class: 'table-fit',
                        },
                    ]
                });
            });

            // Export PDF
            $('#exportPDFIntern').on('click', function() {
                var id = $(this).data('periode-id');
                var periodeName = $(this).data('periode-name');


                Swal.fire({
                    title: 'Processing...',
                    text: 'Generating PDF, please wait...',
                    allowOutsideClick: false,
                    didOpen: function() {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('export.pdf.intern', ':id') }}'.replace(':id', id),
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
                        link.download = 'Laporan Magang' + ' - ' + periodeName + '.pdf';
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
        </script>
    @endpush
@endsection
