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
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/iconly.css')}}"/>
        <!-- Scripts -->
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
        <script src="resources/js/dark.js"></script>
    <!-- <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script> -->
    
    
    <script src="resources/js/app.js"></script>
    

    
<!-- Need: Apexcharts -->
<script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="assets/static/js/pages/dashboard.js"></script>
    </body>
</html>
