<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body class="">
        <div class="flex w-full h-screen">
            <div class="w-1/2 bg-cover" style=" background-image: url('/svgs/loginBG.jpeg');">
                <img class="object-fill h-1/2 w-1/2 mx-auto mt-48" src="/svgs/recurso 1.svg">
            </div>
            <div class="font-sans text-gray-900 antialiased w-1/2">
                {{ $slot }} 
            </div>
        </div>
    </body>
</html>