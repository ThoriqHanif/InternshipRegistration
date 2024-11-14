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
                <h3>Daftar Blog</h3>
                <p class="text-subtitle text-muted">Berikut daftar Blog anda </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('blogs') }}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Blog</li>
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

                    <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary tombol-create float-right text-end"
                        data-placement="top" id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Periode">
                        + Tambah Blog
                    </a>
                </div>

                <div class="card-body">
                    @include('components.alert')
                    <table class="table table-hover" id="tableBlog">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Kategori</th>
                                <th>Judul</th>
                                <th class="table-fit">Status</th>
                                <th class="table-fit">Tanggal Dibuat</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @push('table-blog')
            <script>
                let tableBlog = new DataTable('#tableBlog', {
                    "createdRow": function(row, data, dataIndex) {
                        let badgeClass = '';
                        let textColor = 'text-white';

                        if (data['status'] === 'draft') {
                            badgeClass = 'bg-warning';
                        } else if (data['status'] === 'published') {
                            badgeClass = 'bg-success';
                        } else if (data['status'] === 'archived') {
                            badgeClass = 'bg-danger';
                        }

                        $(row).find('td:eq(3)').html('<span class="badge text-capitalize text-white px-2 ' +
                            badgeClass + ' ' + textColor + '">' + data['status'] + '</span>');
                    },
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('blogs.index') }}",
                        type: 'GET'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'category.name',
                            name: 'category.name',
                            class: 'table-fit'
                        },
                        {
                            data: 'title',
                            name: 'title',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            class: 'table-fit'

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
