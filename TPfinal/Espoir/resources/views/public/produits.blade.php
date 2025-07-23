@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-amber-800 mb-2">Nos produits africains</h1>
                <p class="text-gray-600">Découvrez tous les produits authentiques proposés par nos exposants.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <!-- Filtres (peut être implémenté plus tard) -->
                <div class="md:w-1/4 bg-white shadow-md rounded-lg p-4 h-fit">
                    <h2 class="font-semibold text-lg mb-4 text-amber-800">Filtres</h2>
                    <div class="space-y-4">
                        <!-- Filtre par catégorie -->
                        <div>
                            <h3 class="font-medium mb-2">Catégories</h3>
                            <div class="space-y-2">
                                <!-- Ces catégories seront dynamiques dans une version future -->
                                <div class="flex items-center">
                                    <input id="cat-alimentaire" name="categorie" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                    <label for="cat-alimentaire" class="ml-2 block text-sm text-gray-700">Alimentaire</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cat-boissons" name="categorie" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                    <label for="cat-boissons" class="ml-2 block text-sm text-gray-700">Boissons</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="cat-artisanat" name="categorie" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                    <label for="cat-artisanat" class="ml-2 block text-sm text-gray-700">Artisanat</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Filtre par prix -->
                        <div>
                            <h3 class="font-medium mb-2">Prix</h3>
                            <div>
                                <input type="range" min="0" max="100" value="50" class="w-full h-2 bg-amber-200 rounded-lg appearance-none cursor-pointer">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>0€</span>
                                    <span>50€</span>
                                    <span>100€</span>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            Appliquer les filtres
                        </button>
                    </div>
                </div>
                
                <!-- Liste des produits -->
                <div class="md:w-3/4">
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
                                        <h3 class="text-xl font-semibold text-amber-800 mb-1">{{ $produit->nom }}</h3>
                                        
                                        <a href="{{ route('public.stands.show', $produit->stand) }}" class="text-sm text-amber-600 hover:text-amber-800 mb-2 block">
                                            {{ $produit->stand->nom }}
                                        </a>
                                        
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
                                                    <!-- Formulaire panier supprimé --> class="inline-flex items-center">
                                                        @csrf
                                                        <input type="hidden" name="quantite" value="1">
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
                            <p class="mt-1 text-sm text-gray-500">Les produits seront bientôt disponibles.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
