@extends('layouts.app')

@section('content')
    <div class="py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-bold text-xl text-amber-800 leading-tight font-playfair">
                {{ __('Tableau de bord entrepreneur') }}
            </h2>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Statistiques du stand -->
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Mon Stand</h3>
                    <div>
                        <p class="text-gray-600">Nom du stand</p>
                        <p class="text-xl font-bold">{{ $stand->nom ?? '-' }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-600">Emplacement</p>
                        <p class="text-xl">{{ $stand->emplacement ?? '-' }}</p>
                    </div>

                </div>
                
                <!-- Statistiques des produits -->
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Mes Produits</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600">Total</p>
                            <p class="text-3xl font-bold">{{ $totalProduits ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">En stock</p>
                            <p class="text-3xl font-bold">{{ $produitsEnStock ?? 0 }}</p>
                        </div>
                    </div>
                    <a href="{{ route('produits.index') }}" class="mt-4 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Gérer mes produits
                    </a>
                </div>
                
                <!-- Statistiques des commandes -->
                <div class="bg-yellow-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Mes Commandes</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600">Total</p>
                            <p class="text-3xl font-bold">{{ $totalCommandes ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">En attente</p>
                            <p class="text-3xl font-bold">{{ $commandesEnAttente ?? 0 }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Dernières commandes -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold mb-4">Dernières commandes</h3>
                <div class="overflow-x-auto">
                    @if(isset($recentCommandes) && count($recentCommandes ?? []) > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentCommandes as $commande)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-200">#{{ $commande->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $commande->user->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ number_format($commande->total, 2) }} €</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    @if ($commande->status === 'en_attente')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En attente</span>
                                    @elseif ($commande->status === 'traite')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Traité</span>
                                    @elseif ($commande->status === 'expedie')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Expédié</span>
                                    @elseif ($commande->status === 'livre')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Livré</span>
                                    @elseif ($commande->status === 'annule')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Annulé</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <a href="{{ route('entrepreneur.commandes.show', $commande->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Détails</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-500">Aucune commande récente</p>
                    @endif
                </div>
            </div>

            <!-- Derniers produits -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Mes produits récents</h3>
                    <a href="{{ route('produits.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">Ajouter un produit</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($recentProduits as $produit)
                    <div class="border rounded-lg overflow-hidden">
                        @if($produit->image)
                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                            Pas d'image
                        </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold mb-1">{{ $produit->nom }}</h4>
                            <p class="text-gray-500 text-sm mb-2">{{ Str::limit($produit->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold">{{ number_format($produit->prix, 2) }} €</span>
                                <span class="text-sm {{ $produit->quantite > 0 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $produit->quantite > 0 ? 'En stock: ' . $produit->quantite : 'Rupture de stock' }}
                                </span>
                            </div>
                            <div class="mt-3 flex space-x-2">
                                <a href="{{ route('produits.edit', $produit->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Modifier</a>
                                <a href="{{ route('produits.show', $produit->id) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600 text-xs">Détails</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Vous n'avez pas encore ajouté de produits.</p>
                        <a href="{{ route('produits.create') }}" class="mt-2 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Ajouter mon premier produit
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
