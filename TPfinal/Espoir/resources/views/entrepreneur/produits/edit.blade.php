<x-entrepreneur-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le produit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('produits.update', $produit->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du produit</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $produit->nom) }}" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $produit->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">Prix (€)</label>
                                <input type="number" name="prix" id="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0" required
                                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('prix')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">Quantité en stock</label>
                                <input type="number" name="quantite" id="quantite" value="{{ old('quantite', $produit->quantite) }}" min="0" required
                                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('quantite')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image du produit</label>
                            @if($produit->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="h-32 object-cover rounded-md">
                                    <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" name="image" id="image" 
                                class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-sm text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle. Format recommandé : JPG, PNG ou GIF, max 2 Mo</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('produits.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray transition ease-in-out duration-150 mr-3">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150">
                                Mettre à jour le produit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-entrepreneur-layout>
