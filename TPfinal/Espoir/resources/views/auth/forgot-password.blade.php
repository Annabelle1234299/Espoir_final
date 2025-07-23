<x-guest-layout>
    <!-- Header avec style thématique -->
    <h2 class="text-2xl font-bold mb-5 text-amber-800 font-playfair text-center">{{ __('Récupération de mot de passe') }}</h2>
    
    <div class="mb-6 text-sm text-amber-700 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm">
        {{ __('Vous avez oublié votre mot de passe? Pas de problème! Indiquez simplement votre adresse email et nous vous enverrons un lien de réinitialisation pour en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address avec icône -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-amber-800 font-semibold" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" :value="old('email')" placeholder="votre@email.com" required autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Informations complémentaires -->
        <div class="text-xs text-amber-600 italic mt-2">
            {{ __('Assurez-vous de vérifier vos spams si vous ne recevez pas l\'email dans les 5 minutes.') }}
        </div>

        <!-- Badge promotionnel -->
        <div class="mt-4 bg-gradient-to-r from-amber-100 to-red-100 p-3 rounded-lg border border-amber-200 shadow-sm flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm text-amber-800">{{ __('Les membres inscrits bénéficient de remises spéciales pendant toute la durée du festival!') }}</span>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-amber-600 hover:text-amber-800 hover:underline">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('Retour à la connexion') }}
                </span>
            </a>
            
            <x-primary-button class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                {{ __('Envoyer le lien') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
