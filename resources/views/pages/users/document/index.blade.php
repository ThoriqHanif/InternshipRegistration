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
                        <li class="breadcrumb-item"><a href="{{ url('document') }}">Dokumen</a></li>
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
            <div class="card">

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover" id="tableDocuments">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Tipe</th>
                                <th>Nama Dokumen</th>
                                <th class="table-fit">Dikirim Tanggal</th>
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

        @push('table-documents')
            <script>
                let tableDocuments = new DataTable('#tableDocuments', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('document') }}",
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
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
                                } else if (data === 'announcement'){
                                    return 'Pengumuman';
                                } else if(data === 'certificate'){
                                    return 'Sertifikat';
                                } else if(data === 'evaluation'){
                                    return 'Evaluasi';
                                } else if(data === 'etc'){
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
                            data: 'created_at',
                            name: 'created_at',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                let startDate = new Date(data);
                                return startDate.toLocaleDateString('id-ID', {
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


                    ]
                });
            </script>

        @endpush
    @endsection
