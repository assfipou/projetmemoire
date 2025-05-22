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
    <body class="font-sans text-gray-900 antialiased bg-blue-700" style="background-color: #1e3a8a";">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo -->
           
    
            <!-- Formulaire avec image de fond -->
            <div class="relative w-full sm:max-w-md mt-6 px-6 py-4 bg-cover bg-center rounded-lg shadow-lg"
                 style="background-image: url('{{ asset('images/connexion.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-50 rounded-lg"></div>
    
                <!-- Contenu du formulaire -->
                <div class="relative z-10 " style="color:#1e3a8a";>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
    
</html>
