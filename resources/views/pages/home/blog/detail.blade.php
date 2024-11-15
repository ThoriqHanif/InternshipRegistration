@extends('layouts.front.app')

@section('content')
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
    @include('layouts.front.navbar-blog')
    @php
        $thumbnail = $blog->image_thumbnail
            ? asset('uploads/image_thumbnail/' . $blog->image_thumbnail)
            : 'default-image.jpg';
    @endphp
    <div class="site-cover site-cover-sm same-height overlay single-page "
        style="background-image: url('{{ $thumbnail }}'); margin-top: 6rem;">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">
                            {{ app()->getLocale() == 'en' && $blog->title_en ? $blog->title_en : $blog->title }}
                        </h1>
                        <div class="post-meta align-items-center text-center">
                            @if ($blog->author)
                                <figure class="author-figure mb-0 me-3 d-inline-block">
                                    @if ($blog->author->isAdmin())
                                        <img src="{{ asset('img/admin.jpg') }}" alt="{{ $blog->author->name }}">
                                    @else
                                        @if ($blog->author->intern && $blog->author->intern->photo)
                                            <img src="{{ asset('uploads/photo/' . $blog->author->intern->photo) }}"
                                                alt="{{ $blog->author->name }}">
                                        @else
                                            <img src="{{ asset('img/profile1.jpg') }}" alt="{{ $blog->author->name }}">
                                        @endif
                                    @endif
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
                            <a
                                href="{{ route('home.blog.category', ['locale' => app()->getLocale(), 'slug' => $blog->category->slug]) }}">{{ $blog->category->name }}</a>
                        </p>
                        <p>Tags:
                            @foreach ($tagNames as $tagName)
                                <a href="">#{{ $tagName }}</a>
                            @endforeach
                        </p>
                    </div>

                    <div class="pt-5 comment-wrap">
                        <h3 class="mb-5 heading">{{ $comments->count() }} Comments</h3>
                        <ul class="comment-list">
                            @foreach ($comments as $comment)
                                @if (is_null($comment->parent_id))
                                    @include('partials.comment-list', ['comment' => $comment])
                                @endif
                            @endforeach
                        </ul>


                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5">Leave a comment</h3>
                            <form id="commentForm" class="p-5 bg-light">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <input type="hidden" name="parent_id" value="{{ $parent_id ?? null }}">

                                @if (Auth::check())
                                    <!-- Show name and email fields as hidden for logged-in users -->
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                @else
                                    <div class="form-group @error('name') is-invalid @enderror">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('email') is-invalid @enderror">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group @error('message') is-invalid @enderror">
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="g-recaptcha mt-4 mb-4 @error('g-recaptcha-response') is-invalid @enderror"
                                    data-sitekey="{{ config('services.recaptcha.key') }}">
                                    @error('g-recaptcha-response')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Post Comment" class="btn btn-primary">
                                </div>
                            </form>

                            <Toaster position="top-right" />

                        </div>
                    </div>

                </div>
                <!-- END main-content -->

                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            @if ($blog->author)
                                @if ($blog->author->isAdmin())
                                    <img src="{{ asset('img/admin.jpg') }}" alt="{{ $blog->author->name }}"
                                        class="img-fluid mb-3">
                                    <div class="bio-body">
                                        <h2>{{ $blog->author->name }}</h2>
                                        <p class="mb-4">Author | Admin</p>
                                    </div>
                                @else
                                    @if ($blog->author->intern && $blog->author->intern->photo)
                                        <img src="{{ asset('uploads/photo/' . $blog->author->intern->photo) }}"
                                            alt="{{ $blog->author->name }}" class="img-fluid mb-3">
                                        <div class="bio-body">
                                            <h2>{{ $blog->author->intern->full_name }}</h2>
                                            <p class="mb-4">Author | {{ $blog->author->intern->position->name }}</p>
                                        </div>
                                    @else
                                        <img src="{{ asset('img/profile1.jpg') }}" alt="{{ $blog->author->name }}"
                                            class="img-fluid mb-3">
                                        <div class="bio-body">
                                            <h2>{{ $blog->author->name }}</h2>
                                            <p class="mb-4">Author | Tanpa Posisi</p>
                                        </div>
                                    @endif
                                @endif

                                <p class="social">
                                    @if ($blog->author->isAdmin())
                                    @else
                                        <a href="{{ $blog->author->intern->url ?? '#' }}" class="p-2"><span
                                                class="bi bi-globe2"></span></a>
                                    @endif

                                    @foreach ($socialMedias as $sosmed)
                                        <a href="{{ $sosmed->url }}" class="p-2">
                                            <span class="{{ $sosmed->icon }}"></span>
                                        </a>
                                    @endforeach
                                </p>

                            @endif

                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <h3 class="heading">@lang('blog.popular')</h3>
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
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">@lang('blog.categories')</h3>
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
                    <!-- END sidebar-box -->

                    <div class="sidebar-box">
                        <h3 class="heading">Tags</h3>
                        <ul class="tags">
                            @forelse ($tags as $tag)
                                <li><a
                                        href="{{ route('home.blog.tag', ['locale' => app()->getLocale(), 'slug' => $tag->slug]) }}">{{ $tag->name }}</a>
                                </li>
                            @empty
                                <li>No tags available.</li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.front.footer')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            willClose: () => {
                window.location.reload();
            }
        });
        document.getElementById('commentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('comment.reply') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Comment posted successfully!'
                        });
                        document.getElementById('commentForm').reset();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error posting comment. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Network error. Please try again later.'
                    });
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            const savedName = localStorage.getItem('name');
            const savedEmail = localStorage.getItem('email');

            $('.reply').on('click', function(e) {
                e.preventDefault();
                const commentId = $(this).data('comment-id');
                const replyForm = $('#reply-form-' + commentId);

                if (savedName && savedEmail) {
                    replyForm.find('input[name="name"]').val(savedName);
                    replyForm.find('input[name="email"]').val(savedEmail);
                }

                replyForm.toggle();
            });

            $('.replyForm').on('submit', function(e) {
                e.preventDefault();
                const parentId = $(this).data('parent-id');
                const formData = $(this).serialize();

                const name = $(this).find('input[name="name"]').val();
                const email = $(this).find('input[name="email"]').val();

                localStorage.setItem('name', name);
                localStorage.setItem('email', email);

                $.ajax({
                    url: "{{ route('comment.reply') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#comment-' + parentId + ' .children').append(response.html);
                            $('#reply-form-' + parentId).hide();

                            Toast.fire({
                                icon: 'success',
                                title: 'Reply posted successfully'
                            });
                        }
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Failed to post reply'
                        });
                    }
                });
            });
        });
    </script>
@endpush
