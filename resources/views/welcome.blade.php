<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JULMAR_AGENT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('/lapis.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        

        <main class="py-4">
            {{-- @yield('content') --}}
            <center>
                <div class="container">
                    <img style="width:100%;" src="{{ asset("/adminLte/julmar_landing_page_logo.jpg") }}" class="img-thumbnail">
                    <a href="{{ route('proceed_to_login') }}" class="btn btn-block btn-success">PROCEED</a>
                </div>
            </center>
        </main>
    </div>
</body>
</html>
