<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="background-image: url('/Assets/background/login.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div class="vh-100 d-flex flex-col justify-content-center align-items-center pt-6 bi bi-grid-fill">
            <div class="h-50 w-25 mt-6 px-6 py-6 bg-white bg-opacity-50 backdrop-blur rounded">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
