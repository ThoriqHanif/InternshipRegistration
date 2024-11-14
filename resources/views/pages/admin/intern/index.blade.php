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
                <h3>Daftar Pemagang</h3>
                <p class="text-subtitle text-muted">Berikut daftar Pemagang Kadang Koding Indonesia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('intern.index') }}
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="section mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Periode</label>
                                        <select class="choices form-select" id="filter-periode">
                                            <option value="" selected>All</option>
                                            @foreach ($periodes as $periode)
                                                <option value="{{ $periode->id }}">{{ $periode->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Posisi</label>
                                        <select class="choices form-select" id="filter-position">
                                            <option value="" selected>All</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Status</label>
                                        <select class="choices form-select" id="filter-status">
                                            <option value="" selected>All</option>
                                            <option value="pending">Pending</option>
                                            <option value="interview">Interview</option>
                                            <option value="accepted">Diterima</option>
                                            <option value="rejected">Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="btn-filter d-flex justify-content-end text-end">
                                    {{-- <a class="btn btn-sm btn-secondary me-2" id="btn-reset">Reset</a> --}}
                                    <a class="btn btn-sm btn-primary" id="btn-filter"><i
                                            class="bi bi-search me-2"></i>Filter</a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <div class="card-header mb-2"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="btn btn-sm btn-danger float-left text-white" onclick="showDeletedIntern()"
                            id="showDeletedButtonIntern">
                            <i class="bi bi-trash-fill mr-5" style="margin-right: 10px" id="showDeletedIcon"></i>
                            Data Terhapus
                        </a>
                        <a href="{{ route('intern.create') }}" class="btn btn-sm btn-primary tombol-create"
                            data-placement="top" id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Tipe">
                            + Pemagang
                        </a>
                    </div>
                @endif


                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        {{-- @if (auth()->check() && auth()->user()->role == 'admin')
                            <div class="filter-section d-flex align-items-center justify-content-between">
                                <label for="status-filter" style="margin-right: 20px">Cari Status : </label>

                                <div class="d-flex align-items-center">
                                    <select id="statusFilter" name="status" class="form-select" style="width: 200px">
                                        <option value="">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="interview">Interview</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                    @include('components.alert')
                    <table class="table" id="tableIntern">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Nama</th>
                                <th class="table-fit">Posisi</th>
                                <th>Sekolah</th>
                                <th class="table-fit">Status</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    @push('table-intern')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let tableIntern = new DataTable('#tableIntern', {
                "createdRow": function(row, data) {
                    let badgeClass = '';
                    if (data['status'] === 'interview') {
                        badgeClass = 'bg-primary';
                    } else if (data['status'] === 'pending') {
                        badgeClass = 'bg-warning';
                    } else if (data['status'] === 'rejected') {
                        badgeClass = 'bg-danger';
                    } else if (data['status'] === 'accepted') {
                        badgeClass = 'bg-success';
                    }
                    $(row).find('td:eq(4)').html('<span class="badge text-capitalize text-white px-2 ' + badgeClass + '">' + data['status'] + '</span>');
                },
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('intern.index') }}",
                    data: function(d) {
                        d.showDeleted = $('#showDeletedButtonIntern').data('show-deleted') ? 1 : 0;
                        d.status = $('#filter-status').val();
                        d.periode = $('#filter-periode').val();
                        d.position = $('#filter-position').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'position.name', name: 'position.name' },
                    { data: 'school', name: 'school' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' }
                ]
            });

            // Filter button event
            $('#btn-filter').on('click', function() {
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => { Swal.showLoading(); },
                });
                tableIntern.ajax.reload();
            });

            // Reset button event
            // $('#btn-reset').on('click', function() {
            //     $('#filter-periode').val('');
            //     $('#filter-position').val('');
            //     $('#filter-status').val('');
            //     $('#showDeletedButtonIntern').data('show-deleted', 0).html("Lihat Data Terhapus");
            //     tableIntern.ajax.reload();
            // });

            // Show/Hide deleted records toggle
            $('#showDeletedButtonIntern').on('click', function() {
                let isDeletedShown = $(this).data('show-deleted');
                $(this).data('show-deleted', !isDeletedShown);
                $(this).html(isDeletedShown ? "Lihat Data Terhapus" : "Lihat Semua");
                tableIntern.ajax.reload();
            });

            // Close loading indicator after DataTable redraw
            tableIntern.on('draw', function() {
                Swal.close();
            });
        });
    </script>
    @endpush

@endsection
