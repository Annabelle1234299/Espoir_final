<x-entrepreneur-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Détails du produit') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('produits.edit', $produit->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Modifier
                </a>
                <a href="{{ route('produits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Retour à la liste
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Image du produit -->
                        <div>
                            @if($produit->image)
                                <div class="rounded-lg overflow-hidden shadow-lg">
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-auto">
                                </div>
                            @else
                                <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400 rounded-lg">
                                    <p>Pas d'image disponible</p>
                                </div>
                            @endif
                        </div>

                        <!-- Informations du produit -->
                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $produit->nom }}</h1>
                            
                            <div class="mb-6">
                                <p class="text-3xl font-bold text-blue-600 mb-2">{{ number_format($produit->prix, 2) }} €</p>
                                
                                <div class="flex items-center mt-2">
                                    <span class="mr-2 font-semibold">Stock :</span>
                                    <span class="{{ $produit->quantite > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                        {{ $produit->quantite > 0 ? $produit->quantite . ' unités' : 'Rupture de stock' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Description</h3>
                                <p class="text-gray-700">{{ $produit->description }}</p>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Informations complémentaires</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-600 text-sm">Date de création</p>
                                        <p>{{ $produit->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm">Dernière mise à jour</p>
                                        <p>{{ $produit->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('produits.edit', $produit->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Modifier
                                </a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-entrepreneur-layout>
