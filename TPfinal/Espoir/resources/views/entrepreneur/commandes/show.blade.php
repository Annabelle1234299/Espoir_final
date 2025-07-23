<x-entrepreneur-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la commande #' . $commande->id) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations de la commande -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informations de la commande</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600 text-sm">Date de la commande</p>
                                    <p>{{ $commande->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Statut</p>
                                    <p>
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
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Total</p>
                                    <p class="text-lg font-bold">{{ number_format($commande->total, 2) }} €</p>
                                </div>
                            </div>
                        </div>

                        <!-- Informations du client -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Client</h3>
                            <p><strong>Nom:</strong> {{ $commande->user->name }}</p>
                            <p><strong>Email:</strong> {{ $commande->user->email }}</p>
                            
                            @if($commande->status !== 'annule' && $commande->status !== 'livre')
                            <div class="mt-6">
                                <h4 class="font-medium mb-2">Changer le statut</h4>
                                <div class="flex flex-wrap gap-2">
                                    @if($commande->status === 'en_attente')
                                    <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="traite">
                                        <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Marquer comme traité</button>
                                    </form>
                                    @endif
                                    
                                    @if($commande->status === 'traite')
                                    <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="expedie">
                                        <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">Marquer comme expédié</button>
                                    </form>
                                    @endif
                                    
                                    @if($commande->status === 'expedie')
                                    <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="livre">
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Marquer comme livré</button>
                                    </form>
                                    @endif
                                    
                                    <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="annule">
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Annuler la commande</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Détails des produits -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Produits commandés</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix unitaire</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantité</th>
                                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commande->details as $produitId => $detail)
                                <tr>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        <div class="flex items-center">
                                            @if(isset($detail['image']))
                                                <img src="{{ asset('storage/' . $detail['image']) }}" alt="{{ $detail['nom'] }}" class="h-10 w-10 rounded-full mr-2 object-cover">
                                            @endif
                                            <span>{{ $detail['nom'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ number_format($detail['prix'], 2) }} €</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $detail['quantite'] }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ number_format($detail['prix'] * $detail['quantite'], 2) }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="py-3 px-4 border-b border-gray-200 text-right font-bold">Total:</td>
                                    <td class="py-3 px-4 border-b border-gray-200 font-bold">{{ number_format($commande->total, 2) }} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('entrepreneur.commandes.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    Retour à la liste des commandes
                </a>
            </div>
        </div>
    </div>
</x-entrepreneur-layout>
