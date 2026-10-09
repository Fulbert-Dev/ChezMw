<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <x-pwa-head />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CHEZMW') }}</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <x-app-sidebar />

        <div class="min-h-screen">
            @isset($header)
                <header class="border-b border-slate-100 bg-white/95 shadow-sm">
                    <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">{{ $header }}</div>
                </header>
            @endisset

            <main>{{ $slot }}</main>
        </div>
    </body>
</html>
