<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jagoan Indonesia') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel="icon" type="image/svg+xml" href="{{ asset('images/fav.svg') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 login-background">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-white to-gray-50"></div>
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ef4444" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
            <!-- Floating Elements -->
            <div class="absolute top-20 left-20 w-32 h-32 bg-red-100 rounded-full opacity-20 blur-2xl"></div>
            <div class="absolute bottom-20 right-20 w-48 h-48 bg-red-200 rounded-full opacity-10 blur-3xl"></div>
            <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-gray-200 rounded-full opacity-15 blur-xl"></div>

            <!-- Main Content -->
            <div class="relative z-10 w-full sm:max-w-md px-6 py-8">
                <!-- Logo Section -->
                <div class="text-center mb-8">
                    <a href="/" class="inline-flex items-center justify-center group">
                        <img src="{{ asset('images/logo-ji.svg') }}" alt="Jagoan Indonesia" class="h-24 w-auto" />
                    </a>
                </div>

                <!-- Login Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
                    <div class="p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

            </body>
</html>
