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
                <h3>Tambah Blog</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Blog</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    {{-- {!! Breadcrumbs::render('intern.create') !!} --}}
                    {{ Breadcrumbs::render('blogs.create') }}
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data" id="formBlog">
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label mb-2">Kategori<span
                                                    class="text-danger">
                                                    *</span></label>
                                            <select
                                                class="form-select form-control @error('category_id') is-invalid @enderror"
                                                name="category_id">
                                                <option value="" selected disabled>Pilih Kategori
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label mb-2">Tags<span
                                                    class="text-danger"> *</span></label>
                                            <select
                                                class="form-select form-control tag-input @error('category_id') is-invalid @enderror"
                                                multiple="multiple" name="tags[]">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">
                                                        {{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label mb-2">Thumbnail<span
                                                    class="text-danger">
                                                    *</span></label>
                                            <div class="custom-file mb-2">
                                                <input class="form-control @error('image_thumbnail') is-invalid @enderror"
                                                    type="file" id="thumbnail" name="image_thumbnail"
                                                    accept=".jpg, .jpeg, .png, .webp">
                                            </div>
                                            <span class="text-muted ">Maksimal Ukuran Gambar 2 MB</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="status" id="status" value="draft">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="indonesia-tab" data-bs-toggle="tab" href="#indonesia"
                                            role="tab" aria-controls="indonesia" aria-selected="true">Indonesia</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="english-tab" data-bs-toggle="tab" href="#english"
                                            role="tab" aria-controls="english" aria-selected="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="indonesia" role="tabpanel"
                                        aria-labelledby="indonesia-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label mb-2">Judul
                                                        Artikel<span class="text-danger"> *</span></label>
                                                    <input class="form-control @error('title') is-invalid @enderror"
                                                        type="text" value="" name="title"
                                                        placeholder="Masukkan Judul">

                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="example-text-input"
                                                    class="form-control-label mb-2">Konten<span class="text-danger">
                                                        *</span></label>
                                                <div class="form-group">
                                                    <textarea id="body" class="form-control body" name="body" style="height: 300px">
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="english" role="tabpanel"
                                        aria-labelledby="english-tab">
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label mb-2">Article Title<span
                                                            class="text-danger"> *</span></label>
                                                    <input class="form-control @error('title_en') is-invalid @enderror"
                                                        type="text" value="" name="title_en"
                                                        placeholder="Input title">

                                                    @error('title_en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="example-text-input"
                                                    class="form-control-label mb-2">Content<span class="text-danger">
                                                        *</span></label>
                                                <div class="form-group">
                                                    <textarea id="body" class="form-control body" name="body_en" style="height: 300px">
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1"
                                        onclick="document.getElementById('status').value='published'">
                                        Publish
                                    </button>
                                    <button type="submit" class="btn btn-light-secondary me-1 mb-1"
                                        onclick="document.getElementById('status').value='draft'">
                                        Save as Draft
                                    </button>
                                    <a href="{{ route('blogs.index') }}" class="btn btn-danger me-1 mb-1">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        @push('script-blog-form')
            <script src="{{ asset('admin/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
            <script src="{{ asset('admin/assets/static/js/pages/summernote.js') }}"></script>
        @endpush

        <script>
            const image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/upload-image');

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.upload.onprogress = e => e.lengthComputable && progress(e.loaded / e.total * 100);

                xhr.onload = () => {
                    if (xhr.status === 403) return reject({
                        message: 'HTTP Error: ' + xhr.status,
                        remove: true
                    });
                    if (xhr.status < 200 || xhr.status >= 300) return reject('HTTP Error: ' + xhr.status);

                    try {
                        const json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location !== 'string') return reject('Invalid JSON: ' + xhr
                            .responseText);
                        resolve(json.location);
                    } catch (e) {
                        reject('Invalid JSON: ' + xhr.responseText);
                    }
                };

                xhr.onerror = () => reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });

            tinymce.init({
                selector: '#body',
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image code link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
                menubar: 'file edit view insert format tools table help',
                toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent | forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '5m',
                automatic_uploads: true,
                image_advtab: true,
                image_title: true,
                file_picker_types: 'image',
                images_upload_handler: image_upload_handler
            });


            $(document).ready(function() {
                $('.tag-input').select2({
                    tags: true,
                    tokenSeparators: [','],
                    placeholder: "",
                    ajax: {
                        url: '{{ route('api.tags') }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(tag) {
                                    return {
                                        id: tag.id,
                                        text: tag.name
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>


        {{-- SAVE --}}
        <script>
            $(document).ready(function() {
                $("#formBlog").on("submit", function(e) {
                    e.preventDefault();

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
                        url: '{{ route('blogs.store') }}',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disimpan.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    window.location.href = '{{ route('blogs.index') }}';
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
                                    Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data',
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
                                Swal.fire('Gagal', 'Terjadi kesalahan saat simpan data.', 'error');
                            }
                        },
                    });
                });
            });
        </script>
    @endsection
