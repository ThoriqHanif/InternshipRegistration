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
                <h3>Daftar Posisi</h3>
                <p class="text-subtitle text-muted">Berikut daftar Posisi magang Kadang Koding Indonesia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('position.index') }}
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
                        <a class="btn btn-sm btn-danger float-left text-white" onclick="showDeleted()"
                            id="showDeletedButton">
                            <i class="bi bi-trash-fill mr-5" style="margin-right: 10px" id="showDeletedIcon"></i>
                            Lihat Data Terhapus
                        </a>
                        <a href="{{ route('position.create') }}" class="btn btn-sm btn-primary tombol-create"
                            data-placement="top" id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Posisi"
                            >
                            + Tambah Posisi
                        </a>
                    </div>
                @endif


                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <div class="filter-section d-flex align-items-center justify-content-between">
                            </div>
                        @endif
                    </div>
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm" id="tablePosition">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th class="table-fit">Gambar</th>
                                <th class="table-fit">Nama</th>
                                <th>Syarat</th>
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
    </div>

    @push('table-position')
        <script>
            function showDeleted() {
                tablePosition.ajax.url("{{ route('position.index') }}?showDeleted=1").load();
                document.getElementById("showDeletedButton").innerHTML = "Lihat Semua";
                document.getElementById("showDeletedButton").setAttribute("onclick", "showAll()");
            }

            function showAll() {
                tablePosition.ajax.url("{{ route('position.index') }}?showDeleted=0").load();
                document.getElementById("showDeletedButton").innerHTML =
                    '<i id="showDeletedIcon" class="bi bi-trash mr-2"></i> Lihat Data Terhapus';
                document.getElementById("showDeletedButton").setAttribute("onclick", "showDeleted()");
            }


            let tablePosition = new DataTable('#tablePosition', {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('position.index') }}"
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            if (type === 'display') {
                                var imagePath = '{{ asset('uploads/image') }}/' + data;
                                return '<img src="' + imagePath + '" alt="Gambar Posisi" width="40" height="40">';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name',
                        class: 'table-fit'
                    },
                    {
                        data: 'requirements',
                        name: 'requirements'
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
