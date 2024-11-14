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
                <h3>Detail Penilaian</h3>
                <p class="text-subtitle text-muted">Baca Informasi dari detail Penilaian</p>
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('evaluations.show', $evaluations->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">Intern Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Pemagang</label>
                                                                <input
                                                                    class="form-control @error('intern_id') is-invalid @enderror"
                                                                    type="text" value="{{ $evaluations->intern->full_name }}"
                                                                    name="intern_id" readonly>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Penilaian</label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="{{ $evaluations->name }}"
                                                                    name="name" readonly>
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Komentar</label>
                                                                <textarea class="form-control  @error('comment') is-invalid @enderror" type="text" name="comment" readonly>{{ $evaluations->comment }}</textarea>
                                                                @error('comment')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">File Information</p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="file"
                                                                    class="form-control-label mb-2">File</label>
                                                                <div class="custom-file">

                                                                </div>

                                                                @if ($fileUrl)
                                                                    @if ($fileExtension == 'pdf' || $fileExtension == 'docx')
                                                                        <button type="button" class="btn mt-2 btn-primary"
                                                                            id="file-link" data-bs-toggle="modal"
                                                                            data-bs-target="#fileModal"
                                                                            data-caption="File {{ $evaluations->name }}">
                                                                            <i class="bi bi-eye"></i>
                                                                        </button>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2" href="{{ $fileUrl }}"
                                                                        download data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh File">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                    @if ($fileExtension == 'png')
                                                                        <div class="mt-3">
                                                                            <a data-fancybox
                                                                                data-caption="File {{ $evaluations->name }}"
                                                                                href="{{ $fileUrl }}">
                                                                                <img src="{{ $fileUrl }}"
                                                                                    class="mt-3" alt="file"
                                                                                    width="200">
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger mt-2">Belum ada File
                                                                        Penilaian</p>
                                                                @endif
                                                                @error('file')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="modal fade" id="fileModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="fileModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="fileModalLabel">
                                                                                    File {{ $evaluations->name }}</h5>
                                                                                <button type="button" class="close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($fileExtension == 'pdf')
                                                                                    <object data="{{ $fileUrl }}"
                                                                                        type="application/pdf"
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        {{-- <button type="" class="btn btn-md btn-success">Update Status</button> --}}
                                                        <a href="{{ route('evaluations.index') }}" type="button" class="btn btn-md btn-primary mt-3"
                                                            >Kembali</a>

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
