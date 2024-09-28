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
                <h3>Daftar User</h3>
                <p class="text-subtitle text-muted">Berikut daftar User Kadang Koding Indonesia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                                <a onclick="showDeletedIntern()"
                                    id="showDeletedButtonIntern">
                                </a>
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary tombol-create"
                                    data-placement="top" id="btn-create" data-tooltip-toggle="tooltip"
                                    title="Tambah Data User">
                                    + Tambah User
                                </a>
                            </div>

                            <div class="card-body">

                                @include('components.alert')
                                    <table class="table table-hover" id="tableUser">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th class="table-fit">Nama Lengkap</th>
                                                <th>Email</th>
                                                <th class="table-fit">Role</th>
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

    @push('table-user')
        <script>
            let tableUser = new DataTable('#tableUser', {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('users.index') }}"
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
                        name: 'name',
                        class: 'table-fit'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'role',
                        name: 'role',
                        class: 'table-fit, text-capitalize'
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
