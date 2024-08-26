<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sagara Mobile</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])   
    </head>
    <body class="font-sans antialiased">
    <script src="resources/initTheme.js"></script>
        <div class="min-h-screen bg-gray-100">
            @include('sidebar.index')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="SagaraMobile/resources/js/dark.js"></script>
    <script src="/js/app.js"></script>
    </body>
</html>
