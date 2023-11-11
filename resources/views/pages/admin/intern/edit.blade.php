@extends('layouts.app-edit')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit pemagang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Intern Management</li>
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
                                <h3 class="card-title">Form Edit Pemagang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('intern.update', $id) }}" enctype="multipart/form-data"
                                id="formEditIntern">
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
                                                                value="{{ $id }}">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Email address<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    type="email" value="{{ $email }}"
                                                                    name="email" placeholder="Masukkan Email">
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Lengkap<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('full_name') is-invalid @enderror"
                                                                    type="text" value="{{ $full_name }}"
                                                                    name="full_name" placeholder="Masukkan Nama Lengkap">
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Panggilan<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    type="text" value="{{ $username }}"
                                                                    name="username" placeholder="Masukkan Nama Panggilan">
                                                                @error('username')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">No Telephone<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    type="number" value="{{ $phone_number }}"
                                                                    name="phone_number" placeholder="Masukkan Telp">
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jenis Kelamin<span
                                                                        class="text-danger"> *</span></label>

                                                                <select
                                                                    class="form-select form-control @error('gender') is-invalid @enderror"
                                                                    name="gender">
                                                                    <option value="" selected>Pilih Jenis Kelamin
                                                                    </option>
                                                                    @foreach ($genders as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $gender == $key ? 'selected' : '' }}>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
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
                                                                    class="form-control-label">Asal Sekolah<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('school') is-invalid @enderror"
                                                                    type="text" value="{{ $school }}"
                                                                    name="school" placeholder="Masukkan Asal Sekolah">
                                                                @error('school')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jurusan / Prodi<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    type="text" value="{{ old('major', $major) }}"
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Alamat<span
                                                                        class="text-danger"> *</span></label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text" value="" name="address"
                                                                    placeholder="Masukkan Alamat">{{ $address }}</textarea>
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
                                                                    class="form-control-label">Posisi<span
                                                                        class="text-danger"> *</span></label>
                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id">
                                                                    <option value="" selected>Pilih Posisi Magang
                                                                    </option>
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
                                                                    class="form-control-label">Tanggal Mulai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control @error('start_date') is-invalid @enderror"
                                                                        id="date" name="start_date"
                                                                        value="{{ $start_date }}" />
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
                                                                    class="form-control-label">Tanggal Selesai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date">
                                                                    <input type="date" id="end_date"
                                                                        class="form-control  @error('end_date') is-invalid @enderror"
                                                                        id="date" name="end_date"
                                                                        value="{{ $end_date }}" />
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
                                                                        class="custom-file-input @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>

                                                                @if ($cvUrl)
                                                                    @if ($cvExtension == 'pdf' || $cvExtension == 'docx')
                                                                        <a class="btn mt-2" id="cv-link"
                                                                            data-toggle="modal" data-target="#cvModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="CV {{ $full_name }}"
                                                                            class="text-sm text-primary"
                                                                            style="background-color: #7066e0"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat CV">
                                                                            <li class="fas fa-eye text-white"></li>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $cvUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh CV">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                    @if ($cvExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="CV {{ $full_name }}"
                                                                                href="{{ $cvUrl }}">
                                                                                <img src="{{ $cvUrl }}"
                                                                                    class="mt-3" alt="CV"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada CV</p>
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
                                                                                    CV {{ $full_name }}</h5>
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
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe src="{{ $cvHtmlPath }}" style="width: 100%; height: 600px;"></iframe>
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
                                                                        class="custom-file-input @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>
                                                                @if ($motivationLetterUrl)
                                                                    @if ($motivation_letterExtension == 'pdf' || $motivation_letterExtension == 'docx')
                                                                        <a class="btn mt-2" id="ml-link"
                                                                            data-toggle="modal" data-target="#mlModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Motivation Letter {{ $full_name }}"
                                                                            class="text-sm text-primary"
                                                                            style="background-color: #7066e0"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Motivation Letter">
                                                                            <li class="fas fa-eye text-white"></li>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $motivationLetterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Motivation Letter">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                    @if ($motivation_letterExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="Motivation Letter {{ $full_name }}"
                                                                                href="{{ $motivationLetterUrl }}">
                                                                                <img src="{{ $motivationLetterUrl }}"
                                                                                    class="mt-3" alt="Motivation Letter"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Motivation
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
                                                                                    Motivation Letter {{ $full_name }}
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
                                                                                        data="{{ $motivationLetterUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $motivationLetterUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($motivation_letterExtension == 'docx')
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe src="{{ $motivationLetterHtmlPath }}" style="width: 100%; height: 600px;"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $motivationLetterUrl }}"
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
                                                                        class="custom-file-input @error('cover_letter') is-invalid @enderror"
                                                                        type="file" id="fileSurat" name="cover_letter"
                                                                        accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($coverLetterUrl)
                                                                    @if ($cover_letterExtension == 'pdf' || $cover_letterExtension == 'docx')
                                                                        <a class="btn mt-2" id="ml-link"
                                                                            data-toggle="modal" data-target="#clModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Surat Pengantar {{ $full_name }}"
                                                                            class="text-sm text-primary"
                                                                            style="background-color: #7066e0"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Surat Pengantar">
                                                                            <li class="fas fa-eye text-white"></li>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $coverLetterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Surat Pengantar">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                    @if ($cover_letterExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="Surat Pengantar {{ $full_name }}"
                                                                                href="{{ $coverLetterUrl }}">
                                                                                <img src="{{ $coverLetterUrl }}"
                                                                                    class="mt-3" alt="Surat Pengantar"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Surat
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
                                                                                    Surat Pengantar {{ $full_name }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($cover_letterExtension == 'pdf')
                                                                                    <object data="{{ $coverLetterUrl }}"
                                                                                        type="application/pdf"
                                                                                        width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a
                                                                                                href="{{ $coverLetterUrl }}"
                                                                                                target="_blank">Download</a>
                                                                                            instead.</p>
                                                                                    </object>
                                                                                @elseif ($cover_letterExtension == 'docx')
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe src="{{ $coverLetterHtmlPath }}" style="width: 100%; height: 700px;"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a
                                                                                            href="{{ $coverLetterUrl }}"
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
                                                                        class="custom-file-input @error('portfolio') is-invalid @enderror"
                                                                        type="file" id="filePortfolio"
                                                                        name="portfolio" accept=".pdf, .docx, .png">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($portfolioUrl)
                                                                    @if ($portfolioExtension == 'pdf' || $portfolioExtension == 'docx')
                                                                        <a class="btn mt-2" id="p-link"
                                                                            data-toggle="modal" data-target="#pModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="Portfolio {{ $full_name }}"
                                                                            class="text-sm text-primary"
                                                                            style="background-color: #7066e0"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat Portfolio">
                                                                            <li class="fas fa-eye text-white"></li>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                                <a class="btn btn-info mt-2" href="{{ $portfolioUrl }}"
                                                                    download data-toggle="tooltip" data-placement="top"
                                                                    title="Unduh Portfolio">
                                                                    <li class="fas fa-download"></li>
                                                                </a>
                                                                @if ($portfolioExtension == 'png')
                                                                    <div class="mt-3">
                                                                        <a data-fancybox
                                                                            data-caption="Portfolio{{ $full_name }}"
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
                                                                                {{ $full_name }}</h5>
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
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe src="{{ $portfolioHtmlPath }}" style="width: 100%; height: 600px;"></iframe>
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
                                                                        class="custom-file-input @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".jpg, .jpeg, .png, .webp">
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
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
                                                                <label for="example-text-input" class="form-control-label">Status<span class="text-danger"> *</span></label>
                                                                <select class="form-select form-control @error('status') is-invalid @enderror" id="statusSelect" name="status">
                                                                    <option value="" selected disabled>Pilih Status</option>
                                                                    @foreach ($st as $key => $value)
                                                                        <option value="{{ $key }}" {{ $intern->status == $key ? 'selected' : '' }}>
                                                                            {{ $value }}
                                                                        </option>
                                                                    @endforeach
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
                                                                <h3 class="card-title">Kirim Pesan untuk Pemagang</h3>
                                                              </div>
                                                              <!-- /.card-header -->
                                                              <div class="card-body">
                                                                
                                                                <div class="form-group">
                                                                    <textarea id="messages" class="form-control" name="messages" style="height: 300px" data-previous-value="{{$messages}}">
                                                                    
                                                                    {{$messages}}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                  <div class="btn btn-default btn-file">
                                                                    <i class="fas fa-paperclip"></i> Attachment
                                                                    <input type="file" name="attachment">
                                                                  </div>
                                                                  <p class="help-block">Max. 32MB</p>
                                                                </div>
                                                              </div>
                                                              <!-- /.card-body -->
                                                              
                                                              <!-- /.card-footer -->
                                                            </div>
                                                            <!-- /.card -->
                                                        </div>
                                                    
                                                          
                                                    <div class="inline-block mt-3">
                                                        <button type=""
                                                            class="btn btn-md btn-success">Update</button>
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            onclick="window.history.back();">Cancel</button>

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
    
    
    {{-- <textarea id="messages" class="form-control" name="messages" style="height: 300px">
        {{$messages}}
    </textarea>
    
    <script>
        var messagesTextarea = document.getElementById('messages');
        var initialMessages = '{{$messages}}';
    
        document.getElementById('statusSelect').addEventListener('change', function() {
            var selectedValue = this.value;
            
            // Mengosongkan pesan jika status berubah
            if (selectedValue === 'diterima' || selectedValue === 'pending' || selectedValue === 'interview' || selectedValue === 'ditolak') {
                messagesTextarea.value = initialMessages;
            } else {
                messagesTextarea.value = '';
            }
        });
    </script> --}}
    

    <script>
        $('#messages').summernote({
          placeholder: 'Masukkan Pesan',
          tabsize: 2,
          height: 400
        });
      </script>
    <script>
        $(function () {
          //Add text editor
          $('#summernote').summernote()
        })
      </script>
    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox({
                buttons: ["slideShow", "fullScreen", "thumbs", "close"],
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan elemen input tanggal mulai dan tanggal selesai
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            // Parse tanggal hari ini
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Atur jam ke tengah malam

            // Tambahkan event listener pada perubahan input tanggal selesai
            endDateInput.addEventListener('change', function() {
                // Parse tanggal mulai dan tanggal selesai ke dalam objek Date
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                // Bandingkan tanggal dan lakukan validasi
                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                }
            });

            // Tambahkan event listener pada perubahan input tanggal mulai
            startDateInput.addEventListener('change', function() {
                // Parse tanggal mulai ke dalam objek Date
                var startDate = new Date(startDateInput.value);

                // Bandingkan tanggal mulai dengan tanggal hari ini
                if (startDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    startDateInput.value = '';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formEditIntern").on("submit", function(e) {
                e.preventDefault();

                var internId = "{{ $intern->id }}";

                // Tampilkan pesan "loading" saat akan mengirim permintaan AJAX
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('intern.update', ['intern' => ':internId']) }}'.replace(
                        ':internId', internId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        Swal.close();

                        if (response.success) {
                            // Redirect ke halaman index dengan pesan "success"
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('intern.index') }}';
                            });
                        } else {
                            // Jika validasi gagal, tampilkan pesan-pesan kesalahan
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
                            // Menampilkan pesan validasi error SweetAlert
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
@endsection
