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

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: url('Assets/images/Background.png') center/cover no-repeat, linear-gradient(270deg, #3a7bd5, #3a6073, #3a7bd5); /* Gambar latar belakang dengan gradasi */
            background-size: cover, 600% 600%; /* Ukuran latar belakang dan gradasi */
            animation: gradientBackground 15s ease infinite;
            color: #fff;
            overflow: hidden;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
            z-index: 1;
        }

        .content-box {
            width: 30%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            position: relative;
            z-index: 2;
        }

        .content-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 50px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content-box">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
