<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
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
    <footer class="footer footer-center p-4 text-base-content">
        <div>
            <p>Copyright © 2022 - All right reserved by Toko Jam Kadar Jambi</p>
        </div>
    </footer>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
</html>
