<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Market Hammer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),
            'userData' => [
                'activeUserId' => Auth::user() ?  Auth::user()->id : 0,
                'activeUserName' => Auth::user() ?  ucfirst(Auth::user()->firstName) : '',
                'userTypeId' => auth()->user()->userType->id ?? null,
                'coords' => ['latitude'=> null, 'longitude'=> null]
            ],
            'locale' => config('app.locale'),
            'translations' => cache('translations')
        ]); ?>;

    </script>
</head>
<body class="hold-transition no-sidebar front-view layout-fixed">
    <div id="app" class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" style="margin-right: 30px" href="{{ url('/') }}">
                    Market <span class="brand-orange">Hammer</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link">{{ __('Platform') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">{{ __('Solutions') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">{{ __('Pricing') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">{{ __('Success Stories') }}</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Request::is('login'))
                            <li class="nav-item nav-active">
                            @else
                            <li class="nav-item">
                            @endif
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-brand-orange" href="{{ route('backoffice') }}">{{ __('Start Connected') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Header -->
        @yield('header')
        <!-- End Header -->

        <!-- Sidebar -->
        @yield('components.sidebar')
        <!-- End Sidebar -->

        <main class="content-wrapper">
            @yield('content')
        </main>

        <!-- Footer -->
        @yield('footer')
        <!-- End Footer -->
    </div>

    @yield('extra-script')
</body>
<style>
</style>
</html>
