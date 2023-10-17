@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pemagang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data</a></li>
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
              <h3 class="card-title">Intern Managament</h3>
              
              <a class="btn btn-md btn-success float-right" href="{{ route('intern.create') }}"> + Pemagang</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="d-flex justify-content-between mb-2">
                <div class="filter-section">
                    <label for="status-filter">Filter Status:</label>
                    <select id="status-filter" name="status" class="form-control" style="width: 200px">
                        <option value="">All</option>
                        <option value="pending">Pending</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div>
                  <button id="filter-button" class="btn btn-primary">Cari</button>
                    
                </div>
            </div>
              @include('components.alert')
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Posisi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($intern as $key => $item)
                    <tr>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $item ->full_name}}</h6>
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
                        {{-- <td class="align-middle text-end">
                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                <a class="btn-sm bg-gradient-warning text-sm">Edit</p>
                                <a class="btn btn-sm bg-danger text-sm ">Delete</p>
                            </div>
                        </td> --}}
                        <td class="align-middle text-center">
                            <div class="">
                                <a href="{{ route('intern.download', ['id' => $item->id]) }}" class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Download Files"> 
                                    <li class="fas fa-download"></li>
                                </a>
                                <a href ="{{ route('intern.show', $item->id) }}" class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Detail Intern"> 
                                  <li class="fas fa-eye"></li>
                              </a>
                                <a href="{{ route('intern.edit', $item->id) }}" class="btn btn-sm bg-warning  text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Intern"> 
                                     <li class="fas fa-edit"></li>
                                 </a>
                                 <form style="display: inline" action="{{ route ('intern.destroy', $item->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button" id="delete"> <li class="fas fa-trash"></li></button>
                                 </form>
                                
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $intern->links() }}
            </div>
          </div>
        </div>
        
    </div>
  </section>
</div>
@endsection