<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eat&Drink Festival') }} - En Attente d'Approbation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-amber-50">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-gradient-to-r from-amber-600 to-red-600 border-b border-amber-700 shadow-md">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('attente.dashboard') }}" class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow overflow-hidden mr-2">
                                    <span class="text-xl font-bold font-['Playfair_Display'] text-amber-600">E&D</span>
                                </div>
                                <span class="text-white font-['Playfair_Display'] font-bold text-lg tracking-wide hidden md:block">Eat&Drink Festival</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="{{ route('attente.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('attente.dashboard') ? 'border-white text-white' : 'border-transparent text-amber-100 hover:text-white hover:border-amber-200' }} text-sm font-medium leading-5 focus:outline-none focus:border-white transition duration-150 ease-in-out">
                                {{ __('Tableau de bord') }}
                            </a>
                            <a href="{{ route('attente.stand') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('attente.stand') ? 'border-white text-white' : 'border-transparent text-amber-100 hover:text-white hover:border-amber-200' }} text-sm font-medium leading-5 focus:outline-none focus:border-white transition duration-150 ease-in-out">
                                {{ __('Mon Stand') }}
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                            <div @click="open = ! open">
                                <button class="flex items-center text-sm font-medium text-white hover:text-amber-100 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                                style="display: none;"
                                @click="open = false">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        {{ __('Profile') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            {{ __('Se déconnecter') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-amber-100 hover:text-white hover:bg-amber-700 focus:outline-none focus:bg-amber-700 focus:text-white transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('attente.dashboard') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('attente.dashboard') ? 'border-white text-white bg-amber-700' : 'border-transparent text-amber-200 hover:text-white hover:border-amber-300 hover:bg-amber-700' }} text-base font-medium focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
                        {{ __('Tableau de bord') }}
                    </a>
                    <a href="{{ route('attente.stand') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('attente.stand') ? 'border-white text-white bg-amber-700' : 'border-transparent text-amber-200 hover:text-white hover:border-amber-300 hover:bg-amber-700' }} text-base font-medium focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
                        {{ __('Mon Stand') }}
                    </a>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-amber-700">
                    <div class="px-4">
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-amber-200">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-amber-200 hover:text-white hover:border-amber-300 hover:bg-amber-700 text-base font-medium focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-amber-200 hover:text-white hover:border-amber-300 hover:bg-amber-700 text-base font-medium focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out">
                                {{ __('Se déconnecter') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-gradient-to-r from-amber-500 to-red-500 shadow-md">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-white leading-tight font-['Playfair_Display']">
                    {{ __('Tableau de bord - En attente d\'approbation') }}
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mt-4 mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow" role="alert">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-2 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mt-4 mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow" role="alert">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-amber-800 text-white py-6 mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <div class="flex items-center justify-center md:justify-start">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center mr-2">
                                <span class="text-base font-bold font-['Playfair_Display'] text-amber-600">E&D</span>
                            </div>
                            <span class="font-['Playfair_Display'] font-bold text-lg">Eat&Drink Festival</span>
                        </div>
                        <p class="text-amber-200 text-sm mt-2">© {{ date('Y') }} Tous droits réservés</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="text-amber-200 hover:text-white">
                            <span>Aide</span>
                        </a>
                        <a href="#" class="text-amber-200 hover:text-white">
                            <span>Contact</span>
                        </a>
                        <a href="#" class="text-amber-200 hover:text-white">
                            <span>Mentions légales</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
