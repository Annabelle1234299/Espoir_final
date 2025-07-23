@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-amber-800 mb-2">Mes Commandes</h1>
            <p class="text-gray-600">Suivez vos commandes et consultez leur historique</p>
        </div>

        @if($commandes && $commandes->count() > 0)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-amber-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Commande N°</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Stand</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Statut</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($commandes as $commande)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $commande->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $commande->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $commande->stand ? $commande->stand->nom : 'Non spécifié' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ number_format($commande->total, 2) }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($commande->status)
                                            @case('en_attente')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                                @break
                                            @case('traite')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    En traitement
                                                </span>
                                                @break
                                            @case('expedie')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    Expédié
                                                </span>
                                                @break
                                            @case('livre')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Livré
                                                </span>
                                                @break
                                            @case('annule')
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Annulé
                                                </span>
                                                @break
                                            @default
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $commande->status }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('public.orders.show', $commande->id) }}" class="text-amber-600 hover:text-amber-900">
                                            Détails
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Vous n'avez pas encore de commandes</h2>
                <p class="text-gray-600 mb-4">Parcourez nos stands pour découvrir nos produits et effectuer votre première commande.</p>
                <a href="{{ # }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring focus:ring-amber-200 disabled:opacity-25 transition">
                    Voir les stands
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
