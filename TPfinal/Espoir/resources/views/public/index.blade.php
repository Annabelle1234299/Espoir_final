@extends('layouts.app')

@section('title', 'Bienvenue sur Eat&Drink Festival')

@section('content')
<!-- Section Hero avec animation -->  
<div class="relative min-h-screen">
    <!-- Background avec image floue -->
    <div class="absolute inset-0 bg-gradient-to-br from-amber-800 via-red-700 to-rose-900 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-food-pattern opacity-20"></div>
    </div>

    <!-- Conteneur principal -->
    <div class="relative container mx-auto px-4 py-16 md:py-24 flex flex-col min-h-screen">
        
        <!-- Hero section -->
        <div class="flex flex-col md:flex-row items-center justify-between my-auto">
            <div class="md:w-1/2 text-center md:text-left mb-12 md:mb-0">
                <div class="animate-fade-in-down">
                    <span class="inline-block py-1 px-3 rounded-full bg-yellow-200 text-amber-800 font-semibold mb-4 animate-pulse-slow">Festival Gastronomique 2025</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                        <span class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-yellow-200 to-amber-400">Eat&Drink</span>
                        <br><span class="text-rose-200">Festival</span>
                    </h1>
                    <p class="text-xl text-gray-200 mb-8 max-w-lg">
                        Découvrez les délices culinaires et boissons artisanales de notre région lors du plus grand festival gastronomique de l'année.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <!-- Lien login supprimé --> class="px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-red-600 text-white font-medium hover:from-amber-600 hover:to-red-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 duration-300 text-lg flex items-center justify-center group">
                            <span>Voir le menu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-full bg-transparent border-2 border-yellow-300 text-yellow-300 font-medium hover:bg-yellow-300 hover:text-amber-900 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 duration-300 text-lg flex items-center justify-center">
                            <span>Réserver</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="md:w-1/2 relative">
                <!-- Images superposées avec animations -->
                <div class="relative animate-float w-full max-w-md mx-auto">
                    <!-- Première image avec effet d'ombre -->
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-red-500 rounded-2xl blur transform rotate-6 scale-105 opacity-30"></div>
                    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9 bg-amber-100 flex items-center justify-center">
                            <div class="text-amber-800 text-center p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold text-lg">Festival Gastronomique</span>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h3 class="text-white text-xl font-semibold">Saveurs & Délices</h3>
                            <p class="text-gray-300">Du 15 au 20 août 2025</p>
                        </div>
                    </div>
                </div>
                
                <!-- Badges flottants -->
                <div class="absolute -top-4 -right-4 bg-amber-400 rounded-full p-4 shadow-xl animate-pulse-slow hidden md:block">
                    <div class="text-red-900 font-bold text-sm">Cuisine<br>Locale</div>
                </div>
                <div class="absolute -bottom-6 -left-6 bg-rose-500 rounded-full p-4 shadow-xl animate-pulse-slow hidden md:block">
                    <div class="text-white font-bold text-sm">Boissons<br>Artisanales</div>
                </div>
                
                <!-- Petits éléments décoratifs animés -->
                <div class="absolute top-1/4 right-1/3 w-6 h-6 rounded-full bg-yellow-300 animate-bounce-slow opacity-70"></div>
                <div class="absolute bottom-1/3 right-1/4 w-4 h-4 rounded-full bg-rose-400 animate-ping opacity-60" style="animation-duration: 3s;"></div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce text-center hidden md:block">
            <a href="#stands" class="text-amber-200 opacity-80 hover:opacity-100 transition">
                <span class="block mb-2 text-sm">Découvrir les stands</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
        
        <!-- Dates du festival (nouveau) -->
        <div class="absolute top-4 right-4 text-right hidden lg:block">
            <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium">15-20 Août 2025 • Parc Central</span>
            </div>
        </div>
    </div>
</div>

<!-- Section Stands (Restaurants & Boissons) -->
<section id="stands" class="py-16 bg-gradient-to-b from-amber-50 to-amber-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 rounded-full bg-amber-200 text-amber-800 font-medium mb-4">Exposants 2025</span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Découvrez nos <span class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-amber-600 to-red-600">Restaurants & Bars</span></h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Explorez notre sélection de délicieux restaurants et bars tenus par des chefs et mixologues passionnés qui proposent des créations culinaires uniques.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($stands) > 0)
                @foreach($stands as $stand)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl hover:-translate-y-2 group">
                        <!-- Badge de type (restaurant ou bar) -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-{{ $stand->category == 'Nourriture' ? 'amber-500' : 'red-500' }} text-white text-xs px-3 py-1 rounded-full uppercase font-semibold tracking-wide shadow-md">
                                {{ $stand->category == 'Nourriture' ? 'Restaurant' : 'Bar' }}
                            </span>
                        </div>

                        <div class="h-56 bg-amber-100 relative overflow-hidden">
                            @if($stand->image)
                                <img src="{{ asset('storage/' . $stand->image) }}" alt="{{ $stand->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full bg-gradient-to-br from-amber-200 to-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        @if($stand->category == 'Nourriture')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        @endif
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                <h3 class="text-white text-xl font-bold">{{ $stand->name }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <!-- Chef ou Mixologue -->
                            <div class="flex items-center mb-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700 font-medium">{{ $stand->user->name ?? 'Chef' }}</span>
                                </div>
                                
                                <div class="ml-auto flex items-center text-amber-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-semibold">{{ number_format($stand->rating, 1) }}</span>
                                    <span class="text-gray-500 text-sm ml-1">({{ $stand->reviews_count ?? 0 }})</span>
                                </div>
                            </div>
                            
                            <p class="text-gray-600 mb-5 line-clamp-2">{{ Str::limit($stand->description, 100) }}</p>
                            
                            <!-- Spécialités -->
                            <div class="mb-5">
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-xs px-2 py-1 bg-amber-100 text-amber-800 rounded-full">Spécialité locale</span>
                                    <span class="text-xs px-2 py-1 bg-amber-100 text-amber-800 rounded-full">{{ $stand->category == 'Nourriture' ? 'Cuisine fusion' : 'Cocktails signature' }}</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('public.stands.show', $stand) }}" class="text-amber-600 font-semibold hover:text-amber-800 flex items-center group-hover:translate-x-1 transition-transform">
                                Voir le menu
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full bg-white rounded-xl shadow-md p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-gray-600 text-lg mb-2">Aucun exposant disponible pour le moment.</p>
                    <p class="text-gray-500">Les stands du festival seront annoncés prochainement.</p>
                </div>
            @endif
        </div>

        @if(count($stands) > 0)
            <div class="mt-12 text-center">
                <a href="{{ # }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-full text-white bg-gradient-to-r from-amber-500 to-red-600 hover:from-amber-600 hover:to-red-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-1 duration-300">
                    Voir tous les exposants
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Section Plats & Boissons Populaires -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
    <!-- Éléments décoratifs d'arrière-plan -->
    <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full bg-amber-100 opacity-50"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-rose-50 opacity-40"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 rounded-full bg-red-100 text-red-800 font-medium mb-4">À ne pas manquer</span>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Plats & Boissons <span class="text-gradient bg-clip-text text-transparent bg-gradient-to-r from-amber-600 to-red-600">Signatures</span></h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Découvrez les créations culinaires et mixologiques exclusives de notre festival gastronomique</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Plats et boissons dynamiques -->
            @php
                $produits = \App\Models\Produit::where('available', true)
                    ->orderBy('created_at', 'desc')
                    ->limit(8)
                    ->get();
            @endphp
            
            @forelse ($produits as $produit)
            <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-xl transform transition duration-300 hover:-translate-y-2">
                <div class="relative h-56 overflow-hidden">
                    <!-- Badge catégorie -->
                    <div class="absolute top-3 left-3 z-10">
                        @php
                            $categories = [
                                'nourriture' => ['bg-amber-100 text-amber-800', 'Plat'],
                                'boisson' => ['bg-red-100 text-red-800', 'Boisson'],
                                'dessert' => ['bg-pink-100 text-pink-800', 'Dessert']
                            ];
                            $category = $produit->categorie ?? 'nourriture';
                            [$bgClass, $label] = $categories[$category] ?? $categories['nourriture'];
                        @endphp
                        <span class="{{ $bgClass }} text-xs px-2 py-1 rounded-full uppercase font-semibold tracking-wide">{{ $label }}</span>
                    </div>
                    
                    <!-- Image avec effet de zoom au survol -->
                    @if($produit->image)
                        <img src="{{ asset('storage/' . $produit->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $produit->nom }}">
                    @else
                        <div class="w-full h-full bg-gradient-to-br {{ $category == 'boisson' ? 'from-red-200 to-rose-300' : 'from-amber-200 to-amber-300' }} flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 {{ $category == 'boisson' ? 'text-red-600' : 'text-amber-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if($category == 'boisson')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                @endif
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Prix -->
                    <div class="absolute top-3 right-3 bg-white text-amber-900 font-bold px-3 py-1 rounded-full shadow-md">
                        {{ number_format($produit->prix, 2) }} €
                    </div>
                </div>
                
                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-bold text-lg text-gray-900 truncate">{{ $produit->nom }}</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm ml-1 text-gray-700 font-medium">{{ $produit->note ?? '4.5' }}</span>
                        </div>
                    </div>
                    
                    <p class="text-amber-700 text-sm font-medium mb-3">{{ $produit->stand->nom ?? 'Chef invité' }}</p>
                    
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ Str::limit($produit->description, 80) }}</p>
                    
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full">{{ ucfirst($category) }}</span>
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded-full">{{ $produit->tags ?? 'Signature' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <a href="#" class="text-red-600 font-semibold hover:text-red-800 flex items-center group-hover:translate-x-1 transition-transform">
                            Voir détails
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        
                        <button class="p-2 rounded-full bg-amber-100 text-amber-700 hover:bg-amber-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 bg-white rounded-xl shadow-md p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-gray-600 text-lg mb-2">Menu en cours de préparation</p>
                <p class="text-gray-500">Les créations culinaires seront disponibles prochainement.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center px-8 py-4 rounded-full text-white bg-gradient-to-r from-amber-500 to-red-600 hover:from-amber-600 hover:to-red-700 font-medium transition shadow-md hover:shadow-xl transform hover:-translate-y-1 duration-300">
                <span>Découvrir toute notre carte</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Section Réservation et Infos Pratiques -->
<section class="py-16 md:py-24 relative overflow-hidden bg-gradient-to-r from-red-800 to-amber-800">
    <!-- Éléments décoratifs -->
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-white/10 to-transparent"></div>
    <div class="absolute bottom-0 right-0 w-full h-32 bg-gradient-to-t from-black/20 to-transparent"></div>
    
    <!-- Motifs de nourriture en arrière-plan -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-16 h-16">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M18 4h2v16h-2zM4 4h2v16H4zm3 4h10v1H7zm0 3h10v1H7zm0 3h10v1H7zm0 3h10v1H7z"/></svg>
        </div>
        <div class="absolute top-1/4 right-1/4 w-16 h-16">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M11 19v-5.111L3 5V3h18v2l-8 8.889V19h5v2H6v-2h5zM7.49 7h9.02l1.5-2H5.99l1.5 2z"/></svg>
        </div>
        <div class="absolute bottom-1/3 left-1/3 w-16 h-16">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M20.832 4.555A1 1 0 0020 3H4a1 1 0 00-.832 1.554L11 16.303V20H8v2h8v-2h-3v-3.697L20.832 4.555zM6.535 5h10.93l-1.429 2H7.964l-1.429-2z"/></svg>
        </div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="md:w-1/2">
                <span class="inline-block py-1 px-3 rounded-full bg-amber-200 text-amber-800 font-semibold mb-4">15-20 Août 2025</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Réservez votre <span class="text-yellow-300">expérience culinaire</span></h2>
                <p class="text-gray-200 mb-8 text-lg">
                    Ne manquez pas le plus grand festival gastronomique de l'année. Réservez vos billets maintenant et préparez-vous à vivre une expérience gustative inoubliable !
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-amber-500 p-2 rounded-full mr-4 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-1">Programme Exceptionnel</h3>
                            <p class="text-gray-300">Découvrez plus de 50 exposants, des masterclass par des chefs renommés et des dégustations uniques pendant 5 jours de festival.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-amber-500 p-2 rounded-full mr-4 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-1">Lieu Exceptionnel</h3>
                            <p class="text-gray-300">Le festival se tiendra au Parc Central, facilement accessible par les transports en commun et offrant un cadre idéal en plein air.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-amber-500 p-2 rounded-full mr-4 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-1">Réservation Anticipée</h3>
                            <p class="text-gray-300">Profitez de tarifs préférentiels en réservant vos billets à l'avance et accédez aux événements VIP exclusifs.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-10">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 text-amber-900 font-bold hover:from-amber-300 hover:to-amber-400 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 duration-300">
                        <span>Réserver maintenant</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    
                    <a href="#" class="inline-flex items-center px-8 py-4 rounded-full bg-transparent border-2 border-white text-white font-bold ml-4 hover:bg-white hover:text-amber-900 transition">
                        <span>Programme complet</span>
                    </a>
                </div>
            </div>
            
            <div class="md:w-1/2 relative">
                <!-- Carte du festival avec emplacement -->
                <div class="rounded-xl overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500 relative bg-amber-100">
                    <div class="aspect-w-4 aspect-h-3 bg-amber-200 flex items-center justify-center p-6">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-amber-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-amber-900 mb-2">Parc Central</h3>
                            <p class="text-amber-800">123 Avenue Principale<br>75001 Paris, France</p>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-amber-900 to-transparent p-6">
                        <div class="flex justify-between items-center">
                            <div class="text-white">
                                <div class="font-bold">Ouverture</div>
                                <div>10h - 22h</div>
                            </div>
                            <div class="text-white text-right">
                                <div class="font-bold">Tarif</div>
                                <div>À partir de 15€</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Badge flottant -->
                <div class="absolute -top-6 -right-6 bg-red-500 rounded-full p-4 shadow-xl animate-pulse-slow hidden md:block">
                    <div class="text-white font-bold text-sm">Places<br>Limitées</div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .text-gradient {
        background-size: 100%;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent; 
        -moz-text-fill-color: transparent;
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 1s ease-out;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
    
    .bg-grid-pattern {
        background-image: linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 30px 30px;
    }
</style>
@endsection
