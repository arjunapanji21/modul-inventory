<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet" />

        <title>Toko Jam Kadar | {{ $title }}</title>
    </head>
    <body>
        @yield('content')
    </body>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
</html>
