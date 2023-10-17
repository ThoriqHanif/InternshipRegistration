@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
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
              <h3 class="card-title">Position Managament</h3>
              <a class="btn btn-md btn-success float-right" href="{{ route('position.create') }}"> + Posisi</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('components.alert')
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Syarat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($position as $key => $item)
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
                                    <h6 class="mb-0 text-sm">{{ $item ->name}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm mb-0">{{ $item->description }}</p>
                        </td>
                        <td class=" text-sm">
                            <p class="text-sm  mb-0">{{ $item->requirements }}</p>
                        </td>
                        <td class="align-middle text-center">
                            <div class="">
                              <button onclick="window.location ='{{ '/position/'.$item->id}}'" style="width: 60px" class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Posisi"> 
                                <li class="fas fa-eye"></li>
                            </button>
                                <button onclick="window.location ='{{ '/position/'.$item->id. '/edit' }}'" style="width: 60px" class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Posisi"> 
                                     <li class="fas fa-edit"></li>
                                 </button>
                                 <form style="display: inline" action="{{ url ('position/'.$item->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button" id="delete" style="width: 60px"> <li class="fas fa-trash"></li></button>
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
                {{ $position->links() }}
            </div>
          </div>
    </div>
  </section>
</div>
@endsection