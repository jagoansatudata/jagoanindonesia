<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Jagoan Indonesia' }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/fav.svg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="top"></div>
        <div class="page-bg">
            {{ $slot }}
        </div>
        <div class="footer-bottom-bar">
            <div class="footer-bottom-bar-inner">© {{ now()->year }} Jagoan Indonesia. All Rights Reserved.</div>
        </div>
    </body>
</html>
