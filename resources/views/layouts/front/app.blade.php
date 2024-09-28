<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Internship Kadang Koding</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/logo/logo2.png') }}" rel="icon">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('style-landing')
    @stack('style-blog')
    @stack('style-custom')
</head>

<body>
    @yield('content')

    @stack('script-global')
    @stack('script-landing')
    @stack('script-blog')
    @stack('script-blog-preview')
</body>
</html>