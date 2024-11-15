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
                <h3>Detail Pemagang</h3>
                <p class="text-subtitle text-muted">Baca Informasi dari detail Pemagang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('intern.show') }}
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

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
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('intern.show', $intern->id) }}" enctype="multipart/form-data">
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Email address</label>
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    type="email" value="{{ $intern->email }}"
                                                                    name="email" placeholder="Masukkan Email" readonly>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Lengkap</label>
                                                                <input
                                                                    class="form-control  @error('full_name') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->full_name }}"
                                                                    name="full_name" placeholder="Masukkan Nama Lengkap"
                                                                    readonly>
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Panggilan</label>
                                                                <input
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->username }}"
                                                                    name="username" placeholder="Masukkan Nama Panggilan"
                                                                    readonly>
                                                                @error('username')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">No Telephone</label>
                                                                <input
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    type="number" value="{{ $intern->phone_number }}"
                                                                    name="phone_number" placeholder="Masukkan Telp"
                                                                    readonly>
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jenis Kelamin</label>

                                                                <select
                                                                    class="form-select form-control @error('gender') is-invalid @enderror"
                                                                    name="gender" disabled>
                                                                    <option value="male"
                                                                        {{ $intern->gender === 'male' ? 'selected' : '' }}>
                                                                        Laki-Laki</option>
                                                                    <option value="female"
                                                                        {{ $intern->gender === 'female' ? 'selected' : '' }}>
                                                                        Perempuan</option>

                                                                </select>

                                                                @error('gender')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">School Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Asal Sekolah</label>
                                                                <input
                                                                    class="form-control @error('school') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->school }}"
                                                                    name="school" placeholder="Masukkan Asal Sekolah"
                                                                    readonly>
                                                                @error('school')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jurusan / Prodi</label>
                                                                <input
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->major }}"
                                                                    name="major" placeholder="Masukkan Jurusan"
                                                                    readonly>
                                                                @error('major')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Contact Information</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Alamat</label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text"
                                                                    name="address" placeholder="Masukkan Alamat" readonly>{{ $intern->address }}</textarea>
                                                                @error('address')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Intern Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Posisi</label>
                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id" disabled>
                                                                    <option value="" selected readonly></option>
                                                                    @foreach ($positions as $position)
                                                                        <option value="{{ $position->id }}"
                                                                            {{ $position_id == $position->id ? 'selected' : '' }}>
                                                                            {{ $position->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('position_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Mulai</label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control @error('start_date') is-invalid @enderror"
                                                                        id="date" name="start_date"
                                                                        value="{{ $intern->start_date }}" readonly />
                                                                    @error('start_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Selesai</label>
                                                                <div class="input-group date">
                                                                    <input type="date" id="end_date"
                                                                        class="form-control  @error('end_date') is-invalid @enderror"
                                                                        id="date" name="end_date"
                                                                        value="{{ $intern->end_date }}" readonly />
                                                                    @error('end_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">File Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileCV"
                                                                    class="form-control-label mb-2">CV</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png" readonly>

                                                                </div>

                                                                @if ($cvUrl)
                                                                    @if ($cvExtension == 'pdf' || $cvExtension == 'docx')
                                                                        <button type="button" class="btn mt-2 btn-primary" id="cv-link" data-bs-toggle="modal" data-bs-target="#cvModal"                                                                            data-caption="CV {{ $intern->full_name }}">
                                                                            <i class="bi bi-eye"></i>
                                                                        </button>

                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $cvUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh CV">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                    @if ($cvExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="CV {{ $intern->full_name }}"
                                                                                href="{{ $cvUrl }}">
                                                                                <img src="{{ $cvUrl }}"
                                                                                    class="mt-3" alt="CV"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger mt-2">Belum ada CV</p>
                                                                @endif
                                                                @error('cv')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="modal fade" id="cvModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="cvModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="cvModalLabel">
                                                                                    CV {{ $intern->full_name }}</h5>
                                                                                <button type="button" class="close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($cvExtension == 'pdf')
                                                                                    <object data="{{ $cvUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $cvUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($cvExtension == 'docx')
                                                                                    {{-- DISINI UNTUK MELIHAT FILE DOCX --}}
                                                                                    <iframe src="{{ $cvHtmlPath }}"
                                                                                        style="width: 100%; height: 600px;"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $cvUrl }}"
                                                                                            target="_blank">Download</a>
                                                                                        instead.</p>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileMotivation"
                                                                    class="form-control-label">Motivation Letter</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png" readonly>

                                                                </div>
                                                                @if ($motivation_letterUrl)
                                                                    @if ($motivation_letterExtension == 'pdf' || $motivation_letterExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="ml-link"
                                                                            data-bs-toggle="modal" data-bs-target="#mlModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Motivation Letter {{ $intern->full_name }}"
                                                                            class="text-sm text-primary"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Motivation Letter">
                                                                            <i class="bi bi-eye text-white"></i>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $motivation_letterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Motivation Letter">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                    @if ($motivation_letterExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="Motivation Letter {{ $intern->full_name }}"
                                                                                href="{{ $motivation_letterUrl }}">
                                                                                <img src="{{ $motivation_letterUrl }}"
                                                                                    class="mt-3" alt="Motivation Letter"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger mt-2">Belum ada Motivation
                                                                        Letter</p>
                                                                @endif
                                                                @error('motivation_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror

                                                                <div class="modal fade" id="mlModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="mlModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="mlModalLabel">
                                                                                    Motivation Letter {{ $intern->full_name }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($motivation_letterExtension == 'pdf')
                                                                                    <object
                                                                                        data="{{ $motivation_letterUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $motivation_letterUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($motivation_letterExtension == 'docx')
                                                                                    <iframe
                                                                                        src="{{ $motivation_letterHtmlPath }}"
                                                                                        style="width: 100%; height: 600px;"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $motivation_letterUrl }}"
                                                                                            target="_blank">Download</a>
                                                                                        instead.</p>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat" class="form-control-label">Surat
                                                                    Pengantar</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('cover_letter') is-invalid @enderror"
                                                                        type="file" id="fileSurat" name="cover_letter"
                                                                        accept=".pdf, .docx, .png" readonly>
                                                                </div>

                                                                @if ($cover_letterUrl)
                                                                    @if ($cover_letterExtension == 'pdf' || $cover_letterExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="ml-link"
                                                                            data-bs-toggle="modal" data-bs-target="#clModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Surat Pengantar {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Surat Pengantar">
                                                                            <i class="bi bi-eye text-white"></i>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $cover_letterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Surat Pengantar">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                    @if ($cover_letterExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="Surat Pengantar {{ $intern->full_name }}"
                                                                                href="{{ $cover_letterUrl }}">
                                                                                <img src="{{ $cover_letterUrl }}"
                                                                                    class="mt-3" alt="Surat Pengantar"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger mt-2">Belum ada Surat
                                                                        Pengantar</p>
                                                                @endif
                                                                @error('motivation_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="modal fade" id="clModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="clModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="clModalLabel">
                                                                                    Surat Pengantar {{ $intern->full_name }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($cover_letterExtension == 'pdf')
                                                                                    <object data="{{ $cover_letterUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $cover_letterUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($cover_letterExtension == 'docx')
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe
                                                                                        src="{{ $coverLetterHtmlPath }}"
                                                                                        width="100%" height="600px"
                                                                                        frameborder="0"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $cover_letterUrl }}"
                                                                                            target="_blank">Download</a>
                                                                                        instead.</p>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat"
                                                                    class="form-control-label">Portfolio</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('portfolio') is-invalid @enderror"
                                                                        type="file" id="filePortfolio"
                                                                        name="portfolio" accept=".pdf, .docx, .png"
                                                                        readonly>
                                                                </div>

                                                                @if ($portfolioUrl)
                                                                    @if ($portfolioExtension == 'pdf' || $portfolioExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="p-link"
                                                                            data-bs-toggle="modal" data-bs-target="#pModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Portfolio {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Portfolio">
                                                                            <i class="bi bi-eye text-white"></i>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <a class="btn btn-info mt-2" href="{{ $portfolioUrl }}"
                                                                    download data-toggle="tooltip" data-placement="top"
                                                                    title="Unduh Portfolio">
                                                                    <i class="bi bi-download"></i>
                                                                </a>
                                                                @if ($portfolioExtension == 'png')
                                                                    <div class="mt-3">
                                                                        <a data-fancybox
                                                                            data-caption="Portfolio{{ $intern->full_name }}"
                                                                            href="{{ $portfolioUrl }}">
                                                                            <img src="{{ $portfolioUrl }}" class="mt-3"
                                                                                alt="Portfolio" width="200">
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                                @error('portfolio')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="modal fade" id="pModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="pModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">Portfolio
                                                                                {{ $intern->full_name }}</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($portfolioExtension == 'pdf')
                                                                                    <object data="{{ $portfolioUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $portfolioUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($portfolioExtension == 'docx')
                                                                                    <iframe src="{{ $portfolioHtmlPath }}"
                                                                                        width="100%" height="600px"
                                                                                        frameborder="0"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $portfolioUrl }}"
                                                                                            target="_blank">Download</a>
                                                                                        instead.</p>
                                                                                @endif
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefoto" class="form-control-label">Pas
                                                                    Foto</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".pdf, .docx, .png" readonly>
                                                                </div>

                                                                @if ($photoUrl)
                                                                    <a data-fancybox data-caption="Pas Foto"
                                                                        href="{{ $photoUrl }}">
                                                                        <img src="{{ $photoUrl }}" class="mt-3"
                                                                            alt="PAS Foto" width="200">
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Foto</p>
                                                                @endif

                                                                @error('photo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Status Information</p>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="example-text-input"
                                                                class="form-control-label">Status</label>

                                                            <select
                                                                class="form-select form-control @error('status') is-invalid @enderror"
                                                                name="status" disabled>
                                                                <option value="pending"
                                                                        {{ $intern->status === 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="interview"
                                                                        {{ $intern->status === 'interview' ? 'selected' : '' }}>
                                                                        Interview</option>
                                                                    <option value="accepted"
                                                                        {{ $intern->status === 'accepted' ? 'selected' : '' }}>
                                                                        Diterima</option>
                                                                    <option value="rejected"
                                                                        {{ $intern->status === 'rejected' ? 'selected' : '' }}>
                                                                        Ditolak</option>

                                                            </select>

                                                            @error('status')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        {{-- <button type="" class="btn btn-md btn-success">Update Status</button> --}}
                                                        <button type="button" class="btn btn-md btn-primary mt-3"
                                                            onclick="window.history.back();">Kembali</button>

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

<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({
            buttons: ["slideShow", "fullScreen", "thumbs", "close"],
        });
    });
</script>
