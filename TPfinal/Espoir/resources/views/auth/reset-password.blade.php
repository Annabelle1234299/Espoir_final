<x-guest-layout>
    <!-- Header avec style thématique -->
    <h2 class="text-2xl font-bold mb-5 text-amber-800 font-playfair text-center">{{ __('Réinitialisation de mot de passe') }}</h2>
    
    <div class="mb-6 text-sm text-amber-700 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm">
        {{ __('Veuillez entrer votre adresse email et votre nouveau mot de passe pour compléter la réinitialisation.') }}
    </div>
    
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address avec icône -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-amber-800 font-semibold" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-md shadow-sm" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password avec icône -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Nouveau mot de passe')" class="text-amber-800 font-semibold" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" placeholder="Minimum 8 caractères" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password avec icône -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" class="text-amber-800 font-semibold" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez votre mot de passe" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Informations de sécurité -->
        <div class="text-xs text-amber-600 italic mt-2">
            {{ __('Pour votre sécurité, choisissez un mot de passe fort avec des lettres, chiffres et symboles.') }}
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
                {{ __('Réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
