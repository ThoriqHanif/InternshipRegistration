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
          <h3>Detail User</h3>
          <p class="text-subtitle text-muted">Baca Informasi dari detail User</p>
        </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail User</li>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{url ('users.show')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">User Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="hidden" name="id" value="{{ $id }}">
                                                <label for="example-text-input" class="form-control-label">Nama</label>
                                                <input class="form-control  @error('name') is-invalid @enderror" type="text" value="{{$name}}" name="name" placeholder="Masukkan Nama Lengkap" disabled>
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Email address</label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{$email}}" name="email" placeholder="Masukkan Email" disabled>
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Password</label>
                                                <input class="form-control  @error('password') is-invalid @enderror" type="text" value="{{$password}}" name="password" disabled>
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Role</label>
                                                
                                                <select class="form-select form-control @error('role') is-invalid @enderror" name="role" disabled>
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
                                    </div>
                                    <div class="inline-block mt-3">
                                        {{-- <button type="" class="btn btn-md btn-success">Ok</button> --}}
                                        <a type="button" class="btn btn-md btn-primary" href="{{route('users.index')}}">Kembali</a>
        
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