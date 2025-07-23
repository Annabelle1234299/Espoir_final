@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Retour aux stands -->
            <div class="mb-6">
                <a href="{{ # }}" class="inline-flex items-center text-amber-700 hover:text-amber-900 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Retour à tous les exposants
                </a>
            </div>

            <!-- En-tête du stand -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-8 border border-amber-100">
                <div class="md:flex">
                    <div class="md:w-1/3 h-64 md:h-auto bg-amber-50 relative">
                        @if($stand->image)
                            <img src="{{ Storage::url($stand->image) }}" alt="{{ $stand->nom }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full bg-gradient-to-br from-amber-100 to-amber-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:w-2/3">
                        <h1 class="text-3xl font-bold text-amber-800 mb-2">{{ $stand->nom }}</h1>
                        
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                {{ $stand->status == 'approuve' ? 'Approuvé' : $stand->status }}
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $stand->emplacement ?: 'Emplacement non assigné' }}
                            </span>
                        </div>
                        
                        <div class="prose max-w-none mb-6">
                            <p>{{ $stand->description }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-amber-200 flex items-center justify-center">
                                    @if($stand->user->photo_profil)
                                        <img src="{{ Storage::url($stand->user->photo_profil) }}" alt="{{ $stand->user->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="font-medium text-amber-800">{{ strtoupper(substr($stand->user->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $stand->user->name }}</p>
                                    <p class="text-xs text-gray-500">Entrepreneur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des produits -->
            <div>
                <h2 class="text-2xl font-bold text-amber-800 mb-6">Produits de ce stand</h2>
                
                @if($produits->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($produits as $produit)
                            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-amber-100 hover:shadow-lg transition-shadow duration-300">
                                <div class="h-48 bg-amber-50 relative overflow-hidden">
                                    @if($produit->image)
                                        <img src="{{ Storage::url($produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full bg-gradient-to-r from-amber-100 to-amber-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Badge prix -->
                                    <div class="absolute top-3 right-3 bg-amber-500 text-white px-3 py-1 rounded-full font-bold shadow-md">
                                        {{ number_format($produit->prix, 2, ',', ' ') }} €
                                    </div>
                                </div>
                                
                                <div class="p-5">
                                    <h3 class="text-xl font-semibold text-amber-800 mb-2">{{ $produit->nom }}</h3>
                                    
                                    <p class="text-gray-600 text-sm line-clamp-2 h-10 mb-4">{{ $produit->description }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-sm">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $produit->quantite > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $produit->quantite > 0 ? 'En stock' : 'Épuisé' }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex space-x-2">
                                            <a href="{{ route('public.produits.show', $produit) }}" class="inline-flex items-center px-3 py-1 border border-amber-600 text-sm font-medium rounded text-amber-700 bg-white hover:bg-amber-50">
                                                Détails
                                            </a>
                                            
                                            @if($produit->quantite > 0)
                                                <!-- Formulaire panier supprimé -->>
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded text-white bg-amber-600 hover:bg-amber-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                        Ajouter
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $produits->links() }}
                    </div>
                @else
                    <div class="bg-white shadow-md rounded-lg p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun produit disponible</h3>
                        <p class="mt-1 text-sm text-gray-500">Cet exposant n'a pas encore ajouté de produits.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
