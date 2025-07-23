<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Eat&Drink Festival') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair+display:700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .bg-festival {
                background-image: linear-gradient(135deg, rgba(245, 158, 11, 0.8) 0%, rgba(220, 38, 38, 0.8) 100%), 
                                  url('{{ asset('img/marketplace.jpg') }}');
                background-size: cover;
                background-position: center;
            }
            
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Fond stylisé -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-festival relative overflow-hidden">
            <!-- Éléments décoratifs -->
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-10 right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-amber-200/20 rounded-full blur-xl"></div>
            
            <!-- Logo et titre du festival -->
            <div class="mb-6 text-center">
                <a href="/" class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-lg mb-3 overflow-hidden">
                        <span class="text-4xl font-bold font-['Playfair_Display'] text-amber-600">E&D</span>
                    </div>
                    <h1 class="text-2xl font-bold text-white font-['Playfair_Display'] tracking-wide">Eat&Drink Festival</h1>
                    <div class="text-amber-200 text-sm mt-1">15-20 Août 2025</div>
                </a>
            </div>

            <!-- Badge flottant -->
            <div class="absolute top-20 right-10 animate-float hidden md:block">
                <div class="bg-amber-500 text-amber-900 text-xs uppercase font-bold px-4 py-1 rounded-full transform rotate-12 shadow-lg">
                    Réservez maintenant
                </div>
            </div>

            <!-- Carte d'inscription -->
            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-xl relative z-10">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-red-500"></div>
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center text-white/80 text-sm">
                <p>© 2025 Eat&Drink Festival - Une expérience gastronomique unique</p>
            </div>
        </div>
    </body>
</html>
