<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Toutes les commandes') }}
        </h2>
    </x-slot>
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold text-amber-800 mb-6">Toutes les commandes</h1>
                
                <!-- Filtres -->
                <div class="mb-6 flex flex-wrap gap-2 bg-amber-50 p-4 rounded-md">
                    <button class="filter-btn active bg-amber-600 text-white px-3 py-1 rounded hover:bg-amber-700 transition text-xs" data-filter="all">
                        Toutes
                    </button>
                    <button class="filter-btn bg-amber-100 text-amber-800 px-3 py-1 rounded hover:bg-amber-200 transition text-xs" data-filter="en_attente">
                        En attente
                    </button>
                    <button class="filter-btn bg-amber-100 text-amber-800 px-3 py-1 rounded hover:bg-amber-200 transition text-xs" data-filter="en_preparation">
                        En préparation
                    </button>
                    <button class="filter-btn bg-amber-100 text-amber-800 px-3 py-1 rounded hover:bg-amber-200 transition text-xs" data-filter="prete">
                        Prête
                    </button>
                    <button class="filter-btn bg-amber-100 text-amber-800 px-3 py-1 rounded hover:bg-amber-200 transition text-xs" data-filter="livree">
                        Livrée
                    </button>
                    <button class="filter-btn bg-amber-100 text-amber-800 px-3 py-1 rounded hover:bg-amber-200 transition text-xs" data-filter="annulee">
                        Annulée
                    </button>
                </div>

                <!-- Tableau des commandes -->
                @if($orders->isEmpty())
                    <div class="text-center py-12 bg-amber-50 rounded-lg">
                        <p class="text-xl text-amber-800">Aucune commande trouvée</p>
                        <p class="text-amber-600 mt-2">Les commandes s'afficheront ici une fois que les clients auront passé des commandes.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-amber-200">
                            <thead class="bg-amber-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Date</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Client</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Stand</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Total</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Statut</th>
                                    <th class="py-3 px-4 text-left text-amber-800 font-semibold text-xs uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="order-row border-b border-amber-100" data-status="{{ $order->status }}">
                                        <td class="py-3 px-4 text-gray-700">#{{ $order->id }}</td>
                                        <td class="py-3 px-4 text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3 px-4 text-gray-700">
                                            {{ $order->user->name }}<br>
                                            <span class="text-sm text-gray-500">{{ $order->user->email }}</span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700">{{ $order->stand->nom }}</td>
                                        <td class="py-3 px-4 font-semibold text-gray-700">{{ number_format($order->total, 2) }} €</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-block px-2 py-1 text-xs rounded 
                                                @if($order->status == 'en_attente') bg-yellow-100 text-yellow-800 
                                                @elseif($order->status == 'en_preparation') bg-blue-100 text-blue-800 
                                                @elseif($order->status == 'prete') bg-green-100 text-green-800 
                                                @elseif($order->status == 'livree') bg-indigo-100 text-indigo-800
                                                @elseif($order->status == 'annulee') bg-red-100 text-red-800 @endif">
                                                @if($order->status == 'en_attente') En attente 
                                                @elseif($order->status == 'en_preparation') En préparation 
                                                @elseif($order->status == 'prete') Prête 
                                                @elseif($order->status == 'livree') Livrée
                                                @elseif($order->status == 'annulee') Annulée @endif
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <button class="details-btn px-3 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 text-xs" data-order-id="{{ $order->id }}">
                                                Détails
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Détails de la commande (masqués par défaut) -->
                                    <tr id="details-{{ $order->id }}" class="order-details hidden bg-amber-50">
                                        <td colspan="7" class="py-4 px-6">
                                            <h4 class="font-semibold text-amber-800 mb-2">Produits commandés</h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                @foreach($order->details as $productId => $product)
                                                    <div class="bg-white p-3 rounded shadow-sm border border-amber-100">
                                                        <p class="font-semibold">{{ $product['nom'] }}</p>
                                                        <div class="flex justify-between text-sm mt-1">
                                                            <span>{{ $product['quantite'] }} x {{ number_format($product['prix'], 2) }} €</span>
                                                            <span class="font-medium">{{ number_format($product['prix'] * $product['quantite'], 2) }} €</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des filtres
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Mise à jour des styles de bouton
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('bg-amber-600', 'text-white');
                    btn.classList.add('bg-amber-100', 'text-amber-800');
                });
                this.classList.remove('bg-amber-100', 'text-amber-800');
                this.classList.add('bg-amber-600', 'text-white');
                
                // Filtrage des lignes
                const filter = this.getAttribute('data-filter');
                document.querySelectorAll('.order-row').forEach(row => {
                    const status = row.getAttribute('data-status');
                    const detailsRow = document.getElementById('details-' + row.querySelector('.details-btn').getAttribute('data-order-id'));
                    
                    if (filter === 'all' || status === filter) {
                        row.classList.remove('hidden');
                        if (detailsRow && !detailsRow.classList.contains('hidden')) {
                            detailsRow.classList.remove('hidden');
                        }
                    } else {
                        row.classList.add('hidden');
                        if (detailsRow) {
                            detailsRow.classList.add('hidden');
                        }
                    }
                });
            });
        });
        
        // Affichage/masquage des détails
        document.querySelectorAll('.details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                const detailsRow = document.getElementById('details-' + orderId);
                detailsRow.classList.toggle('hidden');
            });
        });
    });
</script>
@endpush
</x-admin-layout>
