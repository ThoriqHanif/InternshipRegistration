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
                <p class="text-subtitle text-muted">Berikut daftar Periode magang Kadang Koding Indonesia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('periode.index') }}">Periode</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Periode</li>
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
        <section class="section mt-2">
            <div class="card">
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <div class="card-header mb-2"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        <a class="" onclick="showDeleted()" id="showDeletedButton">
                            {{-- <i class="bi bi-trash-fill mr-5" style="margin-right: 10px" id="showDeletedIcon"></i> --}}

                        </a>
                        <a href="{{ route('periode.create') }}" class="btn btn-sm btn-primary tombol-create"
                            data-placement="top" id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Periode">
                            + Tambah Periode
                        </a>
                    </div>
                @endif


                <div class="card-body">
                    @include('components.alert')
                    <table class="table table-striped table-sm" id="tablePeriode">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
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
        </section>
        @include('pages.admin.periode.show')
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
                            searchable: false,
                            class: 'table-fit'
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
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
                            data: 'end_date',
                            name: 'end_date',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                let endDate = new Date(data);
                                return endDate.toLocaleDateString('id-ID', {
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

            <script>
                $(document).ready(function() {
                    $('#tablePeriode').on('click', 'a.detail-periode', function() {
                        var id = $(this).data('periode-id');

                        $.ajax({
                            url: '{{ route('periode.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                $('#detailPeriode').modal('show');
                                $('#id').val(response.result.id);
                                $('#name_detail').text(response.result.name);
                                $('#start_date_detail').text(response.result.start_date_formatted);
                                $('#end_date_detail').text(response.result.end_date_formatted);
                                $('#created_at_detail').text(response.result.created_at_formatted);
                                $('#updated_at_detail').text(response.result.updated_at_formatted);

                                $('#position_detail').empty();
                                $('#quota_detail').empty();

                                if (response.positions && response.positions.length > 0) {
                                    response.positions.forEach(function(position) {
                                        $('#position_detail').append('<li>' + position.name +
                                            ' (' + position.pivot.quota + ')</li>');
                                    });
                                } else {
                                    $('#position_detail').append('<li>Tidak ada posisi</li>');
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });
            </script>
        @endpush
    @endsection
