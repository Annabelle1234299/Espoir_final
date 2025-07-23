@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-amber-800 mb-6">Résultats de recherche pour "{{ $query }}"</h1>

    @if($stands->isEmpty() && $produits->isEmpty())
        <div class="bg-amber-50 border border-amber-200 p-8 rounded-lg text-center">
            <p class="text-xl text-amber-800 mb-4">Aucun résultat trouvé pour "{{ $query }}"</p>
            <p class="text-gray-600">Essayez d'autres termes de recherche ou consultez notre catalogue complet.</p>
            <div class="flex justify-center gap-4 mt-6">
                <a href="{{ # }}" class="bg-amber-600 text-white py-2 px-6 rounded-lg hover:bg-amber-700 transition">
                    Voir tous les stands
                </a>
                <a href="{{ route('public.produits') }}" class="bg-amber-600 text-white py-2 px-6 rounded-lg hover:bg-amber-700 transition">
                    Voir tous les produits
                </a>
            </div>
        </div>
    @else
        <!-- Résultats des stands -->
        @if($stands->isNotEmpty())
            <section class="mb-10">
                <h2 class="text-xl font-bold text-amber-700 mb-4">Stands ({{ $stands->count() }})</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($stands as $stand)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md border border-amber-100 hover:shadow-lg transition">
                            @if($stand->photo_url)
                                <img src="{{ asset('storage/' . $stand->photo_url) }}" alt="{{ $stand->nom }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-amber-100 flex items-center justify-center">
                                    <span class="text-amber-400 text-lg">Photo non disponible</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-amber-800">{{ $stand->nom }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($stand->description, 100) }}</p>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-amber-600 text-sm">{{ $stand->user->name }}</span>
                                    <a href="{{ route('public.stands.show', $stand->id) }}" class="text-amber-600 hover:text-amber-800 font-medium">
                                        Voir le stand &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Résultats des produits -->
        @if($produits->isNotEmpty())
            <section>
                <h2 class="text-xl font-bold text-amber-700 mb-4">Produits ({{ $produits->count() }})</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($produits as $produit)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md border border-amber-100 hover:shadow-lg transition">
                            @if($produit->photo_url)
                                <img src="{{ asset('storage/' . $produit->photo_url) }}" alt="{{ $produit->nom }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-amber-50 flex items-center justify-center">
                                    <span class="text-amber-300">Photo non disponible</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-amber-800">{{ $produit->nom }}</h3>
                                <p class="text-gray-500 text-sm mb-2">{{ $produit->stand->nom }}</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-amber-600 font-bold">{{ number_format($produit->prix, 2) }} €</span>
                                    <a href="{{ route('public.produits.show', $produit->id) }}" class="text-amber-600 hover:text-amber-800">
                                        Détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endif
</div>
@endsection
