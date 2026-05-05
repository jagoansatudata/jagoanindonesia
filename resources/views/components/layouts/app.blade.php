<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Jagoan Indonesia' }}</title>
        @php
            $metaTitle = $title ?? 'Jagoan Indonesia';
            $metaDescription = $description ?? '';
            $metaImage = $image ?? '';
            $metaUrl = $url ?? url()->current();
            $metaType = $type ?? 'website';

            if ($metaImage && str_starts_with($metaImage, 'http://') && request()->isSecure()) {
                $metaImage = 'https://' . substr($metaImage, strlen('http://'));
            }
        @endphp
        @if($metaDescription)
            <meta name="description" content="{{ $metaDescription }}">
        @endif
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:type" content="{{ $metaType }}">
        <meta property="og:url" content="{{ $metaUrl }}">
        <meta property="og:site_name" content="{{ config('app.name', 'Jagoan Indonesia') }}">
        @if($metaDescription)
            <meta property="og:description" content="{{ $metaDescription }}">
        @endif
        @if($metaImage)
            <meta property="og:image" content="{{ $metaImage }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
        @endif
        <meta name="twitter:card" content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
        <meta name="twitter:title" content="{{ $metaTitle }}">
        @if($metaDescription)
            <meta name="twitter:description" content="{{ $metaDescription }}">
        @endif
        @if($metaImage)
            <meta name="twitter:image" content="{{ $metaImage }}">
        @endif
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
