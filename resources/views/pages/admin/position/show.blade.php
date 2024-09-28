@extends('layouts.app')

@section('content')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
{{-- <div class="page-heading"> --}}
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Posisi</h3>
                <p class="text-subtitle text-muted">Baca Informasi dari detail Posisi</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('position.index') }}">Posisi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Posisi</li>
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
                            <div class="card-header">
                                {{-- <h3 class="card-title">Form Detail Posisi</h3> --}}
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
                                                <div class="card-body mt-2">
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefimage" class="form-control-label">Gambar
                                                                    <span class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    {{-- <input
                                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                                        type="file" id="fileimage" name="image"
                                                                        accept=".jpg, .jpeg, .png, .webp">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label> --}}
                                                                </div>

                                                                @if ($imageUrl)
                                                                    <a data-fancybox data-caption="Gambar Posisi "
                                                                        href="{{ $imageUrl }}">
                                                                        <img src="{{ $imageUrl }}" class="mt-3"
                                                                            alt="Gambar Posisi" width="70">
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Gambar</p>
                                                                @endif

                                                                @error('image')
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
                                                        <a type="button" class="btn btn-md btn-primary"
                                                            href="{{ route('position.index') }}">Kembali</a>

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
