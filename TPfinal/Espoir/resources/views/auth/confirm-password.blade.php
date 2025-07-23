<x-guest-layout>
    <!-- Header avec style thématique -->
    <h2 class="text-2xl font-bold mb-5 text-amber-800 font-playfair text-center">{{ __('Zone sécurisée') }}</h2>
    
    <div class="mb-6 text-sm text-amber-700 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm">
        {{ __('Vous accédez à une zone protégée. Veuillez confirmer votre mot de passe pour continuer.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password avec icône -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="text-amber-800 font-semibold" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            type="password"
                            name="password"
                            placeholder="Votre mot de passe"
                            required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Badge de sécurité -->
        <div class="mt-4 bg-gradient-to-r from-amber-100 to-red-100 p-3 rounded-lg border border-amber-200 shadow-sm flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span class="text-sm text-amber-800">{{ __('Cette vérification permet de protéger vos informations personnelles.') }}</span>
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-amber-600 hover:text-amber-800 hover:underline">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Retour') }}
                </span>
            </a>
            
            <x-primary-button class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
