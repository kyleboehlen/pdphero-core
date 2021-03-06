<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
        <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Vapid public key -->
        @auth
            <meta name="vapid-public" content="{{ config('webpush.vapid.public_key') }}">
        @endauth

        <title>{{ config('app.name', 'PDPHero') }}</title>

        {{-- Laravel PWA Directive --}}
        @laravelPWA

        <!-- Scripts -->
        @if(config('app.env') == 'local')
            <script src="{{ url('js/app.js') }}"></script>
        @else
            <script src="{{ mix('js/app.js') }}"></script>
        @endif

        {{-- Reload when browser back button is pressed --}}
        <script>
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        </script>


        <!-- Styles -->
        @if(config('app.env') == 'local')
            <link href="@isset($stylesheet) {{ url("/css/$stylesheet.css") }} @else {{ url('/css/app.css') }} @endisset" rel="stylesheet">
        @else
            <link href="@isset($stylesheet) {{ mix("css/$stylesheet.css") }} @else {{ mix('css/app.css') }} @endisset" rel="stylesheet">
        @endif

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#155466">
        <meta name="apple-mobile-web-app-title" content="PDPHero">
        <meta name="application-name" content="PDPHero">
        <meta name="msapplication-TileColor" content="#26130c">
        <meta name="theme-color" content="#26130c">

        <!-- Fuck you chrome -->
        <style>
            a:active
            {
                -webkit-tap-highlight-color: transparent;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
        </style>

        {{-- HTML5 Shiv --}}
        <!--[if lt IE 9]>
            <script src="bower_components/html5shiv/dist/html5shiv.js"></script>
        <![endif]-->
    </head>

    @yield('body')
</html>
