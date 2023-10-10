<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="title" content="ZapFLow" />
        <meta name="description" content="Tu red de carga de confianza">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon/android-chrome-192x192.png') }}">
        <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/favicon/android-chrome-192x192.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
