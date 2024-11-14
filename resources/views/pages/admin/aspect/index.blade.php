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
                <h3>Daftar Aspek Penilaian</h3>
                <p class="text-subtitle text-muted">Berikut daftar Aspek Penilaian </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Daftar Aspek Penilaian</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="">
                                    <h4 class="card-title text-primary">Aspek Teknis</h4>
                                    <p>Daftar Aspek Teknis</p>
                                </div>
                                <a href="{{ route('technical-aspects.index') }}">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tablePreviewAspectTechnical">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Posisi</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($technical->take(10) as $tech)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $tech->positionAspects->pluck('name')->implode(', ') }}</td>
                                                    <td>{{ $tech->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="">
                                    <h4 class="card-title text-primary">Aspek Non Teknis</h4>
                                    <p>Daftar Aspek Non Teknis</p>
                                </div>
                                <a href="{{ route('non-technical-aspects.index') }}">View All</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" id="tablePreviewAspectNonTechnical">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($non_technical as $non)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $non->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
