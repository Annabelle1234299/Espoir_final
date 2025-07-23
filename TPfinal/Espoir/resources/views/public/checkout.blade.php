@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-amber-800 mb-6">Finaliser votre commande</h1>
        
        @php
            $cart = session()->get('cart', []);
            $total = 0;
            
            // Grouper par stand
            $standProducts = [];
            foreach ($cart as $id => $details) {
                if (!isset($standProducts[$details['stand_id']])) {
                    $standProducts[$details['stand_id']] = [
                        'products' => [],
                        'total' => 0
                    ];
                }
                $itemTotal = $details['prix'] * $details['quantite'];
                $standProducts[$details['stand_id']]['products'][$id] = $details;
                $standProducts[$details['stand_id']]['total'] += $itemTotal;
                $total += $itemTotal;
            }
        @endphp
        
        @if(count($cart) > 0)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-amber-800 mb-4">Récapitulatif de votre commande</h2>
                    
                    @foreach($standProducts as $standId => $standData)
                        <div class="border border-amber-200 rounded-lg p-4 mb-4">
                            <h3 class="font-medium text-lg mb-2">Stand #{{ $standId }}</h3>
                            <div class="space-y-2">
                                @foreach($standData['products'] as $id => $details)
                                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                        <div class="flex items-center">
                                            <span class="text-gray-800">{{ $details['nom'] }}</span>
                                            <span class="text-gray-500 mx-2">×</span>
                                            <span class="text-gray-800">{{ $details['quantite'] }}</span>
                                        </div>
                                        <span class="font-medium">{{ number_format($details['prix'] * $details['quantite'], 2, ',', ' ') }} €</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center font-medium mt-3 pt-2">
                                <span>Sous-total du stand</span>
                                <span>{{ number_format($standData['total'], 2, ',', ' ') }} €</span>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="flex justify-between items-center text-lg font-semibold mt-6 pt-4 border-t-2 border-amber-200">
                        <span>Total à payer</span>
                        <span class="text-xl text-amber-800">{{ number_format($total, 2, ',', ' ') }} €</span>
                    </div>
                </div>
                
                <form action="{{ route('checkout.process') }}" method="POST" class="mt-8">
                    @csrf
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-amber-800 mb-3">Adresse de livraison</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                                <input type="text" name="address" id="address" value="{{ auth()->user()->address ?? old('address') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" required>
                            </div>
                            
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? old('city') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" required>
                            </div>
                            
                            <div>
                                <label for="zip_code" class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                                <input type="text" name="zip_code" id="zip_code" value="{{ auth()->user()->zip_code ?? old('zip_code') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" required>
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone ?? old('phone') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-amber-800 mb-3">Mode de paiement</h3>
                        
                        <div class="bg-amber-50 p-4 rounded-md">
                            <div class="flex items-center">
                                <input id="payment_method_cod" name="payment_method" type="radio" value="cod" checked class="h-4 w-4 border-gray-300 text-amber-600 focus:ring-amber-500">
                                <label for="payment_method_cod" class="ml-3 block text-sm font-medium text-gray-700">
                                    Paiement à la livraison
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 mt-1 ml-7">Pour le moment, seul le paiement à la livraison est disponible.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <a href="{{ # }}" class="md:flex-1 inline-flex justify-center items-center px-6 py-3 border border-amber-600 shadow-sm text-base font-medium rounded-md text-amber-700 bg-white hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Retour au panier
                        </a>
                        
                        <button type="submit" class="md:flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            Confirmer ma commande
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12 text-center">
                <div class="rounded-full bg-amber-100 mx-auto h-24 w-24 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-2xl font-bold text-gray-900">Votre panier est vide</h2>
                <p class="mt-2 text-gray-600">Vous ne pouvez pas passer commande avec un panier vide.</p>
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
