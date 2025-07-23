@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Fil d'Ariane -->
            <div class="mb-6 flex flex-wrap items-center text-sm">
                <a href="{{ route('produits.index') }}" class="text-amber-700 hover:text-amber-900">Accueil</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('public.produits') }}" class="text-amber-700 hover:text-amber-900">Produits</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-600 truncate max-w-xs">{{ $produit->nom }}</span>
            </div>

            <!-- Détails du produit -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-8 border border-amber-100">
                <div class="md:flex">
                    <div class="md:w-2/5 h-80 md:h-auto bg-amber-50 relative">
                        @if($produit->image)
                            <img src="{{ Storage::url($produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-full object-contain">
                        @else
                            <div class="flex items-center justify-center h-full bg-gradient-to-br from-amber-100 to-amber-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:w-3/5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-bold text-amber-800 mb-2">{{ $produit->nom }}</h1>
                                <a href="{{ route('public.stands.show', $produit->stand) }}" class="text-amber-600 hover:text-amber-800 text-lg mb-4 inline-block">
                                    Par {{ $produit->stand->nom }}
                                </a>
                            </div>
                            <div class="bg-amber-500 text-white px-4 py-2 rounded-lg font-bold text-xl shadow-md">
                                {{ number_format($produit->prix, 2, ',', ' ') }} €
                            </div>
                        </div>
                        
                        <div class="my-6 border-t border-b border-amber-100 py-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Description</h2>
                            <div class="prose text-gray-700">
                                <p>{{ $produit->description }}</p>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Caractéristiques</h2>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">Origine africaine authentique</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">Qualité premium</span>
                                </div>
                                @if($produit->stand->categorie == 'Alimentaire')
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">Ingrédients naturels</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="text-lg font-semibold">Disponibilité:</div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $produit->quantite > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $produit->quantite > 0 ? 'En stock (' . $produit->quantite . ' disponibles)' : 'Épuisé' }}
                                </span>
                            </div>
                            
                            @if($produit->quantite > 0)
                                <!-- Formulaire panier supprimé --> class="flex flex-wrap gap-4 items-end">
                                    @csrf
                                    <div>
                                        <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">Quantité</label>
                                        <select id="quantite" name="quantite" class="mt-1 block w-24 pl-3 pr-10 py-2 text-base border-amber-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md">
                                            @for ($i = 1; $i <= min(10, $produit->quantite); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <button type="submit" class="flex-grow sm:flex-grow-0 bg-amber-600 hover:bg-amber-700 text-white py-2 px-6 rounded-md font-medium flex items-center justify-center transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Ajouter au panier
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-gray-400 text-white py-2 px-6 rounded-md font-medium flex items-center justify-center opacity-70 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Produit indisponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produits similaires -->
            @if($relatedProduits->count() > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-amber-800 mb-6">Produits similaires</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($relatedProduits as $relatedProduit)
                            <div class="bg-white overflow-hidden shadow-md rounded-lg border border-amber-100 hover:shadow-lg transition-shadow duration-300">
                                <div class="h-40 bg-amber-50 relative overflow-hidden">
                                    @if($relatedProduit->image)
                                        <img src="{{ Storage::url($relatedProduit->image) }}" alt="{{ $relatedProduit->nom }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full bg-gradient-to-r from-amber-100 to-amber-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute top-2 right-2 bg-amber-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        {{ number_format($relatedProduit->prix, 2, ',', ' ') }} €
                                    </div>
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-amber-800 mb-1 truncate">{{ $relatedProduit->nom }}</h3>
                                    
                                    <div class="flex justify-between items-center mt-3">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $relatedProduit->quantite > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $relatedProduit->quantite > 0 ? 'En stock' : 'Épuisé' }}
                                        </span>
                                        
                                        <a href="{{ route('public.produits.show', $relatedProduit) }}" class="text-amber-700 hover:text-amber-900">
                                            Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
