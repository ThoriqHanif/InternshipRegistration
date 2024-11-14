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
                <h3>Daftar Penilaian</h3>
                <p class="text-subtitle text-muted">Berikut daftar Penilaian Tugas Maganger </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
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
                <div class="card-header">
                    <h4 class="card-title">Filter</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mb-2">Tugas</label>
                                <select class="choices form-select">
                                    <option value="" selected>Pilih Tugas</option>
                                    @foreach ($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="mb-2">Posisi</label>
                                <select class="choices form-select">
                                    <option value="" selected>Pilih Posisi</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header mb-2 justify-content-end"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    {{-- <a href="{{ route('evaluations.create') }}" class="btn btn-sm btn-primary tombol-create float-right text-end"
                        data-placement="top" id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Penilaian">
                        + Tambah Penilaian
                    </a> --}}
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover" id="tableEvaluation">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th>Tugas</th>
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
        @push('table-evaluation')
            <script>
                let tableEvaluation = new DataTable('#tableEvaluation', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('evaluations.index') }}",
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
                            data: 'name',
                            name: 'name',
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
