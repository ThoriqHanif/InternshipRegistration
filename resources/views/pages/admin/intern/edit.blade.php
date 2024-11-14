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
                <h3>Edit Pemagang</h3>
                <p class="text-subtitle text-muted">Masukkan data yang ingin diubah Informasi Pemagang</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{ Breadcrumbs::render('intern.edit') }}
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
                                <h3 class="card-title">Form Edit Pemagang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('intern.update', $intern->id) }}"
                                enctype="multipart/form-data" id="formEditIntern">
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
                                                            <input type="hidden" name="id"
                                                                value="{{ $intern->id }}">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Email address<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    type="email" value="{{ $intern->email }}"
                                                                    name="email" placeholder="Masukkan Email">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Nama Lengkap<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('full_name') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->full_name }}"
                                                                    name="full_name" placeholder="Masukkan Nama Lengkap">
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Nama Panggilan<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->username }}"
                                                                    name="username" placeholder="Masukkan Nama Panggilan">
                                                                @error('username')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">No Telephone<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    type="number" value="{{ $intern->phone_number }}"
                                                                    name="phone_number" placeholder="Masukkan Telp">
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Jenis Kelamin<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('gender') is-invalid @enderror"
                                                                    name="gender">
                                                                    <option value="" selected>Pilih Jenis Kelamin
                                                                    </option>
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
                                                                <label class="form-control-label">Asal Sekolah<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('school') is-invalid @enderror"
                                                                    type="text" value="{{ $intern->school }}"
                                                                    name="school" placeholder="Masukkan Asal Sekolah">
                                                                @error('school')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Jurusan / Prodi<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    type="text"
                                                                    value="{{ old('major', $intern->major) }}"
                                                                    name="major" placeholder="Masukkan Jurusan">
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
                                                                <label class="form-control-label">Alamat<span
                                                                        class="text-danger"> *</span></label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text" value="" name="address"
                                                                    placeholder="Masukkan Alamat">{{ $intern->address }}</textarea>
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
                                                                <label for="periode_id"
                                                                    class="form-control-label mb-2">Periode <span
                                                                        class="text-danger"> *</span></label>
                                                                <select id="periode_id"
                                                                    class="form-select form-control @error('periode_id') is-invalid @enderror"
                                                                    name="periode_id">
                                                                    <option value="" selected disabled>Pilih Periode
                                                                    </option>
                                                                    @foreach ($periodes as $periode)
                                                                        <option value="{{ $periode->id }}"
                                                                            {{ old('periode_id', $intern->periode_id ?? '') == $periode->id ? 'selected' : '' }}>
                                                                            {{ $periode->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('periode_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="position_id"
                                                                    class="form-control-label mb-2">Posisi <span
                                                                        class="text-danger"> *</span></label>
                                                                <select id="position_id"
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id">
                                                                    <option value="" selected disabled>Pilih Posisi
                                                                    </option>
                                                                    @if (isset($intern) && $intern->periode_id)
                                                                        @foreach ($intern->periode->positions as $position)
                                                                            <option value="{{ $position->id }}"
                                                                                {{ old('position_id', $intern->position_id ?? '') == $position->id ? 'selected' : '' }}>
                                                                                {{ $position->name }} | Kuota ({{ $position->pivot->quota }})
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @error('position_id')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Tanggal Mulai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control flatpickr-no-config @error('start_date') is-invalid @enderror"
                                                                        id="date" name="start_date"
                                                                        value="{{ $intern->start_date }}" />
                                                                    @error('start_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Tanggal Selesai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date">
                                                                    <input type="date" id="end_date"
                                                                        class="form-control flatpickr-no-config @error('end_date') is-invalid @enderror"
                                                                        id="date" name="end_date"
                                                                        value="{{ $intern->end_date }}" />
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
                                                                <label for="fileCV" class="form-control-label">CV<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png">
                                                                </div>

                                                                @if ($cvUrl)
                                                                    @if ($cvExtension == 'pdf' || $cvExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="cv-link"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#cvModal"
                                                                            data-caption="CV {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat CV">
                                                                            <i class="bi bi-eye"></i>
                                                                        </a>
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
                                                                                    data-dismiss="modal"
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
                                                                    class="form-control-label">Motivation Letter<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png">

                                                                </div>
                                                                @if ($motivation_letterUrl)
                                                                    @if ($motivation_letterExtension == 'pdf' || $motivation_letterExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="ml-link"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#mlModal"
                                                                            data-caption="Motivation Letter {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Motivation Letter">
                                                                            <i class="bi bi-eye"></i>
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
                                                                    <p class="text-sm text-danger mt-2">Belum ada
                                                                        Motivation
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
                                                                                    Motivation Letter
                                                                                    {{ $intern->full_name }}
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
                                                                        accept=".pdf, .docx, .png">
                                                                </div>

                                                                @if ($cover_letterUrl)
                                                                    @if ($cover_letterExtension == 'pdf' || $cover_letterExtension == 'docx')
                                                                        <a class="btn btn-primary mt-2" id="ml-link"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#clModal"
                                                                            data-caption="Surat Pengantar {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Surat Pengantar">
                                                                            <i class="bi bi-eye"></i>
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
                                                                                    Surat Pengantar
                                                                                    {{ $intern->full_name }}
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
                                                                                    <iframe
                                                                                        src="{{ $cover_letterHtmlPath }}"
                                                                                        style="width: 100%; height: 700px;"></iframe>
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
                                                                        name="portfolio" accept=".pdf, .docx, .png">
                                                                </div>

                                                                @if ($portfolioUrl)
                                                                    @if ($portfolioExtension == 'pdf' || $portfolioExtension == 'docx')
                                                                        <a class="btn mt-2 btn-primary" id="p-link"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#pModal"
                                                                            data-caption="Portfolio {{ $intern->full_name }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Portfolio">
                                                                            <i class="bi bi-eye"></i>
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
                                                                                        style="width: 100%; height: 600px;"></iframe>
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
                                                                    Foto<span class="text-danger"> *</span></label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="form-control @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".jpg, .jpeg, .png, .webp">
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Status<span
                                                                        class="text-danger"> *</span></label>
                                                                <select
                                                                    class="form-select form-control @error('status') is-invalid @enderror"
                                                                    id="status" name="status">
                                                                    <option value="" selected disabled>Pilih Status
                                                                    </option>
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
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Pesan Email</p>

                                                    <div class="col-md-14">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Kirim Pesan untuk Pemagang</h4>
                                                            </div>
                                                            <div class="card-body">

                                                                <div class="form-group">
                                                                    <div id="messages" class="form-control messages"
                                                                        name="messages" style="height: 300px"
                                                                        data-previous-value="{{ $intern->messages }}">

                                                                        {!! $intern->messages !!}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="inline-block mt-3">
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            onclick="window.history.back();">Cancel</button>
                                                        <button type=""
                                                            class="btn btn-md btn-primary">Update</button>
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

    @push('script-edit-intern')
        <script src="{{ asset('admin/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{ asset('admin/assets/static/js/pages/summernote.js') }}"></script>
    @endpush


    <script>
        $(document).ready(function() {
            $('#periode_id').change(function() {
                const periodeId = $(this).val();
                const currentPositionId = "{{ $intern->position_id ?? 0 }}";

                if (periodeId) {

                    const url = `{{ route('available.current.position', ['periode_id' => ':periodeId', 'current_position_id' => ':currentPositionId']) }}`
                    .replace(':periodeId', periodeId)
                    .replace(':currentPositionId', currentPositionId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(positions) {
                            $('#position_id').empty().append('<option value="" disabled selected>Pilih Posisi</option>');

                            positions.forEach(position => {
                            const quota = position.periodes.length > 0 ? position.periodes[0].pivot.quota : 0;

                            $('#position_id').append(`
                                <option value="${position.id}" ${position.id == currentPositionId ? 'selected' : ''}>
                                    ${position.name} | Kuota (${quota})
                                </option>
                            `);
                        });
                        }
                    });
                }
            });

            // Trigger change event on page load if periode_id is preselected
            if ($('#periode_id').val()) {
                $('#periode_id').trigger('change');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var initialStatus = '{{ $intern->status }}';

            var initialMessages = '{{ $intern->messages }}';
            $('#messages').summernote({
                placeholder: 'Masukkan Pesan',
                tabsize: 2,
                height: 400
            });

            // Tangani perubahan status
            $('#status').on('change', function() {
                var selectedStatus = $(this).val();
                var messagesTextarea = $('#messages');

                if (selectedStatus !== initialStatus) {
                    messagesTextarea.summernote('code', '');
                } else {
                    messagesTextarea.summernote('code', initialMessages);
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            var today = new Date();
            today.setHours(0, 0, 0, 0);

            endDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#435EBE',
                        cancelButtonColor: '#CDD3D8',
                    });

                    endDateInput.value = '';

                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#435EBE',
                        cancelButtonColor: '#CDD3D8',
                    });

                    endDateInput.value = '';
                }
            });

            // startDateInput.addEventListener('change', function() {
            //     var startDate = new Date(startDateInput.value);

            //     if (startDate < today) {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Oopss...',
            //             text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
            //             confirmButtonText: 'Ok',
            //             confirmButtonColor: '#435EBE',
            //             cancelButtonColor: '#CDD3D8',
            //         });

            //         startDateInput.value = '';
            //     }
            // });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formEditIntern").on("submit", function(e) {
                e.preventDefault();

                var internId = "{{ $intern->id }}";

                var messagesContent = $('#messages').summernote('code');

                var formData = new FormData(this);
                formData.append('messages', messagesContent);

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('intern.update', ['intern' => ':internId']) }}'.replace(
                        ':internId', internId),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                                confirmButtonColor: '#435EBE',
                                cancelButtonColor: '#CDD3D8',
                            }).then(function() {
                                window.location.href = '{{ route('intern.index') }}';
                            });
                        } else {
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
                                    'error');
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            var errorMessage = xhr.responseJSON
                            Swal.fire('Gagal', errorMessage,
                                'error');
                        }
                    },

                });
            });
        });
    </script>

@endsection
