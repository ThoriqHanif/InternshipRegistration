@extends('layouts.front.app')

@section('content')
    @include('layouts.front.navbar')

    <main id="main" class="mt-5">
        <section id="" class="">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-12">
                        <footer id="footer" class="footer">
                            <div class="footer-newsletter" id="subscription">
                                <div class="container">
                                    <div class="row justify-content-center text-center">
                                        <div class="col-lg-6">
                                            <h4>Kami telah membatalkan langganan email Anda.</h4>
                                            <p>Anda tidak akan menerima pembaruan lagi untuk milis ini.</p>

                                            <!-- Form untuk Berlangganan Ulang -->
                                            <form action="{{ route('re-subscribe') }}" method="post" class="php-email-form php-email-form-unsubscribe"
                                                id="subscribeForm">
                                                @csrf
                                                <div class="newsletter-form newsletter-form-unsubscribe"  id="newsletterForm" >
                                                    <input type="text" name="text"
                                                        value="Anda selalu bisa bergabung kembali dengan satu klik"
                                                        readonly>
                                                    <input type="hidden" name="email" value="{{ $email }}"
                                                        readonly>
                                                    <button type="submit" id="subscribeButton">Langganan Ulang</button>
                                                </div>
                                                <div class="loading">Loading</div>
                                                <div class="error-message"></div>
                                                <div class="sent-message">Your subscription request has been sent. Thank
                                                    you!</div>
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
                        </footer>
                    </div>
                </div>
            </div>
    </main>
@endsection

@push('style-landing')
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
