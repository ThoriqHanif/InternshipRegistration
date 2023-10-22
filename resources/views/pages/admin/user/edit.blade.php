@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {{-- <form method="POST" action="{{url ('users/'.$id)}}" enctype="multipart/form-data"> --}}
              <form method="POST" action="{{ route('users.update', $id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">User Information</p>
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $id }}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('name') is-invalid @enderror" type="text" value="{{$name}}" name="name" placeholder="Masukkan Nama" >
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Email address<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="text" value="{{$email}}" name="email" placeholder="Masukkan Email" >
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Role<span class="text-danger"> *</span></label>
                                                
                                                <select class="form-select form-control @error('role') is-invalid @enderror" name="role">
                                                    <option value="" selected >Pilih Role</option>
                                                    @foreach ($roles as $key => $value)
                                                        <option value="{{ $key }}" {{ $role == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Password<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('password') is-invalid @enderror" type="text" value="" name="password">
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline-block mt-3">
                                        <button type="" class="btn btn-md btn-success">Update</button>
                                        <button type="button" class="btn btn-md btn-secondary" onclick="window.history.back();">Cancel</button>
        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection