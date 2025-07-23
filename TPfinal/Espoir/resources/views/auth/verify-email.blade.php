<x-guest-layout>
    <!-- Header avec style thématique -->
    <h2 class="text-2xl font-bold mb-5 text-amber-800 font-playfair text-center">{{ __('Vérification de votre email') }}</h2>
    
    <div class="mb-6 text-sm text-amber-700 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm">
        {{ __('Merci pour votre inscription! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer? Si vous n\'avez pas reçu l\'e-mail, nous pouvons vous en envoyer un autre.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm bg-green-50 text-green-700 p-3 rounded-lg border-l-4 border-green-500">
            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez indiquée lors de l\'inscription.') }}
        </div>
    @endif

    <!-- Badge explicatif -->
    <div class="my-5 bg-gradient-to-r from-amber-100 to-red-100 p-4 rounded-lg border border-amber-200 shadow-sm">
        <div class="flex items-start space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="font-semibold text-amber-800 mb-1">{{ __('Pourquoi vérifier votre email?') }}</h3>
                <p class="text-sm text-amber-700">
                    {{ __('La vérification de votre email nous permet de vous contacter concernant les offres spéciales du festival et de sécuriser votre compte.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ __('Renvoyer l\'email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="flex items-center text-amber-600 hover:text-red-600 text-sm font-medium transition-colors duration-200 hover:underline focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</x-guest-layout>
