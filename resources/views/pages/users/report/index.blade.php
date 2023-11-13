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
                    <th style="width: 100px">Jam Hadir</th>
                    <th>Instansi</th>
                    <th>Nama Project</th>
                    <th>Pekerjaan</th>
                    <th>Keterangan</th>
                    <th style="width: 50px">Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
              @include('pages.users.report.edit')
              </div>
            </div>
           
          </div>
        </div>
        
    </div>
  </section>
</div>
@endsection