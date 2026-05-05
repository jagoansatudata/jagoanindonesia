<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>403 - Forbidden</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/fav.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900" style="font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-xl">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                <div class="text-sm font-semibold text-gray-500">403</div>
                <h1 class="mt-2 text-2xl font-semibold text-gray-900">Forbidden</h1>
                <p class="mt-2 text-sm text-gray-600">Kamu tidak punya izin untuk mengakses halaman ini.</p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="history.back()" class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Kembali
                    </button>

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="sm:ml-auto">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="sm:ml-auto inline-flex items-center justify-center rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</body>
</html>
