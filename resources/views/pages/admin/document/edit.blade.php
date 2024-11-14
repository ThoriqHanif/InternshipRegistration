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
                <h3>Edit Dokumen</h3>
                <p class="text-subtitle text-muted">Baca Informasi dari Edit Dokumen</p>
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
                            <form method="POST" action="{{ route('documents.update', $document->id) }}"
                                enctype="multipart/form-data" id="formEditDocument">
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
                                                                <select
                                                                    class="form-select mt-2  @error('intern') is-invalid @enderror"
                                                                    name="intern_id" id="intern">
                                                                    <option value="" selected disabled>-- Pemagang --
                                                                    </option>
                                                                    @foreach ($interns as $intern)
                                                                        <option value="{{ $intern->id }}"
                                                                            {{ $document->intern_id == $intern->id ? 'selected' : '' }}>
                                                                            {{ $intern->full_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tipe Dokumen <span class="text-danger">*</span></label>
                                                                <select name="type" id="type" class="form-select">
                                                                    <option value="" {{ old('type', $document->type) == '' ? 'selected' : '' }}>-- Tipe Dokumen --</option>
                                                                    <option value="report" {{ old('type', $document->type) == 'report' ? 'selected' : '' }}>Laporan</option>
                                                                    <option value="assesment" {{ old('type', $document->type) == 'assesment' ? 'selected' : '' }}>Penilaian</option>
                                                                    <option value="announcement" {{ old('type', $document->type) == 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                                                                    <option value="certificate" {{ old('type', $document->type) == 'certificate' ? 'selected' : '' }}>Sertifikat</option>
                                                                    <option value="evaluation" {{ old('type', $document->type) == 'evaluation' ? 'selected' : '' }}>Evaluasi</option>
                                                                    <option value="etc" {{ old('type', $document->type) == 'etc' ? 'selected' : '' }}>Lainnya</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Dokumen</label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="{{ $document->name }}"
                                                                    name="name">
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Komentar</label>
                                                                <textarea class="form-control  @error('note') is-invalid @enderror" type="text" name="note">{{ $document->note }}</textarea>
                                                                @error('note')
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
                                                                    <input
                                                                        class="form-control @error('file') is-invalid @enderror"
                                                                        type="file" id="file" name="file"
                                                                        accept=".pdf, .docx, .png">

                                                                </div>

                                                                @if ($fileUrl)
                                                                    @if ($fileExtension == 'pdf' || $fileExtension == 'docx')
                                                                        <button type="button" class="btn mt-2 btn-primary"
                                                                            id="file-link" data-bs-toggle="modal"
                                                                            data-bs-target="#fileModal"
                                                                            data-caption="File {{ $document->name }}">
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
                                                                                data-caption="File {{ $document->name }}"
                                                                                href="{{ $fileUrl }}">
                                                                                <img src="{{ $fileUrl }}"
                                                                                    class="mt-3" alt="file"
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
                                                                <div class="modal fade" id="fileModal" tabindex="-1"
                                                                    role="dialog" aria-labelledby="fileModalLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="fileModalLabel">
                                                                                    File {{ $document->name }}</h5>
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
                                                        <a href="{{ route('documents.index') }}"
                                                            class="btn btn-md btn-secondary">Cancel</a>
                                                        <button type="submit"
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

    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox({
                buttons: ["slideShow", "fullScreen", "thumbs", "close"],
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formEditDocument").on("submit", function(e) {
                e.preventDefault();

                var documentId = "{{ $document->id }}";

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
                    url: '{{ route('documents.update', ['document' => ':documentId']) }}' .replace(':documentId', documentId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            }).then(function() {
                                window.location.href =
                                    '{{ route('documents.index') }}';
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
                                .message;
                            Swal.fire('Gagal', errorMessage,
                                'error');
                        }
                    },

                });
            });
        });
    </script>
@endsection
