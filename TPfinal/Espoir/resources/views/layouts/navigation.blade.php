<nav x-data="{ open: false }" class="bg-gradient-to-r from-amber-600 to-red-600 border-b border-amber-700 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow overflow-hidden mr-2">
                            <span class="text-xl font-bold font-['Playfair_Display'] text-amber-600">E&D</span>
                        </div>
                        <span class="text-white font-['Playfair_Display'] font-bold text-lg tracking-wide hidden md:block">Eat&Drink Festival</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user() && Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-amber-100 text-white' : 'border-transparent text-amber-50 hover:text-white hover:border-amber-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Administration') }}
                        </a>
                    @elseif(Auth::user() && Auth::user()->isApprovedEntrepreneur())
                        <a href="{{ route('entrepreneur.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('entrepreneur.dashboard') ? 'border-amber-100 text-white' : 'border-transparent text-amber-50 hover:text-white hover:border-amber-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Tableau de bord') }}
                        </a>
                    @else
                        <a href="{{ route('produits.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('produits.*') ? 'border-amber-100 text-white' : 'border-transparent text-amber-50 hover:text-white hover:border-amber-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            {{ __('Accueil') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-amber-100 text-sm font-medium rounded-full text-white bg-amber-500/30 hover:bg-amber-500/50 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ Auth::check() ? Auth::user()->name : 'Invité' }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::check())
                            <div class="px-4 py-3 text-sm text-amber-900 border-b border-amber-100">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs">{{ Auth::user()->email }}</div>
                            </div>
                            
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-amber-50 focus:outline-none focus:bg-amber-50 transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Mon Profil') }}
                            </a>
                            
                            <a href="{{ route('public.orders') }}" class="flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-amber-50 focus:outline-none focus:bg-amber-50 transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ __('Mes Commandes') }}
                            </a>
    
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
    
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="flex items-center px-4 py-2 text-sm leading-5 text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50 transition duration-150 ease-in-out border-t border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Déconnexion') }}
                                </a>
                            </form>
                        @else
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-full text-amber-50 hover:text-white hover:bg-amber-500/30 focus:outline-none focus:bg-amber-500/30 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-amber-50 border-t border-amber-600">
        <div class="pt-2 pb-3 space-y-0.5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-amber-800 border-l-4 border-amber-600 hover:bg-amber-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Accueil') }}
                </div>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('menu')" class="text-amber-800 hover:bg-amber-100 hover:border-l-4 hover:border-amber-600">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ __('Programme') }}
                </div>
            </x-responsive-nav-link>


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-amber-100 bg-gradient-to-br from-amber-50 to-amber-100">
            <div class="px-4">
                @if(Auth::check())
                    <div class="font-medium text-base text-amber-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-amber-700">{{ Auth::user()->email }}</div>
                @else
                    <div class="font-medium text-base text-amber-900">Invité</div>
                    <div class="font-medium text-sm text-amber-700">Non connecté</div>
                @endif
            </div>

            <div class="mt-3 space-y-0.5">
                @if(Auth::check())
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-amber-800 hover:bg-amber-200 border-l-0 hover:border-l-4 hover:border-amber-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Mon Profil') }}
                        </div>
                    </x-responsive-nav-link>
                    
                    <x-responsive-nav-link href="#" class="text-amber-800 hover:bg-amber-200 border-l-0 hover:border-l-4 hover:border-amber-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ __('Mes Commandes') }}
                        </div>
                    </x-responsive-nav-link>
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" class="border-t border-amber-200 mt-2 pt-2">
                        @csrf
    
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-600 hover:bg-red-50 border-l-0 hover:border-l-4 hover:border-red-500">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Déconnexion') }}
                            </div>
                        </x-responsive-nav-link>
                    </form>
                @else
                @endif
            </div>
        </div>
    </div>
</nav>
