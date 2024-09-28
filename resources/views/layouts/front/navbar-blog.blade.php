<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('img/logo/logokki.png') }}" alt="">
            {{-- <span style="color: #012970 !important;">Kadang Koding</span> --}}
        </a>

        <nav id="navbar" class="navbar ">
            <ul>
                <li>
                    <a class="nav-link scrollto {{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}"
                        href="{{ route('home', [app()->getLocale(), '#hero']) }}">
                        Home
                    </a>
                </li>
                <li><a class="nav-link scrollto" href="{{ route('home', ['locale' => app()->getLocale()]) }}#about"
                        id="link-about">@lang('home.navbar.about')</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home', ['locale' => app()->getLocale()]) }}#journey"
                        id="link-journey">@lang('home.navbar.journey')</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home', ['locale' => app()->getLocale()]) }}#position"
                        id="link-position">@lang('home.navbar.positions')</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home', ['locale' => app()->getLocale()]) }}#magang"
                        id="link-magang">@lang('home.navbar.intern')</a></li>

                <li>
                    <a class="nav-link scrollto {{ request()->is(app()->getLocale() . '/blog*') ? 'active' : '' }}"
                        href="{{ route('home.blog', ['locale' => app()->getLocale()]) }}">
                        @lang('home.navbar.blog')
                    </a>
                </li>

                <div class="dropdown">
                    <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @lang('home.navbar.select')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item change-lang" data-lang="id" href="">Indonesia</a>
                        </li>
                        <li>
                            <a class="dropdown-item change-lang" data-lang="en" href="">English</a>
                        </li>

                        {{-- <li><a class="dropdown-item" href="{{ url('/', 'id') }}" data-lang="id">Indonesia</a></li>
                        <li><a class="dropdown-item" href="{{ url('/', 'en') }}" data-lang="en">English</a></li> --}}
                    </ul>
                </div>
                <li>
                    @if (Auth::check())
                        @if (Auth::user()->role === 'admin')
                            <a class="getstarted scrollto"
                                href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}">@lang('home.navbar.dashboard')</a>
                        @else
                            <a class="getstarted scrollto"
                                href="{{ route('reports.index', ['locale' => app()->getLocale()]) }}">@lang('home.navbar.dashboard')</a>
                        @endif
                    @else
                        <a class="getstarted scrollto"
                            href="{{ route('login', ['locale' => app()->getLocale()]) }}">@lang('home.navbar.login')</a>
                    @endif
                </li>



            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

    </div>
</header>
