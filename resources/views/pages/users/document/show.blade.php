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
                <h3>Detail Dokumen</h3>
                <p class="text-subtitle text-muted">Baca Informasi dari detail Dokumen</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{-- {{ Breadcrumbs::render('intern.show') }} --}}
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <p class="text-uppercase text-sm">Intern Information</p>
                                                <hr class="horizontal-dark">

                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <p class="mt-2">{{ $document->intern->full_name }}
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Asal Sekolah</label>
                                                    <p class="mt-2">{{ $document->intern->school }}
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Posisi Magang</label>
                                                    <p class="mt-2">
                                                        {{ $document->intern->position->name ?? '-' }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Tanggal Mulai</label>
                                                    <p class="mt-2">{{ \Carbon\Carbon::parse($document->intern->start_date)->format('d F Y') }}
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Tanggal Selesai</label>
                                                    <p class="mt-2">{{ \Carbon\Carbon::parse($document->intern->end_date)->format('d F Y') }}
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-uppercase text-sm">Document Information</p>
                                        <hr class="horizontal-dark">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <p class="mt-2">{{ $document->name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe</label>
                                            <p class="mt-2">{{
                                                $document->type === 'report' ? 'Laporan' :
                                                ($document->type === 'assesment' ? 'Penilaian' :
                                                ($document->type === 'announcement' ? 'Pengumuman' :
                                                ($document->type === 'certificate' ? 'Sertifikat' :
                                                ($document->type === 'evaluation' ? 'Evaluasi' :
                                                ($document->type === 'etc' ? 'Lainnya' : $document->type))))) }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">File </label>
                                            <div class="custom-file">
                                                {{-- <input
                                                    class="form-control @error('file') is-invalid @enderror"
                                                    type="file" id="file" name="file"
                                                    accept=".pdf, .docx, .png" readonly> --}}

                                            </div>
                                            @if ($fileUrl)
                                                @if ($fileExtension == 'pdf' || $fileExtension == 'docx')
                                                    <button type="button" class="btn mt-2 btn-primary" id="file-link"
                                                        data-bs-toggle="modal" data-bs-target="#fileModal"
                                                        data-caption="File {{ $document->name }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                @endif
                                                <a class="btn btn-info mt-2" href="{{ $fileUrl }}" download
                                                    data-toggle="tooltip" data-placement="top" title="Unduh File">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                                @if ($fileExtension == 'png')
                                                    <div class="mt-3">
                                                        <a data-fancybox data-caption="File {{ $document->name }}"
                                                            href="{{ $fileUrl }}">
                                                            <img src="{{ $fileUrl }}" class="mt-3" alt="file"
                                                                width="200">
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                <p class="text-sm text-danger mt-2">Belum ada File
                                                    Dokumen</p>
                                            @endif
                                            @error('file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div class="modal fade" id="fileModal" tabindex="-1" role="dialog"
                                                aria-labelledby="fileModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="fileModalLabel">
                                                                File {{ $document->name }}</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($fileExtension == 'pdf')
                                                                <object data="{{ $fileUrl }}" type="application/pdf"
                                                                    width="100%" height="600px">
                                                                    <p>Unable to display PDF file. <a
                                                                            href="{{ $fileUrl }}"
                                                                            target="_blank">Download</a>
                                                                        instead.</p>
                                                                </object>
                                                            @elseif ($fileExtension == 'docx')
                                                                <iframe src="{{ $fileHtmlPath }}"
                                                                    style="width: 100%; height: 600px;"></iframe>
                                                            @else
                                                                <p>File format not supported. <a
                                                                        href="{{ $fileUrl }}"
                                                                        target="_blank">Download</a>
                                                                    instead.</p>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Catatan</label>
                                                <p class="mt-2 text-muted">{{ $document->note }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
