@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">Daily Report</li>
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
              {{-- <h3 class="card-title">User Managament</h3> --}}
              {{-- <a class="btn btn-sm btn-success float-right" href="{{ route('users.create') }}"><i class="fas fa-plus mr-2 sm"></i> User</a> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              @include('components.alert')
              <div class="table-responsive">
              <table class="table table-bordered table-hover" id="tableReport">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Tanggal</th>
                    <th>Presensi</th>
                    <th>Jam Kehadiran</th>
                    <th>Instansi</th>
                    <th>Nama Project</th>
                    <th>Pekerjaan</th>
                    <th>Keterangan</th>
                    <th style="width: 100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
           {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item {{ $user->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                                        <li class="page-item {{ $i == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $user->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div> --}}
          </div>
        </div>
        
    </div>
  </section>
</div>
@endsection