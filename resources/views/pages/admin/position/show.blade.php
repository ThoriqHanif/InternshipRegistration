@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Posisi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item active">Position Management</li>
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
                                <h3 class="card-title">Form Detail Posisi</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ url('position.show', $id) }}">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">Position Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama</label>
                                                                <input
                                                                    class="form-control @error('name') is-invalid @enderror"
                                                                    type="text" value="{{ $name }}"
                                                                    name="name" placeholder="Masukkan Nama" readonly>
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Deskripsi</label>
                                                                <textarea class="form-control  @error('description') is-invalid @enderror" type="text" value=""
                                                                    name="description" placeholder="Masukkan Deskripsi" readonly>{{ $description }}</textarea>
                                                                @error('description')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Syarat</label>
                                                                <div class="row mt-2">
                                                                    @foreach (['HTML', 'CSS', 'Javascript', 'PHP', 'Laravel', 'Figma', 'Photoshop', 'MySQL', 'Bootstrap'] as $requirement)
                                                                    <div class="col-md-2 mb-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="requirements[]" value="{{ $requirement }}"
                                                                                id="flexCheckDefault{{ $loop->index + 1 }}"
                                                                                name="requirements[]"
                                                                                @if(in_array($requirement, explode(', ', $requirements))) checked @endif disabled>   
                                                                            <label class="form-check-label">{{ $requirement }}</label><br>
                                                                            @error('requirements')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    @if(($loop->index + 1) % 5 == 0)
                                                                        </div><div class="row">
                                                                    @endif
                                                                    @endforeach
                                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        <button type="button" class="btn btn-md btn-primary"
                                                            onclick="window.history.back();">Ok</button>

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
