<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord administrateur') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Statistiques des utilisateurs -->
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Utilisateurs</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600">Total</p>
                            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">En attente</p>
                            <p class="text-3xl font-bold">{{ $pendingUsers }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.pending.users') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Voir les utilisateurs en attente
                    </a>
                </div>
                
                <!-- Statistiques des stands -->
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Stands</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600">Total</p>
                            <p class="text-3xl font-bold">{{ $totalStands }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Approuvés</p>
                            <p class="text-3xl font-bold">{{ $approvedStands }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques des commandes -->
                <div class="bg-yellow-50 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Commandes</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-600">Total</p>
                            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">En attente</p>
                            <p class="text-3xl font-bold">{{ $pendingOrders }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.commandes.index') }}" class="mt-4 inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Voir les commandes
                    </a>
                </div>
            </div>

            <!-- Dernières inscriptions -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold mb-4">Dernières inscriptions</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date d'inscription</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUsers as $user)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    @if ($user->role === 'admin')
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">Admin</span>
                                    @elseif ($user->role === 'entrepreneur_approuve')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Approuvé</span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En attente</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    @if ($user->role === 'entrepreneur_en_attente')
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.approve.user', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">Approuver</button>
                                        </form>
                                        <button 
                                            onclick="openRejectModal({{ $user->id }})" 
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                            Rejeter
                                        </button>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dernières commandes -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Dernières commandes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stand</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-200">#{{ $order->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $order->user->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $order->stand->nom }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ number_format($order->total, 2) }} €</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    @if ($order->status === 'en_attente')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">En attente</span>
                                    @elseif ($order->status === 'traite')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Traité</span>
                                    @elseif ($order->status === 'expedie')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Expédié</span>
                                    @elseif ($order->status === 'livre')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Livré</span>
                                    @elseif ($order->status === 'annule')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Annulé</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <a href="{{ route('admin.commandes.show', $order->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs">Détails</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de rejet -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Rejeter cet entrepreneur</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="message_rejet" class="block text-sm font-medium text-gray-700 mb-1">Motif du rejet</label>
                        <textarea name="message_rejet" id="message_rejet" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Annuler</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Confirmer le rejet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(userId) {
            document.getElementById('rejectForm').action = `/admin/reject-user/${userId}`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
