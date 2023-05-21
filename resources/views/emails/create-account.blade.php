<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="text-lg w-full text-center space-x-6">
        <h2>Hola, Bienvenido a GCFC</h2>
        <div class="flex justify-center items-center">
           <p>
               Tu contraseña es: <span class="font-bold text-xl">{{$password}}</span>
            </p>
        </div>
    </div>
</body>
</html>
