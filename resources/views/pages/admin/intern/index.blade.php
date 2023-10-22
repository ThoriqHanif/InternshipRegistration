@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Intern Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Intern Management</li>
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
                                <a class="btn btn-md btn-success float-right" href="{{ route('intern.create') }}"> +
                                    Pemagang</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- <div class="d-flex justify-content-between mb-2">
                                    @if (auth()->check() && auth()->user()->role == 'admin')
                                    <div class="filter-section">
                                        <label for="status-filter">Filter Status:</label>
                                        <select id="status-filter" name="status" class="form-control ">
                                            <option value="">All</option>
                                            <option value="pending">Pending</option>
                                            <option value="diterima">Diterima</option>
                                            <option value="ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div>
                                        <button id="filter-button" class="btn btn-sm btn-primary">Cari</button>
                                        <button id="reset-button" class="btn btn-sm btn-danger">Reset</button>
                                    </div>
                                    @endif
                                </div> --}}
                                <div class="d-flex justify-content-between mb-3">
                                    @if (auth()->check() && auth()->user()->role == 'admin')
                                    <div class="filter-section d-flex align-items-center justify-content-between">
                                        <label for="status-filter" class="mr-2">Filter Status:</label>

                                        <div class="d-flex align-items-center">
                                            <select id="status-filter" name="status" class="form-control" style="width: 200px">
                                                <option value="">All</option>
                                                <option value="pending">Pending</option>
                                                <option value="diterima">Diterima</option>
                                                <option value="ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <button id="filter-button" class="btn btn-sm btn-primary ml-2" style="width: 70px">Cari</button>
                                            <button id="reset-button" class="btn btn-sm btn-outline-secondary ml-2" style="width: 70px">Reset</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                @include('components.alert')
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Nama</th>
                                            <th>Sekolah</th>
                                            <th>Posisi</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $pageNumber = ($intern->currentPage() - 1) * $intern->perPage();
                                        @endphp
                                        @foreach ($intern as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $pageNumber + $key + 1 }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->full_name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm mb-0">{{ $item->school }}</p>
                                                </td>
                                                <td class=" text-sm">
                                                    <p class="text-sm mb-0">{{ $item->position->name }}</p>
                                                </td>
                                                <td class=" text-sm">
                                                    <p class="text-sm mb-0">{{ $item->start_date }}</p>
                                                </td>
                                                <td class=" text-sm">
                                                    <p class="text-sm mb-0">{{ $item->end_date }}</p>
                                                </td>
                                                 <td class=" text-sm">
                                                    <p class="text-sm mb-0">{{ $item->status }}</p>
                                                </td>
                                                {{-- <td class="align-middle text-end">
                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                <a class="btn-sm bg-gradient-warning text-sm">Edit</p>
                                <a class="btn btn-sm bg-danger text-sm ">Delete</p>
                            </div>
                        </td> --}}
                                                @if (auth()->check() && auth()->user()->role == 'admin')
                                                    <td class="align-middle text-center">
                                                        <div class="">
                                                            <a href="{{ route('intern.download', ['id' => $item->id]) }}"
                                                                class="btn btn-sm bg-info text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-placement="top" title="Download Files">
                                                                <li class="fas fa-download" data></li>
                                                            </a>
                                                            <a href ="{{ route('intern.show', $item->id) }}"
                                                                class="btn btn-sm bg-primary text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-placement="top" title="Detail Pemagang">
                                                                <li class="fas fa-eye"></li>
                                                            </a>
                                                            <a href="{{ route('intern.edit', $item->id) }}"
                                                                class="btn btn-sm bg-warning  text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-placement="top" title="Edit Pemagang">
                                                                <li class="fas fa-edit"></li>
                                                            </a>
                                                            <form style="display: inline"
                                                                action="{{ route('intern.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger delete-button"
                                                                    id="delete" data-toggle="tooltip" data-placement="top" title="Hapus Pemagang">
                                                                    <li class="fas fa-trash"></li>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                @endif
                                                @if (auth()->check() && auth()->user()->role == 'user')
                                                    <td class="align-middle text-center">
                                                        <div class="">
                                                            <a href="{{ route('intern.show', $item->id) }}"
                                                                class="btn btn-sm bg-primary text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-original-title="Edit Posisi">
                                                                <i class="fas fa-eye"></i>
                                                            </a>


                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item {{ $intern->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $intern->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @for ($i = 1; $i <= $intern->lastPage(); $i++)
                                        <li class="page-item {{ $i == $intern->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $intern->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $intern->currentPage() == $intern->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $intern->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>
@endsection

{{-- <script>
    document.getElementById('filter-button').addEventListener('click', function() {
        var selectedStatus = document.getElementById('status-filter').value;
        // Redirect to the route with the selected filter status
        window.location.href = '/intern?status=' + selectedStatus;
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        // Redirect to the route without any filter status
        window.location.href = '/intern';
    });
</script> --}}





