<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Market Hammer - Sys Ad</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.auth_user_id = {!! Auth::id() !!};
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>

        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),
            'userData' => [
                'activeUserId' => Auth::user() ?  Auth::user()->id : 0,
                'activeClusterID' => Auth::user() ?  Auth::user()->clusterID : 0,
                'userTypeId' => auth()->user()->userType->id ?? null
            ],
            'locale' => config('app.locale'),
            'translations' => cache('translations')

        ]); ?>;

    </script>

</head>
<body class="hold-transition sidebar-mini-md layout-fixed">
    <div id="app" class="backoffice-container">

        <!-- Header -->
        @yield('header')
        <!-- End Header -->

        <!-- Sidebar -->
        @yield('sidebar')
        <!-- End Sidebar -->

        <main class="content-wrapper">
            @yield('content')
            &nbsp;
        </main>

        <!-- Footer -->
        @yield('footer')
        <!-- End Footer -->
    </div>

    <!-- <script>
        var url = window.location;
        // Will only work if string in href matches with location
        $('ul.nav-sidebar a[href="'+ url +'"]').parent().addClass('active');

        // Will also work for relative and absolute hrefs
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

    </script> -->
</body>
</html>
