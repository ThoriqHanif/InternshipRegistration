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
            <h3>Edit Blog</h3>
            <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Blog</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                {{-- {!! Breadcrumbs::render('intern.create') !!} --}}
                {{ Breadcrumbs::render('blogs.edit') }}
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
            <form method="POST" action="{{ route('blogs.update', $blog->slug) }}" enctype="multipart/form-data"
                id="formEditBlog">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="slug" value="{{ $blog->slug }}">
                                        <label for="example-text-input" class="form-control-label mb-2">Kategori<span
                                                class="text-danger">
                                                *</span></label>
                                        <select
                                            class="form-select form-control @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            <option value="" selected disabled>Pilih Kategori
                                            </option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
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
                                            <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, old('tags', $blog->tag->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
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
                                        <div class="custom-file">
                                            <input class="form-control @error('image_thumbnail') is-invalid @enderror"
                                                type="file" id="thumbnail" name="image_thumbnail"
                                                accept=".jpg, .jpeg, .png, .webp">
                                        </div>
                                        @if ($imageThumbnailUrl)
                                        <a data-fancybox data-caption="Thumbnail" href="{{ $imageThumbnailUrl }}">
                                            <img src="{{ $imageThumbnailUrl }}" class="mt-3 img-fluid w-100" alt="Thumbnail">
                                        </a>
                                        @else
                                        <p class="text-sm text-danger">Belum ada Foto</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="status" id="status"
                                            value="{{ $blog->status }}">
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
                                                    type="text" value="{{ $blog->title }}" name="title"
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
                                                <textarea id="body" class="form-control body" name="body" style="height: 300px"> {!! $blog->body !!}</textarea>
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
                                                    type="text" value="{{ $blog->title_en }}" name="title_en"
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
                                                <textarea id="body" class="form-control body" name="body_en" style="height: 300px">{!! $blog->body_en !!}</textarea>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>

                                @if($blog->status == 'published')
                                    <button type="submit" class="btn btn-light-secondary me-1 mb-1"
                                        onclick="document.getElementById('status').value='draft'">
                                        Save as Draft
                                    </button>
                                @endif


                                </form>
                                @if($blog->status == 'draft')
                                <form id="formPublish" action="{{ route('blogs.publish', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="published">
                                        <button type="submit" class="btn btn-success me-1 mb-1">Publish</button>
                                    </form>
                                    <a href="{{ route('blogs.show', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}" class="btn btn-light-secondary me-1 mb-1">
                                        Preview
                                    </a>
                                @endif
                                <a href="{{ route('blogs.index') }}" class="btn btn-danger me-1 mb-1">Back</a>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    @push('script-blog-form')
    <script src="{{ asset('admin/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('admin/assets/static/js/pages/summernote.js') }}"></script>
    @endpush

    <script>
        $(document).ready(function() {
            $("#formPublish").on("submit", function(e) {
                e.preventDefault();

                var blogSlug = "{{ $blog->slug }}";

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Blog akan dipublikasikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#435EBE",
                    cancelButtonColor: "#CDD3D8",
                    confirmButtonText: 'Ya, publish sekarang!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                            url: `{{ route('blogs.publish', ['slug' => ':blogSlug']) }}`
                                .replace(
                                    ':blogSlug', blogSlug),
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: 'PUT',
                                status: 'published'
                            },
                            success: function(response) {
                                Swal.close();

                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Blog berhasil dipublikasikan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    }).then(function() {
                                        window.location.href = '{{ route('blogs.index') }}';

                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: 'Blog gagal dipublikasikan.',
                                        confirmButtonColor: "#435EBE",
                                        cancelButtonColor: "#CDD3D8",
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat mempublish blog.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                });
                            },
                        });
                    }
                });
            });
        });
    </script>

    <script>
        const image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                url: '{{ route("upload.image") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    const xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.onprogress = (e) => {
                            if (e.lengthComputable) {
                                progress(e.loaded / e.total * 100);
                            }
                        };
                    }
                    return xhr;
                },
                success: function(response) {
                    console.log('AJAX Response:', response);

                    try {
                        const json = typeof response === "string" ? JSON.parse(response) : response;
                        if (!json || typeof json.location !== 'string') {
                            reject('Invalid JSON: ' + response);
                        } else {
                            console.log('Image URL:', json.location);
                            resolve(json.location);
                        }
                    } catch (e) {
                        reject('Invalid JSON: ' + response);
                    }
                },
                error: function(xhr) {
                    console.log('AJAX Error', xhr.status);
                    if (xhr.status === 403) {
                        reject({
                            message: 'HTTP Error: ' + xhr.status,
                            remove: true
                        });
                    } else {
                        reject('HTTP Error: ' + xhr.status);
                    }
                }
            });
        });

        tinymce.init({
            selector: '#body',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image code link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            menubar: 'file edit view insert format tools table help',
            toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent | forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
            document_base_url: "https://internship.kadangkoding.com/thoriq/pendaftaran-magang/",
            convert_urls: false,
            relative_urls: false,
            automatic_uploads: true,
            image_advtab: true,
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


    <script>
        $(document).ready(function() {
            $("#formEditBlog").on("submit", function(e) {
                e.preventDefault();

                var blogSlug = "{{ $blog->slug }}";

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
                    url: `{{ route('blogs.update', ['slug' => ':blogSlug']) }}`.replace(':blogSlug', blogSlug),
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
                                window.location.href = '{{ route('blogs.show', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}';
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
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
    @endsection