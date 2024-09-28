@extends('layouts.front.app')
<style>
    .post-content-body img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        border-radius: 10px;
        margin-bottom: 50px;

    }
</style>
@section('content')
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <div class="row g-0 align-items-center">
                        <div class="col-3 d-flex">
                            <a href="{{ route('blogs.index') }}" class=" m-0 float-start "><i
                                    class="bi bi-arrow-left me-3"></i>@lang('blog.back')</a>
                        </div>
                        <div class="col-6 text-center">
                            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                                <li class=""><a> @lang('blog.preview')</a></li>
                                <li class="has-children ">
                                    <a href="" style="color: #4154f1">@lang('blog.locale')</a>
                                    <ul class="dropdown nav nav-tabs" id="myTab" role="tablist">
                                        <li class="{{ app()->getLocale() == 'id' ? 'active' : '' }}">
                                            <a
                                                href="{{ route('blogs.show', ['locale' => 'id', 'slug' => $blog->slug]) }}">Indonesia</a>
                                        </li>
                                        <li class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                            <a
                                                href="{{ route('blogs.show', ['locale' => 'en', 'slug' => $blog->slug_en ?? $blog->slug]) }}">English</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="col-3 text-end">
                            <a href="#"
                                class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                                <span></span>
                            </a>

                            <a href="{{ route('blogs.edit', ['locale' => app()->getLocale(), 'slug' => $blog->slug]) }}"
                                class="btn-edit-article">Edit</a>

                            @if ($blog->status !== 'published')
                                <form id="formPublish" action="{{ route('blogs.publish', $blog->slug) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="published">
                                    <button type="submit" class="btn-publish" id="btnPublish"
                                        data-slug="{{ $blog->slug }}">Publish</but>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    @php
        $thumbnail = $blog->image_thumbnail
            ? asset('uploads/image_thumbnail/' . $blog->image_thumbnail)
            : 'default-image.jpg';
    @endphp
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ $thumbnail }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">
                            {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                        </h1>
                        <div class="post-meta align-items-center text-center">
                            @if ($blog->author && $blog->author->intern->photo && $blog->author->intern->photo)
                                <figure class="author-figure mb-0 me-3 d-inline-block">
                                    <img src="{{ asset('uploads/photo/' . $blog->author->intern->photo) }}"
                                        alt="{{ $blog->author->name }}">
                                </figure>
                            @else
                                <figure class="author-figure mb-0 me-3 d-inline-block">
                                    <img src="{{ asset('img/profile1.jpg') }}" alt="{{ $blog->author->name }}">
                                </figure>
                            @endif
                            <span class="d-inline-block mt-1">By {{ $blog->author->name }}</span>
                            <span>&nbsp;-&nbsp;
                                @if (app()->getLocale() == 'en')
                                    {{ $blog->published_at_formatted_en ?? 'Draft' }}
                                @else
                                    {{ $blog->published_at_formatted ?? 'Draft' }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">

                    <div class="post-content-body">
                        {!! app()->getLocale() == 'en' && $blog->body_en ? $blog->body_en : $blog->body !!}
                    </div>
                    <div class="pt-5 d-flex">
                        <p class="me-3">Categories:
                            <a href="#">{{ $blog->category->name }}</a>
                        </p>
                        <p>Tags:
                            @foreach ($tagNames as $tagName)
                                <a href="#">#{{ $tagName }}</a>
                            @endforeach
                        </p>
                    </div>

                </div>

                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    {{-- <div class="sidebar-box search-form-wrap">
                        <form action="#" class="sidebar-search-form">
                            <span class="bi-search"></span>
                            <input type="text" class="form-control" id="s"
                                placeholder="Type a keyword and hit enter">
                        </form>
                    </div> --}}
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">

                            @if ($blog->author && $blog->author->intern->photo && $blog->author->intern->photo)
                                <img src="{{ asset('uploads/photo/' . $blog->author->intern->photo) }}"
                                    alt="{{ $blog->author->name }}" class="img-fluid mb-3">
                            @else
                                <img src="{{ asset('img/profile1.jpg') }}" alt="{{ $blog->author->name }}"
                                    class="img-fluid mb-3">
                            @endif
                            <div class="bio-body">
                                <h2>{{ $blog->author->intern->full_name }}</h2>
                                <p class="mb-4">Author | {{ $blog->author->intern->position->name }}</p>
                                </p>
                                <p class="social">
                                    <a href="{{ $blog->author->intern->url ?? '#' }}" class="p-2"><span
                                            class="bi bi-globe2"></span></a>
                                    @foreach ($socialMedias as $sosmed)
                                        <a href="{{ $sosmed->url }}" class="p-2">
                                            <span class="{{ $sosmed->icon }}"></span>
                                        </a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style-custom')
    <style>
        .btn-edit-article {
            width: 100%;
            background-color: #778cd649;
            color: #435EBE;
            border-radius: 5px;
            padding: 10px 30px;
            margin: 3px
        }

        .btn-publish:hover {
            background-color: #5e7ce9;
            color: white;
        }

        .btn-publish {
            width: 120px;
            height: 38px;
            background-color: #435EBE;
            color: white;
            border-radius: 5px;
            border: none;
            margin: 3px
        }

        .btn-publish:hover {
            background-color: #5e7ce9;
            color: white;
        }
    </style>
@endpush

@push('style-blog')
    <!-- Assets Blog -->
    <link rel="stylesheet" href="{{ asset('blog/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('blog/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/css/flatpickr.min.css') }}">
@endpush

@push('script-global')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash) {
                history.replaceState(null, null, window.location.pathname + window.location.search);
            }
        });
    </script>

    <script>
        document.querySelectorAll('.change-lang').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedLang = this.getAttribute('data-lang');

                const currentUrl = window.location.pathname;
                let urlParts = currentUrl.split('/');

                if (urlParts[1] === 'en' || urlParts[1] === 'id') {
                    urlParts[1] = selectedLang;
                } else {
                    urlParts.splice(1, 0, selectedLang);
                }

                const queryString = window.location.search;
                const newUrl = urlParts.join('/') + queryString;
                window.location.href = newUrl;
            });
        });
    </script>
@endpush

@push('script-blog')
    <script src="{{ asset('blog/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('blog/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('blog/js/aos.js') }}"></script>
    <script src="{{ asset('blog/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('blog/js/navbar.js') }}"></script>
    <script src="{{ asset('blog/js/counter.js') }}"></script>
    <script src="{{ asset('blog/js/custom.js') }}"></script>
@endpush

@push('script-preview-blog')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal',
                                        'Terjadi kesalahan saat mempublish blog',
                                        'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.close();
                                Swal.fire('Gagal',
                                    'Terjadi kesalahan saat mempublish blog.',
                                    'error');
                            },
                        });
                    }
                });
            });
        });
    </script>
@endpush
