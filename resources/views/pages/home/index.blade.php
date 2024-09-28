@extends('layouts.front.app')

@section('content')
    <!-- ======= Header ======= -->
    @include('layouts.front.navbar')

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">@lang('home.hero_title')</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">@lang('home.hero_desc')</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>@lang('home.btn_start')</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('landing/assets/img/hero-img.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="row gx-0">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>@lang('home.about_title')</h3>
                            <h2>@lang('home.about_sub_title')</h2>
                            <p>
                                @lang('home.hero_desc')
                            </p>
                            <div class="text-center text-lg-start">
                                <a href="#journey"
                                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>@lang('home.about_more')</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('img/Scenes01.svg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $registerTotal }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>@lang('home.registered')</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $availablePositions }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>@lang('home.available')</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-check-all" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $acceptedIntern }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>@lang('home.accept')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Counts Section -->

        <!-- ======= Values Section ======= -->
        <section id="journey" class="values">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>@lang('home.journey_title')</h2>
                    <p>@lang('home.journey_sub_title')</p>
                </header>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="assets/img/values-1.png" class="img-fluid" alt="">
                            <h3>@lang('home.journey_1_title')</h3>
                            <p>@lang('home.journey_1_desc')</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box">
                            <img src="assets/img/values-2.png" class="img-fluid" alt="">
                            <h3>@lang('home.journey_2_title')</h3>
                            <p>@lang('home.journey_2_desc')</p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src="assets/img/values-3.png" class="img-fluid" alt="">
                            <h3>@lang('home.journey_3_title')</h3>
                            <p>@lang('home.journey_3_desc')</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Values Section -->

        <!-- ======= Features Section ======= -->
        <section id="benefit" class="features">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>@lang('home.benefit_title')</h2>
                    <p>@lang('home.benefit_sub_title')</p>
                </header>

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('landing/assets/img/features.png') }}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">
                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_1')</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_2')</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_3')</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_4')</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_5')</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>@lang('home.benefit_6')</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="position" class="services">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>@lang('home.positions_title')</h2>
                    <p>@lang('home.positions_sub_title')</p>
                </header>

                <div class="row gy-4">
                    @forelse ($checkActivePositions as $data)
                        @php
                            $position = $data['position'];
                            $quotaFull = $data['quotaFull'];
                            $startDate = $data['startDate'];
                            $comingSoon = $data['comingSoon'];
                        @endphp
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-box blue">
                                <div class="icon">
                                    <img width="60px" height="60px"
                                        src="{{ asset('uploads/image/' . $position->image) }}"></img>
                                </div>
                                <h3>{{ $position->name }}</h3>
                                <p>{{ $position->description }}</p>
                                @if ($comingSoon)
                                    <a href="" class="read-more" disabled><span>@lang('home.positions_soon')
                                            {{ $startDate }}</span> </a>
                                @elseif($quotaFull <= 0)
                                    <a href="" class="read-more" disabled><span>@lang('home.positions_full')</span> </a>
                                @else
                                    <a href="{{ route('register.showBySlug', ['locale' => app()->getLocale(), 'slug' => $position->slug]) }}"
                                        class="read-more">
                                        <span>@lang('home.positions_apply')</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-12">
                                @if (app()->getLocale() == 'en')
                                    <p>No positions available for now.</p>
                                @else
                                    <p>Tidak ada posisi yang tersedia untuk sekarang.</p>
                                @endif
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- Team Section -->
        <section id="magang" class="team">
            <div class="container" data-aos="fade-up">
                @if ($periodes->isNotEmpty())
                    <div class="interns-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            @foreach ($periodes as $periode)
                                <div class="swiper-slide">
                                    <header class="section-header">
                                        <h2>@lang('home.magang')</h2>
                                        <p>{{ $periode->name }}</p>
                                    </header>
                                    <div class="row gy-4" style="padding-left: 100px; padding-right: 100px">
                                        @if ($internByPeriod[$periode->id]->isEmpty())
                                            <div class="col-12 text-center">
                                                @if (app()->getLocale() == 'en')
                                                    <p>No interns available for this period.</p>
                                                @else
                                                    <p>Tidak ada maganger di periode ini.</p>
                                                @endif
                                            </div>
                                        @else
                                            @foreach ($internByPeriod[$periode->id] as $intern)
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch"
                                                    data-aos="fade-up" data-aos-delay="100">
                                                    <div class="member">
                                                        <div class="member-img">
                                                            <img src="{{ asset('uploads/photo/' . $intern->photo) }}"
                                                                class="img-fluid" alt="{{ $intern->full_name }}"
                                                                style="width: 320px; height: 250px; object-fit: cover;">
                                                            <div class="social">
                                                                <a href="{{ $intern->url }}"><i
                                                                        class="bi bi-globe"></i></a>
                                                                @foreach ($intern->social_medias as $socialMedia)
                                                                    <a href="{{ $socialMedia->url }}">
                                                                        <i class="{{ $socialMedia->icon }}"></i>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="member-info">
                                                            <h4>{{ $intern->full_name }}</h4>
                                                            <span>{{ $intern->position->name ?? '-' }}</span>
                                                            <p>{{ $intern->school }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="spacer" style="height: 100px;"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                @endif

            </div>
            </div>
        </section>

        <section id="recent-posts" class="recent-posts section">

            <!-- Section Title -->
            <header class="section-header">
                <h2>Blog</h2>
                <p>@lang('blog.recent')</p>
            </header>

            <div class="container">

                <div class="row gy-5">

                    @if ($recentBlogs->isEmpty())
                        <div class="col-12">
                            @if (app()->getLocale() == 'en')
                                <p>No recent blog posts available.</p>
                            @else
                                <p>Tidak ada postingan blog yang terbaru.</p>
                            @endif
                        </div>
                    @else
                        @foreach ($recentBlogs as $blog)
                            <div class="col-xl-4 col-md-6">
                                <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                                    <div class="post-img position-relative overflow-hidden">
                                        <img src="{{ asset('uploads/image_thumbnail/' . $blog->image_thumbnail) }}"
                                            class="img-fluid" alt="">
                                        <span class="post-date" sty>
                                            {{ app()->getLocale() == 'en' ? $blog->published_at_formatted_en : $blog->published_at_formatted }}
                                        </span>
                                    </div>

                                    <div class="post-content d-flex flex-column">

                                        <h3 class="post-title">{{ $blog->title }}</h3>

                                        <div class="meta d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person"></i> <span
                                                    class="ps-2">{{ $blog->author->name }}</span>
                                            </div>
                                            <span class="px-3 text-black-50">/</span>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-folder2"></i> <span
                                                    class="ps-2">{{ $blog->category->name }}</span>
                                            </div>
                                        </div>

                                        <hr>

                                        <a href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}"
                                            class="readmore stretched-link"><span>Read
                                                More</span><i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>


        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>FAQ</h2>
                    <p>Frequently Asked Questions</p>
                </header>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion accordion-flush" id="faqlist1">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-1">
                                        @lang('home.faq_1_title')
                                    </button>
                                </h2>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        @lang('home.faq_1_desc')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-2">
                                        @lang('home.faq_2_title')
                                    </button>
                                </h2>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        @lang('home.faq_2_desc')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-3">
                                        @lang('home.faq_3_title')
                                    </button>
                                </h2>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        @lang('home.faq_3_desc')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- F.A.Q List 2-->
                        <div class="accordion accordion-flush" id="faqlist2">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2-content-1">
                                        @lang('home.faq_4_title')
                                    </button>
                                </h2>
                                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        @lang('home.faq_4_desc')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2-content-2">
                                        @lang('home.faq_5_title')
                                    </button>
                                </h2>
                                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        @lang('home.faq_5_desc')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq2-content-3">
                                        @lang('home.faq_6_title')
                                    </button>
                                </h2>
                                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        @lang('home.faq_6_desc')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End F.A.Q Section -->

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="footer-newsletter" id="subscription">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>@lang('home.news')</h4>
                        <p>@lang('home.news-desc')</p>
                        <form action="{{ route('subscriptions.store') }}" method="post" class="php-email-form">
                            @csrf
                            <div class="newsletter-form">
                                <input type="email" name="email">
                                <button type="submit">Subcsribe</button>
                            </div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                            <img src="{{ asset('img/logo/logo2.png') }}" alt="">
                            <span>Kadang Koding</span>
                        </a>
                        <p>@lang('home.footer')</p>
                        <div class="social-links mt-3">
                            <a href="https://www.linkedin.com/company/kadang-koding-indonesia" class="linkedin">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://instagram.com/kadangkoding" class="instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="https://twitter.com/kadangkoding" class="twitter">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://www.facebook.com/kadangkodingindonesia" class="facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#hero">Home</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#journey">Journey</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#position">Positions</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#faq">FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Cloud Solution</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Solution by Service</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Solution by Category</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">UI UX Solution</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            Kuyudan, Dusun II, Makamhaji<br>
                            Kartasura, Sukoharjo<br>
                            Jawa Tengah <br><br>
                            <strong>Phone:</strong> +62 1234 5678 90<br>
                            <strong>Email:</strong> info@kadangkoding.com<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>
@endsection

@push('script-global')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (window.location.hash) {
                const element = document.querySelector(window.location.hash);
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth'
                    });

                    setTimeout(function() {
                        history.replaceState(null, null, window.location.pathname + window.location.search);
                    }, 1000);
                }
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

@push('script-landing')
    <!-- Script Landing -->
    <script src="{{ asset('landing/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('landing/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endpush
