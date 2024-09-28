@extends('layouts.front.app')
@section('content')
    <style>
        .img-link .img-first {
            width: 100% !important;
            height: 350px !important;
            object-fit: cover !important;
        }

        .img-link .img-second {
            width: 100% !important;
            height: 300px !important;
            object-fit: cover !important;
        }
    </style>
    @include('layouts.front.navbar-blog')

    {{-- TOP 6 Blog Popular dengan view count terbanyak --}}
    <section class="section" style="margin-top: 5rem !important;">
        <div class="container">
            <h2 class="posts-entry-title mb-4">Popular Posts</h2>
            @if ($popularBlogs->isEmpty())
                <div class="row">
                    <div class="col-12 text-center">
                        <p>@lang('blog.no_popular')</p>
                    </div>
                </div>
            @else
                <div class="row align-items-stretch retro-layout">
                    @foreach ($popularBlogs as $index => $blog)
                        @if ($index % 3 == 0 && $index != 0)
                </div>
                <div class="row align-items-stretch retro-layout">
            @endif
            <div class="col-md-4">
                <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                    class="h-entry mb-30 v-height gradient">
                    <div class="featured-img"
                        style="background-image: url('{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}');">
                    </div>
                    <div class="text">

                        <span class="date">
                            {{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                        </span>
                        <h2>
                            {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                        </h2>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
        </div>
    </section>

    @foreach ($categoryBlogs as $key => $blogs)
        @php $category = $categories[$key]; @endphp

        <section class="section posts-entry">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">{{ $category->name }}</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <a href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}"
                            class="read-more">View All</a>
                    </div>
                </div>

                <div class="row g-3">
                    @if ($blogs->isEmpty())
                            <div class="col-md-12 justify-content-center text-center">
                                <div class="alert">
                                    <p>@lang('blog.blog_empty')</p>
                                </div>
                            </div>
                    @else
                        <div class="col-md-9">
                            <div class="row g-3">

                                @foreach ($blogs as $blog)
                                    <div class="col-md-6">
                                        <div class="blog-entry">
                                            <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                class="img-link">
                                                <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                                    alt="Image" class="img-fluid img-first" loading="lazy">
                                            </a>
                                            <span
                                                class="date">{{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}</span>
                                            <h2>
                                                <a
                                                    href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">
                                                    {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                                </a>
                                            </h2>
                                            <p>
                                                {{-- Optional summary --}}
                                            </p>
                                            <p>
                                                <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                    class="btn btn-sm btn-outline-primary">Read More</a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                    @endif
                </div>
            </div>
            </div>
            </div>
        </section>
    @endforeach



    {{-- @if ($firstCategory)
        <section class="section posts-entry">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">{{ $firstCategory->name }}</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a
                            href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $firstCategory->slug]) }}"
                            class="read-more">View All</a></div>
                </div>
                <div class="row g-3">
                    <div class="col-md-9">
                        <div class="row g-3">
                            @if ($firstCategoryBlogs->isEmpty())
                                <div class="col-12">
                                    <p>@lang('blog.blog_empty')</p>
                                </div>
                            @else
                                @foreach ($firstCategoryBlogs as $blog)
                                    <div class="col-md-6">
                                        <div class="blog-entry">
                                            <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                class="img-link">
                                                <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                                    alt="Image" class="img-fluid img-first" loading="lazy">
                                            </a>
                                            <span class="date">
                                                {{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                            </span>
                                            <h2>
                                                <a
                                                    href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">
                                                    {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                                </a>
                                            </h2>
                                            <p>
                                                {{ app()->getLocale() == 'en' ? $blog->summary_en : $blog->summary }}
                                            </p>
                                            <p>
                                                <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                    class="btn btn-sm btn-outline-primary">Read More</a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($secondCategory)
        <section class="section posts-entry">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">{{ $secondCategory->name }}</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a
                            href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $secondCategory->slug]) }}"
                            class="read-more">View All</a></div>
                </div>
                <div class="row g-3">
                    <div class="col-md-9 order-md-2">
                        <div class="row g-3">
                            @if ($secondCategoryBlogs->isEmpty())
                                <div class="col-12">
                                    <p>@lang('blog.blog_empty')</p>
                                </div>
                            @else
                                @foreach ($secondCategoryBlogs as $blog)
                                    <div class="col-md-6">
                                        <div class="blog-entry">
                                            <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                class="img-link">
                                                <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                                    alt="Image" class="img-fluid img-second" loading="lazy">
                                            </a>
                                            <span class="date">
                                                {{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                            </span>
                                            <h2><a
                                                    href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">
                                                    {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                                </a></h2>
                                            <p>
                                                {{ app()->getLocale() == 'en' ? $blog->summary_en : $blog->summary }}
                                            </p>
                                            <p><a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                    class="btn btn-sm btn-outline-primary">Read More</a></p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($thirdCategory)
        <section class="section">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">{{ $thirdCategory->name }}</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a
                            href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $thirdCategory->slug]) }}"
                            class="read-more">View All</a></div>
                </div>

                <div class="row">
                    @if ($thirdCategoryBlogs->isEmpty())
                        <div class="col-12">
                            <p>@lang('blog.blog_empty')</p>
                        </div>
                    @else
                        @foreach ($thirdCategoryBlogs as $blog)
                            <div class="col-lg-4 mb-4">
                                <div class="post-entry-alt">
                                    <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                        class="img-link">
                                        <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                            alt="{{ $blog->title }}" class="img-fluid" loading="lazy">
                                    </a>
                                    <div class="excerpt">
                                        <h2><a
                                                href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">{{ $blog->title }}</a>
                                        </h2>
                                        <div class="post-meta align-items-center text-left clearfix">
                                            @if ($blog->author && $blog->author->intern->photo && $blog->author->intern->photo)
                                                <figure class="author-figure mb-0 me-3 float-start">
                                                    <img src="{{ asset('uploads/photo/' . $blog->author->intern->photo) }}"
                                                        alt="{{ $blog->author->name }}" class="img-fluid" loading="lazy">
                                                </figure>
                                            @else
                                                <figure class="author-figure mb-0 me-3 float-start">
                                                    <img src="{{ asset('img/profile1.jpg') }}"
                                                        alt="{{ $blog->author->name }}" class="img-fluid" loading="lazy">
                                                </figure>
                                            @endif
                                            <span class="d-inline-block mt-1">By
                                                <a>{{ $blog->author->intern->full_name }}</a></span>
                                            <span>&nbsp;-&nbsp;
                                                    {{ $blog->published_at }}
                                                {{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                            </span>

                                        </div>
                                        <p>{{ $blog->summary }}</p>
                                        <p><a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                                class="read-more">Read More</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if ($fourthCategory)
        <div class="section bg-light">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">{{ $fourthCategory->name }}</h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a
                            href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $fourthCategory->slug]) }}"
                            class="read-more">View All</a></div>
                </div>

                <div class="row align-items-stretch retro-layout-alt">
                    @if ($fourthCategoryBlogs->isEmpty())
                        <div class="col-12">
                            <p>@lang('blog.blog_empty')</p>
                        </div>
                    @else
                        @foreach ($fourthCategoryBlogs as $blog)
                            @if (intval($index) % 2 == 0)
                                <div class="col-md-5 order-md-2">
                                    <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                        class="hentry img-1 h-100 gradient">
                                        <div class="featured-img"
                                            style="background-image: url('{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}');">
                                        </div>
                                        <div class="text">
                                            <span>{{ app()->getLocale() == 'en' && $blog->published_at_formatted_en ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                            </span>
                                            <h2>{{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                            </h2>
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="col-md-7">
                                    <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                        class="hentry img-2 v-height mb30 gradient">
                                        <div class="featured-img"
                                            style="background-image: url('{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}');">
                                        </div>
                                        <div class="text text-sm">
                                            <span>{{ app()->getLocale() == 'en' && $blog->published_formatted_en ? $blog->published_formatted_en : $blog->published_formatted }}</span>
                                            <h2>{{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                                            </h2>
                                        </div>
                                    </a>

                                    @if ($index + 1 < count($fourthCategory))
                                        @php $nextBlog = $fourthCategory[$index + 1]; @endphp
                                        <div class="two-col d-block d-md-flex justify-content-between">
                                            <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => $nextBlog->slug]) }}"
                                                class="hentry v-height img-2 gradient">
                                                <div class="featured-img"
                                                    style="background-image: url('{{ asset('uploads/image_thumbnail/' . $nextBlog->image_thumbnail) }}');">
                                                </div>
                                                <div class="text text-sm">
                                                    <span>{{ $nextBlog->published_at_formatted }}</span>
                                                    <h2>{{ app()->getLocale() == 'en' ? $nextBlog->title_en : $nextBlog->title }}
                                                    </h2>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif --}}


    {{-- @include('layouts.front.footer') --}}

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
