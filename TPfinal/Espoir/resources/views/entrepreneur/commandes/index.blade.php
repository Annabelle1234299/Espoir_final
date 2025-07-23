<x-entrepreneur-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des commandes') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => '']) }}" class="px-4 py-2 rounded-full text-sm {{ !request('status') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        Toutes
                    </a>
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => 'en_attente']) }}" class="px-4 py-2 rounded-full text-sm {{ request('status') === 'en_attente' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        En attente
                    </a>
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => 'traite']) }}" class="px-4 py-2 rounded-full text-sm {{ request('status') === 'traite' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        Traitées
                    </a>
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => 'expedie']) }}" class="px-4 py-2 rounded-full text-sm {{ request('status') === 'expedie' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        Expédiées
                    </a>
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => 'livre']) }}" class="px-4 py-2 rounded-full text-sm {{ request('status') === 'livre' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        Livrées
                    </a>
                    <a href="{{ route('entrepreneur.commandes.index', ['status' => 'annule']) }}" class="px-4 py-2 rounded-full text-sm {{ request('status') === 'annule' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}">
                        Annulées
                    </a>
                </div>
            </div>

            @if($commandes->count() > 0)
                <div class="overflow-x-auto">
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
                            @foreach ($commandes as $commande)
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
                                    <div class="flex space-x-2">
                                        <a href="{{ route('entrepreneur.commandes.show', $commande->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Détails</a>
                                        
                                        @if($commande->status === 'en_attente')
                                        <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="traite">
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">Traiter</button>
                                        </form>
                                        @endif
                                        
                                        @if($commande->status === 'traite')
                                        <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="expedie">
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">Expédier</button>
                                        </form>
                                        @endif
                                        
                                        @if($commande->status === 'expedie')
                                        <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="livre">
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">Marquer comme livré</button>
                                        </form>
                                        @endif
                                        
                                        @if($commande->status !== 'annule' && $commande->status !== 'livre')
                                        <form action="{{ route('entrepreneur.commandes.update-status', $commande->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="annule">
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">Annuler</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $commandes->links() }}
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Aucune commande trouvée</p>
                </div>
            @endif
        </div>
    </div>
</x-entrepreneur-layout>
