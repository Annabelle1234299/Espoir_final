<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Entrepreneurs en attente d\'approbation') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            @if($pendingUsers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date d'inscription</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stand</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingUsers as $user)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->email }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    @if($user->stand)
                                        <a href="#" class="text-blue-500 hover:underline" onclick="openStandModal({{ $user->id }}, '{{ $user->stand->nom }}', '{{ $user->stand->description }}', '{{ $user->stand->emplacement }}')">
                                            {{ $user->stand->nom }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Non créé</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">Approuver</button>
                                        </form>
                                        <button 
                                            onclick="openRejectModal({{ $user->id }})" 
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                            Rejeter
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    @if(method_exists($pendingUsers, 'links'))
                        {{ $pendingUsers->links() }}
                    @endif
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 text-lg">Aucun entrepreneur en attente d'approbation</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal de détail du stand -->
    <div id="standModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4" id="standModalTitle">Détails du stand</h3>
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-1">Description</h4>
                    <p id="standModalDescription" class="text-gray-600"></p>
                </div>
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-1">Emplacement</h4>
                    <p id="standModalLocation" class="text-gray-600"></p>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeStandModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Fermer</button>
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
        function openStandModal(userId, nom, description, emplacement) {
            document.getElementById('standModalTitle').textContent = nom;
            document.getElementById('standModalDescription').textContent = description;
            document.getElementById('standModalLocation').textContent = emplacement;
            document.getElementById('standModal').classList.remove('hidden');
        }

        function closeStandModal() {
            document.getElementById('standModal').classList.add('hidden');
        }

        function openRejectModal(userId) {
            document.getElementById('rejectForm').action = `{{ url('/admin/users/') }}/${userId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>
