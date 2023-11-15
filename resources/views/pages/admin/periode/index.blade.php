@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Periode Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Periode Management</li>
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
                                @if (auth()->check() && auth()->user()->role == 'admin')
                                    <a class="btn btn-sm btn-success float-right" href="{{ route('periode.create') }}"><i class="fas fa-plus mr-2 sm"></i>
                                        Periode</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                
                                

                                @include('components.alert')
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="tablePeriode">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Nama</th>
                                                <th>Posisi</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Kuota</th>
                                                <th>Deskripsi</th>
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
@push('table-periode')
<script>
    let tablePeriode = new DataTable('#tablePeriode', {
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('periode.index') }}"
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
                data: 'quota',
                name: 'quota'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'action',
                name: 'action'
            },


        ]
    });
</script>
@endpush
@endsection
