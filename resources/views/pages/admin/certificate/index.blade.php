@extends('layouts.app')


@section('content')
    {{-- <style>
        .certificate-wrapper {
            width: 100%;
            height: 100%;
            max-width: 595px;
            max-height: 842px;
        }

        @media screen and (max-width: 768px) {
            .certificate-wrapper {
                max-width: 100%;
            }
        }
    </style> --}}
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Sertifikat Magang</h3>
                <p class="text-subtitle text-muted">Berikut daftar Sertifikat berdasarkan tiap maganger</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Sertifikat Magang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div>
        </section>
        <section class="section mt-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Magangers</label>
                                        <select class="choices form-select" id="intern-filter">
                                            <option value="" selected>Pilih Maganger</option>
                                            @foreach ($interns as $intern)
                                                <option value="{{ $intern->id }}">{{ $intern->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a href="" class="btn btn-sm btn-primary mt-2 float-end" id="btn-preview"><i
                                            class="bi bi-eye me-2"></i>Preview</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex mb-3">
                        <a href="javascript:void(0)" id="btn-export-pdf" class="btn btn-primary text-end me-2" disabled>
                            <i class="bi bi-printer-fill me-3"></i>Export PDF
                        </a>

                        {{-- <a href="javascript:void(0)" id="btn-send-pdf" class="btn btn-primary text-end"><i
                                class="bi bi-send-fill me-3" disabled></i>Send
                            Document</a> --}}
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <iframe id="pdf-viewer" frameborder="0" width="100%" height="800px" style="overflow: hidden;" scrolling="no"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         {{-- Without PDF JS --}}
         @push('script-certificate')
         <script>
             let isPreviewed = false;
             let previewedFile = null;

             document.getElementById("btn-preview").addEventListener("click", function(event) {
                 event.preventDefault();

                 const internId = document.getElementById("intern-filter").value;

                 if (!internId) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Perhatian',
                         text: 'Silakan pilih Maganger terlebih dahulu.',
                         confirmButtonText: 'OK',
                         confirmButtonColor: "#435EBE",
                     });
                     return;
                 }

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
                     url: '{{ route('certificate.pdf', ':internId') }}'.replace(':internId', internId),
                     type: 'GET',
                     xhrFields: {
                         responseType: 'blob'
                     },
                     cache: false,
                     success: function(response) {
                         Swal.close();

                         const pdfViewer = document.getElementById('pdf-viewer');
                         const blobUrl = URL.createObjectURL(response);
                         pdfViewer.src = blobUrl;

                         pdfViewer.onload = function() {
                             URL.revokeObjectURL(blobUrl);
                         };

                         isPreviewed = true;
                         previewedFile = response;
                         document.getElementById("btn-export-pdf").disabled = false;
                     },
                     error: function() {
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'Terjadi kesalahan saat mengambil data.',
                             confirmButtonText: 'OK',
                             confirmButtonColor: "#435EBE",
                         });
                     }
                 });
             });

             document.getElementById("btn-export-pdf").addEventListener("click", function(event) {
                 event.preventDefault();

                 if (!isPreviewed) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Perhatian',
                         text: 'Silakan lakukan Preview terlebih dahulu sebelum mengekspor.',
                         confirmButtonText: 'OK',
                         confirmButtonColor: "#435EBE",
                     });
                     return;
                 }

                 const internId = document.getElementById("intern-filter").value;

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
                     url: '{{ route('export.certificate', ':internId') }}'.replace(':internId', internId),
                     type: 'GET',
                     xhrFields: {
                         responseType: 'blob'
                     },
                     success: function(response) {
                         Swal.close();

                         const blobUrl = URL.createObjectURL(response);
                         const a = document.createElement('a');
                         a.href = blobUrl;
                         a.download = 'Sertifikat Magang' + ' - ' + internName  + '.pdf';
                         a.click();
                         URL.revokeObjectURL(blobUrl);
                     },
                     error: function() {
                         Swal.fire({
                             icon: 'error',
                             title: 'Error',
                             text: 'Terjadi kesalahan saat mengambil data.',
                             confirmButtonText: 'OK',
                             confirmButtonColor: "#435EBE",
                         });
                     }
                 });
             });
         </script>
     @endpush

        {{-- @push('script-certificate')
            <script type="module">
                pdfjsLib.GlobalWorkerOptions.workerSrc = '{{ asset('js/pdf.worker.mjs') }}';

                let pdfDoc = null,
                    pageNum = 1,
                    pageRendering = false,
                    pageNumPending = null,
                    scale = 1,
                    canvas = document.getElementById("pdf-viewer"),
                    ctx = canvas.getContext("2d");

                document.getElementById("btn-preview").addEventListener("click", function(event) {
                    event.preventDefault();

                    const internId = document.getElementById("intern-filter").value;

                    if (!internId) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Silakan pilih Maganger terlebih dahulu.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: "#435EBE",
                        });
                        return;
                    }

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
                        url: '{{ route('api.intern.data', ':internId') }}'.replace(':internId', internId),
                        type: 'GET',
                        success: function(response) {
                            console.log(response);

                            Swal.close();
                            if (response) {
                                loadPdf(response.id);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Data intern tidak ditemukan.',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengambil data.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                });

                function loadPdf(internId) {
                    const pdfViewer = document.getElementById('pdf-viewer');
                    const url = '{{ route('certificate.pdf', ':internId') }}'.replace(':internId', internId);

                    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
                        pdfDoc.getPage(1).then(page => {
                            const viewport = page.getViewport({
                                scale: 1
                            });

                            // Pastikan ukuran canvas sesuai dengan PDF yang diambil
                            pdfViewer.width = viewport.width;
                            pdfViewer.height = viewport.height;

                            const context = pdfViewer.getContext('2d');
                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport,
                            };

                            // Render halaman pertama PDF ke dalam canvas
                            page.render(renderContext);
                        }).catch(error => {
                            console.error('Error rendering page:', error);
                        });
                    }).catch(error => {
                        console.error('Error loading PDF: ', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memuat file PDF.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: "#435EBE",
                        });
                    });
                }
            </script>
        @endpush --}}

        {{-- <script>
            document.getElementById("btn-preview").addEventListener("click", function(event) {
                event.preventDefault();

                const internId = document.getElementById("intern-filter").value;

                if (!internId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Silakan pilih Maganger terlebih dahulu.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#435EBE",
                    });
                    return;
                }

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
                    url: '{{ route('api.intern.data', ':internId') }}'.replace(':internId', internId),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);

                        Swal.close();
                        if (response) {
                            loadPdf(response.id);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Data intern tidak ditemukan.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengambil data.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: "#435EBE",
                        });
                    }
                });
            });

            function loadPdf(internId) {
                const url = '{{ route('certificate.pdf', ':internId') }}'.replace(':internId', internId);
                const viewerUrl = 'https://mozilla.github.io/pdf.js/web/viewer.html?file=';

                document.getElementById('pdf-viewer').src = viewerUrl + encodeURIComponent(url);
            }
        </script> --}}

        {{-- @push('script-certificate')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
            <script>
                document.getElementById("btn-preview").addEventListener("click", function(event) {
                    event.preventDefault();

                    const internId = document.getElementById("intern-filter").value;

                    if (!internId) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Silakan pilih Maganger terlebih dahulu.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: "#435EBE",
                        });
                        return;
                    }

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
                        url: '{{ route('certificate.pdf', ':internId') }}'.replace(':internId', internId),
                        type: 'GET',
                        success: function(response) {
                            Swal.close();

                            if (response && response.url) {
                                const viewerUrl = 'https://mozilla.github.io/pdf.js/web/viewer.html?file=';
                                const pdfUrl = encodeURIComponent(response.url);
                                document.getElementById('pdf-viewer').src = viewerUrl + pdfUrl;
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Gagal memuat URL sertifikat.',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan saat mengambil data.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                });
            </script>
        @endpush --}}


    @endsection
