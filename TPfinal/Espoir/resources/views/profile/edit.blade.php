@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-bold text-xl text-amber-800 leading-tight font-playfair">
                {{ __('Mon profil') }}
            </h2>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Bannière de profil avec badge de rôle utilisateur -->
            <div class="bg-gradient-to-r from-amber-50 to-red-50 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-amber-200">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-amber-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-amber-800">{{ Auth::user()->name }}</h2>
                                <p class="text-amber-700">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <span class="bg-amber-200 text-amber-800 py-1 px-4 rounded-full text-sm font-medium">
                            @if(Auth::user()->isAdmin())
                                {{ __('Administrateur') }}
                            @elseif(Auth::user()->isApprovedEntrepreneur())
                                {{ __('Entrepreneur') }}
                            @elseif(Auth::user()->isPendingEntrepreneur())
                                {{ __('Demande en cours') }}
                            @else
                                {{ __('Festivalier') }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Section Informations du profil -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-amber-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section Sécurité du compte -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-amber-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section Supprimer le compte -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border border-red-100">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
            @if(!Auth::user()->isAdmin() && !Auth::user()->isPendingEntrepreneur() && !Auth::user()->isApprovedEntrepreneur())
            <!-- Section Devenir Entrepreneur -->
            <div class="p-4 sm:p-8 bg-amber-50 shadow sm:rounded-lg border border-amber-200">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-semibold text-amber-800">
                            {{ __('Devenir Exposant du Festival') }}
                        </h2>

                        <p class="mt-1 text-sm text-amber-700">
                            {{ __('Vous êtes artisan, producteur ou restaurateur? Rejoignez notre festival en créant votre propre stand!') }}
                        </p>
                    </header>

                    <div class="mt-4">
                        <ul class="space-y-2 mb-4 text-sm">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ __('Présentez vos produits à des milliers de visiteurs passionnés') }}</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ __('Vendez directement sur la plateforme sans commission') }}</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ __('Bénéficiez d\'une visibilité accrue pour votre marque') }}</span>
                            </li>
                        </ul>

                        <a href="{{ route('entrepreneur.create') }}" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            {{ __('Créer mon stand') }}
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
