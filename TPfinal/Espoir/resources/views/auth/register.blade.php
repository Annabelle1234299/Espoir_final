<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-amber-900 font-['Playfair_Display']">Rejoignez le Festival</h2>
        <p class="text-gray-600 mt-1">Créez votre compte pour réserver vos billets et accéder aux offres exclusives</p>
    </div>
    
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom complet')" class="text-amber-800 font-medium" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input id="name" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Votre nom" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adresse email')" class="text-amber-800 font-medium" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votreemail@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" class="text-amber-800 font-medium" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-lg"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Minimum 8 caractères" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" class="text-amber-800 font-medium" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-lg"
                                type="password"
                                name="password_confirmation" 
                                required autocomplete="new-password"
                                placeholder="Répétez votre mot de passe" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>
        
        <!-- Acceptation des termes -->
        <div class="mt-4">
            <label for="terms" class="inline-flex items-center">
                <input id="terms" type="checkbox" class="rounded border-amber-300 text-amber-600 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50" name="terms" required>
                <span class="ml-2 text-sm text-gray-600">J'accepte les <a href="#" class="text-amber-600 hover:text-amber-800">conditions générales</a> et la <a href="#" class="text-amber-600 hover:text-amber-800">politique de confidentialité</a></span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-6">
            <!-- Bouton d'inscription -->
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">
                {{ __('Créer mon compte') }}
            </x-primary-button>
            
            <!-- Lien de connexion -->
            <div class="text-center">
                <a class="text-sm text-amber-700 hover:text-amber-900 font-medium" href="{{ route('login') }}">
                    {{ __('Déjà inscrit? Connectez-vous ici') }}
                </a>
            </div>
        </div>
    </form>
    
    <!-- Badges avantages -->
    <div class="mt-8 grid grid-cols-2 gap-3 text-center">
        <div class="bg-amber-50 rounded-lg p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-xs font-medium text-amber-800">Réservation prioritaire</p>
        </div>
        <div class="bg-amber-50 rounded-lg p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
            </svg>
            <p class="text-xs font-medium text-amber-800">-15% sur les billets</p>
        </div>
    </div>
</x-guest-layout>
