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
                                    <a class="btn btn-sm btn-success float-right" href="{{ route('intern.create') }}"><i class="fas fa-plus mr-2 sm"></i>
                                        Pemagang</a>
                                    <a class="btn btn-sm btn-danger float-left" onclick="showDeletedIntern()"
                                        id="showDeletedButtonIntern"><i id="showDeletedIcon" class="fas fa-trash mr-2"></i> Lihat Data Terhapus</a>
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
                                <div class="d-flex justify-content-between mb-4">
                                    @if (auth()->check() && auth()->user()->role == 'admin')
                                        <div class="filter-section d-flex align-items-center justify-content-between">
                                            <label for="status-filter" class="mr-2">Cari Status:</label>

                                            <div class="d-flex align-items-center">
                                                <select id="statusFilter" name="status" class="form-control"
                                                    style="width: 200px">
                                                    <option value="">All</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="diterima">Diterima</option>
                                                    <option value="ditolak">Ditolak</option>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="tableIntern" >
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Nama</th>
                                                <th>Sekolah</th>
                                                <th>Posisi</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Status</th>
                                                <th style="width: 140px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        {{-- <tbody>
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
                                    </tbody> --}}
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>

@endsection
