<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-amber-800 leading-tight font-playfair">
            {{ __('Tableau de bord du Festival') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bannière de bienvenue -->
            <div class="bg-gradient-to-r from-amber-50 to-red-50 overflow-hidden shadow-lg sm:rounded-lg mb-6 border border-amber-200">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="bg-amber-100 p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-amber-800">{{ __('Bienvenue au Festival Eat&Drink') }}, {{ Auth::user()->name }}!</h2>
                            <p class="text-amber-700">{{ __('Découvrez des saveurs exceptionnelles et vivez une expérience gastronomique unique.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Carte des statistiques -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-amber-800">{{ __('Stands du festival') }}</h3>
                            <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-sm font-medium">{{ \App\Models\Stand::count() }} {{ __('stands') }}</span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ __('Découvrez tous les exposants du festival et leurs spécialités culinaires.') }}</p>
                        <a href="/stands" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            {{ __('Explorer les stands') }}
                        </a>
                    </div>
                </div>

                <!-- Carte Mes Commandes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-amber-800">{{ __('Mes commandes') }}</h3>
                            <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-sm font-medium">{{ Auth::user()->commandes()->count() }} {{ __('commandes') }}</span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ __('Suivez vos commandes passées et consultez leur statut en temps réel.') }}</p>
                        <a href="/commandes" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            {{ __('Voir mes commandes') }}
                        </a>
                    </div>
                </div>

                <!-- Carte Mon Profil -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-amber-800">{{ __('Mon profil') }}</h3>
                            <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-sm font-medium">{{ __(Auth::user()->role) }}</span>
                        </div>
                        <p class="text-gray-600 mb-4">{{ __('Gérez vos informations personnelles et vos préférences.') }}</p>
                        <a href="{{ route('profile.edit') }}" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ __('Modifier mon profil') }}
                        </a>
                    </div>
                </div>
            </div>

            @if(Auth::user()->isAdmin())
            <!-- Section Admin -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-200 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-amber-800 mb-4">{{ __('Administration du Festival') }}</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="border border-amber-100 rounded-lg p-4">
                            <h4 class="font-medium text-amber-700 mb-2">{{ __('Gestion des stands') }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ __('Approuver les demandes de stands des entrepreneurs') }}</p>
                            <a href="/admin/stands" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                <span>{{ __('Gérer les demandes') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="border border-amber-100 rounded-lg p-4">
                            <h4 class="font-medium text-amber-700 mb-2">{{ __('Gestion des utilisateurs') }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ __('Gérer les comptes et les rôles des utilisateurs') }}</p>
                            <a href="/admin/users" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                <span>{{ __('Gérer les utilisateurs') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="border border-amber-100 rounded-lg p-4">
                            <h4 class="font-medium text-amber-700 mb-2">{{ __('Statistiques') }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ __('Consulter les statistiques du festival') }}</p>
                            <a href="/admin/statistics" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                <span>{{ __('Voir les statistiques') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->isApprovedEntrepreneur())
            <!-- Section Entrepreneur -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-200 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-amber-800 mb-4">{{ __('Gestion de mon Stand') }}</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="border border-amber-100 rounded-lg p-4">
                            <h4 class="font-medium text-amber-700 mb-2">{{ __('Mes produits') }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ __('Gérez vos produits et leur disponibilité') }}</p>
                            <a href="/entrepreneur/produits" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                <span>{{ __('Gérer mes produits') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <div class="border border-amber-100 rounded-lg p-4">
                            <h4 class="font-medium text-amber-700 mb-2">{{ __('Commandes reçues') }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ __('Consultez et gérez les commandes pour votre stand') }}</p>
                            <a href="/entrepreneur/commandes" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                <span>{{ __('Voir les commandes') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->isPendingEntrepreneur())
            <!-- Section Entrepreneur en attente -->
            <div class="bg-amber-50 overflow-hidden shadow-sm sm:rounded-lg border border-amber-300 mb-6">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="bg-amber-100 p-2 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-amber-800 mb-2">{{ __('Demande de stand en cours d\'examen') }}</h3>
                            <p class="text-sm text-amber-700 mb-4">{{ __('Votre demande est actuellement en cours d\'examen par notre équipe. Vous recevrez une réponse très prochainement.') }}</p>
                            
                            <div class="mt-2">
                                <a href="/entrepreneur/stand/edit" class="text-amber-600 hover:text-amber-800 font-medium inline-flex items-center">
                                    <span>{{ __('Modifier ma demande') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Section Événements à venir -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-amber-800 mb-4">{{ __('Programme du Festival') }}</h3>
                    <div class="space-y-4">
                        <div class="border-l-4 border-amber-300 pl-4">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium text-amber-700">{{ __('Démonstration culinaire - Chef Jean Dupont') }}</h4>
                                <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-xs font-medium">{{ __('10:00 - 11:30') }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ __('Découvrez les secrets de la cuisine méditerranéenne avec notre chef étoilé.') }}</p>
                        </div>
                        
                        <div class="border-l-4 border-amber-300 pl-4">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium text-amber-700">{{ __('Atelier de dégustation de vins') }}</h4>
                                <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-xs font-medium">{{ __('14:00 - 16:00') }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ __('Une sélection des meilleurs crus régionaux expliqués par notre sommelier.') }}</p>
                        </div>
                        
                        <div class="border-l-4 border-amber-300 pl-4">
                            <div class="flex justify-between items-center">
                                <h4 class="font-medium text-amber-700">{{ __('Concert en plein air - Jazz & Gastronomie') }}</h4>
                                <span class="bg-amber-100 text-amber-800 py-1 px-3 rounded-full text-xs font-medium">{{ __('19:00 - 22:00') }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ __('Profitez d\'un moment musical exceptionnel accompagné de nos meilleures spécialités.') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="/programme" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-4 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ __('Voir tout le programme') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
