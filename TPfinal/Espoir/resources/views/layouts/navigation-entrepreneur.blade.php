<nav x-data="{ open: false }" class="bg-gradient-to-r from-amber-600 to-red-600 border-b border-amber-700 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-amber-100 text-white' : 'border-transparent text-amber-50 hover:text-white hover:border-amber-100' }}">
                        {{ __('Tableau de bord') }}
                    </a>
                    <a href="{{ route('produits.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('produits.*') ? 'border-amber-100 text-white' : 'border-transparent text-amber-50 hover:text-white hover:border-amber-100' }}">
                        {{ __('Mes Produits') }}
                    </a>
                </div>
            </div>

            <!-- Titre de l'application -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <span class="text-white text-lg font-semibold">Module CRUD Produits</span>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Tableau de bord') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('produits.index')" :active="request()->routeIs('produits.*')">
                {{ __('Mes Produits') }}
            </x-responsive-nav-link>
        </div>

        <!-- Module CRUD Produits -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">Module CRUD Produits</div>
                <div class="font-medium text-sm text-gray-500">Version simplifiée</div>
            </div>

            <div class="mt-3 space-y-1">
                <span class="block px-4 py-2 text-sm text-gray-600">Application de démonstration sans authentification</span>
            </div>
        </div>
    </div>
</nav>
