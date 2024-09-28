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
                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <div class="filter-section d-flex align-items-center justify-content-between">
                                {{-- <label for="status-filter" style="margin-right: 20px">Cari Status : </label> --}}

                                <div class="d-flex align-items-center">
                                    <select id="statusFilter" name="status" class="form-select" style="width: 200px">
                                        <option value="">All</option>
                                        <option value="pending">Pending</option>
                                        <option value="interview">Interview</option>
                                        <option value="accepted">Diterima</option>
                                        <option value="rejected">Ditolak</option>
                                    </select>
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                <button id="filter-button" class="btn btn-sm btn-primary ml-2" style="width: 70px">Cari</button>
                                <button id="reset-button" class="btn btn-sm btn-outline-secondary ml-2" style="width: 70px">Reset</button>
                            </div> --}}
                            </div>
                        @endif
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
                var urlParams = new URLSearchParams(window.location.search);
                var selectedStatus = urlParams.get('status');
                var statusFilter = document.getElementById('status-filter');
                if (selectedStatus) {
                    statusFilter.value = selectedStatus;
                }

                document.getElementById('filter-button').addEventListener('click', function() {
                    var selectedStatus = statusFilter.value;
                    window.location.href = '/intern?status=' + selectedStatus;
                });

                document.getElementById('reset-button').addEventListener('click', function() {
                    window.location.href = '/intern';
                });
            });
        </script>
        <script>
            function showDeletedIntern() {
                tableIntern.ajax.url("{{ route('intern.index') }}?showDeleted=1&status=" + $('#statusFilter').val()).load();

                document.getElementById("showDeletedButtonIntern").innerHTML = "<span style='color: white'>Lihat Semua</span>";

                document.getElementById("showDeletedButtonIntern").setAttribute("onclick", "showAllIntern()");
            }

            function showAllIntern() {
                tableIntern.ajax.url("{{ route('intern.index') }}?showDeleted=0&status=" + $('#statusFilter').val()).load();

                document.getElementById("showDeletedButtonIntern").innerHTML =
                    '<i id="showDeletedIcon" class="bi bi-trash-fill mr-2 color-white"></i><span style="color: white"> Lihat Data Terhapus</span>';

                document.getElementById("showDeletedButtonIntern").setAttribute("onclick", "showDeletedIntern()");
            }

            let tableIntern = new DataTable('#tableIntern', {
                "createdRow": function(row, data, dataIndex) {
                    let badgeClass = '';
                    let textColor = 'text-white';

                    if (data['status'] === 'interview') {
                        badgeClass = 'bg-primary';
                    } else if (data['status'] === 'pending') {
                    badgeClass = 'bg-warning';
                    } else if (data['status'] === 'rejected') {
                        badgeClass = 'bg-danger';
                    } else if (data['status'] === 'accepted') {
                        badgeClass = 'bg-success';
                    }

                    $(row).find('td:eq(4)').html('<span class="badge text-capitalize text-white px-2 ' +
                        badgeClass + ' ' + textColor + '">' + data['status'] + '</span>');
                },

                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('intern.index') }}",
                    data: function(d) {
                        d.showDeleted = $('#showDeletedButtonIntern').data('show-deleted');
                        d.status = $('#statusFilter').val();

                    }
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
                        class: 'table-fit'
                    },
                    {
                        data: 'position.name',
                        name: 'position.name',
                        class: 'table-fit'
                    },
                    {
                        data: 'school',
                        name: 'school',

                    },
                    // {
                    //     data: 'start_date',
                    //     name: 'start_date',
                    //     class: 'table-fit',
                    //     render: function(data, type, row) {
                    //         let startDate = new Date(data);
                    //         return startDate.toLocaleDateString('id-ID', {
                    //             weekday: 'long',
                    //             year: 'numeric',
                    //             month: 'long',
                    //             day: 'numeric'
                    //         });
                    //     }
                    // },
                    // {
                    //     data: 'end_date',
                    //     name: 'end_date',
                    //     class: 'table-fit',
                    //     render: function(data, type, row) {
                    //         let endDate = new Date(data);
                    //         return endDate.toLocaleDateString('id-ID', {
                    //             weekday: 'long',
                    //             year: 'numeric',
                    //             month: 'long',
                    //             day: 'numeric'
                    //         });
                    //     }
                    // },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-capitalize, table-fit'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'table-fit'
                    },
                ],
                // columnDefs: [{
                //     targets: -1,
                //     responsivePriority: 1
                // }]
            });

            // Event handler untuk filter status
            $('#statusFilter').change(function() {
                tableIntern.ajax.reload(); // Memuat ulang data dengan filter status baru
            });
        </script>
    @endpush
@endsection
