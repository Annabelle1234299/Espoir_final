<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-amber-900 font-['Playfair_Display']">Connectez-vous</h2>
        <p class="text-gray-600 mt-1">Accédez à votre espace personnel et réservez vos billets pour le festival</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Adresse email')" class="text-amber-800 font-medium" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input id="email" class="block mt-1 w-full pl-10 border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-lg" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required 
                              autofocus 
                              autocomplete="username"
                              placeholder="votreemail@example.com" />
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
                              required 
                              autocomplete="current-password"
                              placeholder="Votre mot de passe" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-amber-300 text-amber-600 shadow-sm focus:ring-amber-200 focus:ring-opacity-50" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4 mt-6">
            <!-- Bouton de connexion -->
            <x-primary-button class="w-full justify-center py-3 bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">
                {{ __('Se connecter') }}
            </x-primary-button>
            
            <!-- Lien d'inscription et mot de passe oublié -->
            <div class="flex items-center justify-between text-sm mt-2">
                <a class="text-amber-700 hover:text-amber-900 font-medium" href="{{ route('register') }}">
                    {{ __('Créer un compte') }}
                </a>
                
                @if (Route::has('password.request'))
                <a class="text-amber-700 hover:text-amber-900 font-medium" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
    
    <!-- Badge promotion -->
    <div class="mt-8 bg-gradient-to-r from-amber-50 to-red-50 p-4 rounded-lg border border-amber-100">
        <div class="flex items-center">
            <div class="mr-3 bg-amber-100 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-amber-800 text-sm">Offre spéciale pour les membres</h3>
                <p class="text-xs text-gray-600">15% de réduction sur les billets VIP pour les 100 premiers inscrits</p>
            </div>
        </div>
    </div>
</x-guest-layout>
