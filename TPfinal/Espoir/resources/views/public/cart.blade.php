@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-amber-800 mb-6">Votre panier</h1>
            
            @php
                $cart = session()->get('cart', []);
                $total = 0;
            @endphp
            
            @if(count($cart) > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-amber-200">
                                        <thead class="bg-amber-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                                    Produit
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                                    Prix unitaire
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                                    Quantité
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-amber-800 uppercase tracking-wider">
                                                    Total
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-amber-100">
                                            @foreach($cart as $id => $details)
                                                @php
                                                    $itemTotal = $details['prix'] * $details['quantite'];
                                                    $total += $itemTotal;
                                                @endphp
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-16 w-16 bg-amber-50 rounded overflow-hidden">
                                                                @if(isset($details['image']) && $details['image'])
                                                                    <img src="{{ Storage::url($details['image']) }}" alt="{{ $details['nom'] }}" class="h-full w-full object-cover">
                                                                @else
                                                                    <div class="h-full w-full flex items-center justify-center bg-amber-100">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-base font-medium text-gray-900">
                                                                    {{ $details['nom'] }}
                                                                </div>
                                                                <div class="text-sm text-gray-500">
                                                                    Stand #{{ $details['stand_id'] }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-base text-gray-900">{{ number_format($details['prix'], 2, ',', ' ') }} €</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <form action="{{ # }}" method="POST" class="flex items-center">
                                                            @csrf
                                                            <input type="hidden" name="produit_id" value="{{ $id }}">
                                                            <select name="quantite" class="block w-20 pl-3 pr-10 py-2 text-base border-amber-300 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm rounded-md" onchange="this.form.submit()">
                                                                @for ($i = 1; $i <= 10; $i++)
                                                                    <option value="{{ $i }}" {{ $details['quantite'] == $i ? 'selected' : '' }}>
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-900">
                                                        {{ number_format($itemTotal, 2, ',', ' ') }} €
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <form action="{{ # }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="produit_id" value="{{ $id }}">
                                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 border-t border-amber-200 pt-8">
                        <div class="flex justify-between items-center mb-6">
                            <div class="text-2xl font-bold text-amber-800">Total</div>
                            <div class="text-2xl font-bold text-amber-800">{{ number_format($total, 2, ',', ' ') }} €</div>
                        </div>
                        
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('public.produits') }}" class="md:flex-1 inline-flex justify-center items-center px-6 py-3 border border-amber-600 shadow-sm text-base font-medium rounded-md text-amber-700 bg-white hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Continuer les achats
                            </a>
                            
                            @auth
                                <a href="{{ route('checkout') }}" class="md:flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                    Valider ma commande
                                </a>
                            @else
                                <!-- Lien login supprimé --> class="md:flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                    Se connecter pour commander
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12 text-center">
                    <div class="rounded-full bg-amber-100 mx-auto h-24 w-24 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="mt-6 text-2xl font-bold text-gray-900">Votre panier est vide</h2>
                    <p class="mt-2 text-gray-600">Parcourez notre catalogue pour trouver des produits africains authentiques.</p>
                    <div class="mt-8">
                        <a href="{{ route('public.produits') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Découvrir nos produits
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
