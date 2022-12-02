<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />

        <title>Laradaisy | {{ $title }}</title>
    </head>
    <body>
        @yield('content')
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/chartjs/chart.min.js') }}"></script>
</html>
