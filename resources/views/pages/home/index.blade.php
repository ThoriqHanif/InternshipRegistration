<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Internship Kadang Koding</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/logo/logo2.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('landingpage/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landingpage/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('landingpage/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('landingpage/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <h2 class="m-0 "><img class="img-fluid me-2" src="{{ asset('img/logo/logo2.png') }}" alt=""
                    style="width: 45px;">Kadang Koding</h2>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-4 py-lg-0">
                <a href="#home" class="nav-item nav-link">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#journey" class="nav-item nav-link">Journey</a>
                <a href="#posisi" class="nav-item nav-link">Positions</a>
            </div>
            <div class="h-100 d-lg-inline-flex align-items-center d-none">
                <a class="btn bg-primary text-white me-2" href="{{ route('login') }}">Login</a>

            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid hero-header bg-light py-5 mb-5" id="home">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 mb-3 animated slideInDown"><span class="text-primary">Kadang Koding</span>
                        Indonesia Internship</h1>
                    <p class="animated slideInDown">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu
                        diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo
                        magna dolore erat amet</p>
                    <a href="#posisi" class="btn btn-primary py-3 px-4 animated slideInDown">Get Started</a>
                </div>
                <div class="col-lg-6 animated fadeIn">
                    <img class="img-fluid animated pulse infinite" style="animation-duration: 3s;"
                        src="{{ asset('landingpage/img/banner.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid" src="img/about.png" alt="">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h1 class="display-6">About Us</h1>
                        <p class="text-primary fs-5 mb-4">Internship Kadang Koding</p>
                        <p>Kadang Koding Indonesia memberikan pengalaman praktis yang berharga kepada para pemagang.
                            Dengan Pelatihan dan Project yang diberikan oleh Mentor.
                        </p>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-check bg-light text-primary btn-sm-square rounded-circle me-3 fw-bold"></i>
                            <span>Pengalaman Berharga</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fa fa-check bg-light text-primary btn-sm-square rounded-circle me-3 fw-bold"></i>
                            <span>Mentorship</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fa fa-check bg-light text-primary btn-sm-square rounded-circle me-3 fw-bold"></i>
                            <span>Kesempatan Pengembangan</span>
                        </div>
                        <a class="btn btn-primary py-3 px-4" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-xxl bg-light py-5 my-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid mb-4" src="img/icon-9.png" alt="">
                    <h1 class="display-4" data-toggle="counter-up">{{ $totalPendaftar }}</h1>
                    <p class="fs-5 text-primary mb-0">Total Pendaftar Magang</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.3s">
                    <img class="img-fluid mb-4" src="img/icon-10.png" alt="">
                    <h1 class="display-4" data-toggle="counter-up">{{ $posisiTersedia }}</h1>
                    <p class="fs-5 text-primary mb-0">Posisi Magang tersedia</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center wow fadeIn" data-wow-delay="0.5s">
                    <img class="img-fluid mb-4" src="img/icon-2.png" alt="">
                    <h1 class="display-4" data-toggle="counter-up">{{ $pemagangDiterima }}</h1>
                    <p class="fs-5 text-primary mb-0">Pemagang Diterima</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Features Start -->
    <div class="container-xxl py-5" id="journey">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                <h1 class="display-6">Internship Journey</h1>
                <p class="mt3 mb-8">Tertarik menjadi bagian dari tim Kadang Koding? Berikut adalah 3 langkah mudah
                    untuk mendaftar magang di Kadang Koding</p>
            </div>
            <div class="row g-5 mt-5">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center">
                        <div class="rounded-circle d-inline-block bg-light"
                            style="width: 80px; height: 80px; position: relative; text-align: center; overflow: hidden;">
                            <img class="img-fluid" src="{{ asset('landingpage/img/daftar.png') }}" alt=""
                                style="max-width: 100%; max-height: 100%; display: inline-block; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        </div>

                        <h5 class="mb-3 mt-3">Daftar</h5>
                        <p>Kunjungi website kami dan lengkapi formulir pendaftaran dengan informasi pribadi, riwayat
                            pendidikan, dan pengalaman yang relevan.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center">
                        <div class="rounded-circle d-inline-block bg-light"
                            style="width: 80px; height: 80px; position: relative; text-align: center; overflow: hidden;">
                            <img class="img-fluid" src="{{ asset('landingpage/img/interview.png') }}" alt=""
                                style="max-width: 100%; max-height: 100%; display: inline-block; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        </div>

                        <h5 class="mb-3 mt-3">Interview</h5>
                        <p>Jika Anda lolos seleksi awal, Anda akan diundang untuk Interview secara tatap muka atau
                            daring.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-center">
                        <div class="rounded-circle d-inline-block bg-light"
                            style="width: 80px; height: 80px; position: relative; text-align: center; overflow: hidden;">
                            <img class="img-fluid" src="{{ asset('landingpage/img/lolos.png') }}" alt=""
                                style="max-width: 100%; max-height: 100%; display: inline-block; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        </div>

                        <h5 class="mb-3 mt-3">Diterima</h5>
                        <p>Jika Anda diterima, selamat! Anda akan menerima pemberitahuan resmi beserta detail terkait
                            jadwal, lokasi, dan instruksi selanjutnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Service Start -->
    <div class="container-xxl bg-light py-5 my-5" id="posisi">
        <div class="container py-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">

                <h1 class="display-6">Internship Positions</h1>
                <p class=" mb-5">Apakah Anda mencari peluang untuk meraih pengalaman praktis yang berharga di industri
                    yang menarik? Kami membuka kesempatan magang untuk bergabung dengan tim kami sebagai berikut</p>
            </div>
            <div class="row g-4">
                @foreach ($activePositions as $position)
                    @php
                        $periode = $position->periode->first(); // Ambil periode pertama terkait
                        $kuotaPenuh = $periode && $periode->quota <= 0;
                        $startDate = \Carbon\Carbon::parse($periode->start_date)->translatedFormat('j F Y');
                        $comingSoon = $periode && $currentDate < $periode->start_date;
                    @endphp
                    {{-- @dd($comingSoon) --}}
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item bg-white p-5">
                            <img class="img-fluid mb-4" src="{{ asset('landingpage/img/' . $position->image) }}"
                                alt="{{ $position->name }}">
                            <h5 class="mb-3">{{ $position->name }}</h5>
                            <p>{{ $position->description }}</p>
                            @if ($comingSoon)
                            <a class="btn btn-outline-warning text-primary" disabled>Tersedia pada {{$startDate}}</a>
                            @elseif($kuotaPenuh)
                                <a class="btn btn-light text-primary" disabled>Kuota Full <i
                                        class="fa fa-xmark ms-2"></i></a>
                            @else
                                <a class="btn btn-outline-primary"
                                    href="{{ route('register.showBySlug', $position->slug) }}">Daftar posisi ini <i
                                        class="fa fa-arrow-right ms-2"></i></a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->



    <!-- FAQs Start -->
    <div class="container-xxl py-5" id="faq">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">FAQs</h1>
                <p class="text-primary fs-5 mb-5">Frequently Asked Questions</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.1s">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara mendaftar untuk magang?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Anda dapat mendaftar melalui formulir pendaftaran yang tersedia di website kami.
                                    Pastikan untuk melengkapi semua informasi yang diminta.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Kapan jadwal pendaftaran dibuka?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Jadwal pendaftaran kami berbeda-beda untuk setiap program magang. Anda dapat melihat
                                    informasi program yang tersedia di Website kami.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.3s">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Bagaimana proses seleksi dilakukan?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Proses seleksi melibatkan peninjauan aplikasi, wawancara, dan dalam beberapa kasus,
                                    uji keterampilan tertulis atau praktis.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Berapa lama waktu yang dibutuhkan untuk pengumuman hasil seleksi?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Waktu yang diperlukan untuk pengumuman hasil seleksi bervariasi tergantung pada
                                    jumlah pelamar dan tahapan seleksi. Kami berusaha memberikan informasi terkait
                                    jadwal pengumuman kepada setiap peserta.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.5s">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    Apakah magang ini dilakukan secara daring atau tatap muka?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Kebanyakan program magang kami menawarkan pengalaman tatap muka di tempat kerja.
                                    Namun, jika domisili tidak berada di Surakarta dapat melakukan secara Remote.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Start -->


    <!-- Footer Start -->
    <div class="container-fluid bg-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6">
                    <h1 class="text-primary mb-4"><img class="img-fluid me-2"
                            src="{{ asset('img/logo/logo2.png') }}" alt="" style="width: 45px;">Kadang
                        Koding</h1>
                    <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. In facilis odit veritatis possimus
                        provident impedit fuga minus, dolores, pariatur est quod? Dicta dolore voluptatibus nisi
                        perspiciatis, quae modi blanditiis similique?</span>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Jawa Tengah</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+0000000</p>
                    <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="#about">About Us</a>
                    <a class="btn btn-link" href="#journey">Journey</a>
                    <a class="btn btn-link" href="#posisi">Positions</a>
                    <a class="btn btn-link" href="#faq">FAQs</a>
                </div>

            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#">Kadang Koding</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                            href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landingpage/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('landingpage/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('landingpage/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('landingpage/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landingpage/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('landingpage/js/main.js') }}"></script>

    <script>
        // Fungsi untuk menentukan link navbar yang aktif
        function setActiveNavLink() {
            const links = document.querySelectorAll(".navbar-nav .nav-link");

            links.forEach(link => {
                const targetId = link.getAttribute("href").substring(1); // Menghapus tanda '#' dari href
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    const rect = targetElement.getBoundingClientRect();
                    if (
                        (targetId === "home" && window.scrollY < 50) || // Atur jarak sesuai kebutuhan
                        (rect.top <= 50 && rect.bottom >= 50)
                    ) {
                        link.classList.add("active");
                    } else {
                        link.classList.remove("active");
                    }
                }
            });
        }

        // Panggil fungsi saat halaman dimuat dan ketika terjadi peristiwa scroll
        window.addEventListener("DOMContentLoaded", setActiveNavLink);
        window.addEventListener("scroll", setActiveNavLink);
    </script>

</body>

</html>
