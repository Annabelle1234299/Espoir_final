<x-entrepreneur-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mes produits') }}
            </h2>
            <a href="{{ route('produits.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Ajouter un produit
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if(count($produits) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($produits as $produit)
                        <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                            @if($produit->image)
                                <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                    Pas d'image
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-1">{{ $produit->nom }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($produit->description, 100) }}</p>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="font-bold text-lg">{{ number_format($produit->prix, 2) }} €</span>
                                    <span class="text-sm {{ $produit->quantite > 0 ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $produit->quantite > 0 ? 'En stock: ' . $produit->quantite : 'Rupture de stock' }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('produits.edit', $produit->id) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded">Modifier</a>
                                    <a href="{{ route('produits.show', $produit->id) }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center py-2 rounded">Détails</a>
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="flex-none" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $produits->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg mb-4">Vous n'avez pas encore ajouté de produits.</p>
                    <a href="{{ route('produits.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-lg font-medium">
                        Ajouter mon premier produit
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-entrepreneur-layout>
