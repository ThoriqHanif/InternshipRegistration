@extends('layouts.front.app')

@section('content')
    <style>
        .img-thumbnail-custom {
            width: 400px !important;
            height: 150px !important;
            object-fit: cover !important;
        }
    </style>

    @include('layouts.front.navbar-blog')
    <div class="section search-result-wrap" style="margin-top: 5rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">Tag : {{ $tag->name }}</div>
                </div>
            </div>
            <div class="row posts-entry mt-3">
                @if ($blogsByTag->isEmpty())
                    <div class="col-lg-8 text-center">
                        <p>@lang('blog.blog_empty')</p>
                    </div>
                @else
                    <div class="col-lg-8">
                        @foreach ($blogsByTag as $blog)
                            <div class="blog-entry d-flex blog-entry-search-item">
                                <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                    class="img-link me-4">
                                    <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                        alt="Image" class="img-fluid img-thumbnail-custom">
                                </a>
                                <div>
                                    <span
                                        class="date">{{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                        &bullet; <a href="#">{{ $tag->name }}</a></span>
                                    <h2>
                                        <a
                                            href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">
                                            {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                        </a>
                                    </h2>
                                    <p></p>
                                    <p><a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                            class="btn btn-sm btn-outline-primary">Read More</a></p>
                                </div>
                            </div>
                        @endforeach
                        <div class="row text-start pt-5 border-top">
                            <div class="col-md-12">
                                <div class="custom-pagination">
                                    {{ $blogsByTag->links('vendor.pagination.default') }}

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4 sidebar">
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">Popular Posts</h3>
                        <div class="post-entry-sidebar">
                            <ul>
                                @forelse ($popularBlogs as $popular)
                                    <li>
                                        <a
                                            href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $popular->slug_en ? $popular->slug_en : $popular->slug]) }}">
                                            <img src="{{ asset('uploads/image_thumbnail/' . $popular->image_thumbnail) }}"
                                                alt="Image placeholder" class="me-4 rounded">
                                            <div class="text">
                                                <h4>
                                                    {{ app()->getLocale() == 'en' && $popular->title_en ? $popular->title_en : $popular->title }}
                                                </h4>
                                                <div class="post-meta">
                                                    <span class="mr-2">
                                                        {{ app()->getLocale() == 'en' ? $popular->published_at_formatted_en : $popular->published_at_formatted }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    @if (app()->getLocale() == 'en')
                                        <li>No popular posts available.</li>
                                    @else
                                        <li>Tidak ada postingan populer yang tersedia.
                                        </li>
                                    @endif
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-box">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            @forelse ($categories as $category)
                                <li>
                                    <a
                                        href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}">{{ $category->name }}
                                        <span>({{ $category->blog_count }})</span>
                                    </a>
                                </li>
                            @empty
                                <li>No categories available.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="sidebar-box">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            @forelse ($tags as $tag)
                                <li><a href="{{ route('home.blog.tag', ['locale' => app()->getLocale(), 'slug' => $tag->slug]) }}">{{ $tag->name }}</a></li>
                            @empty
                                <li>No tags available.</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('layouts.front.footer')
    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
@endsection



@push('style-landing')
    <!-- Assets Landing -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/assets/css/style.css') }}" rel="stylesheet">
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

@push('style-custom')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
