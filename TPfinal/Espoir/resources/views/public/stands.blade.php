@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-amber-800 mb-2">Nos exposants</h1>
                <p class="text-gray-600">Découvrez tous les stands du Eat&Drink Festival, proposant des produits africains authentiques.</p>
            </div>

            @if($stands->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($stands as $stand)
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-amber-100 hover:shadow-xl transition-shadow duration-300">
                            <div class="h-48 bg-amber-50 relative overflow-hidden">
                                @if($stand->image)
                                    <img src="{{ Storage::url($stand->image) }}" alt="{{ $stand->nom }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full bg-gradient-to-r from-amber-100 to-amber-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/60 to-transparent p-4">
                                    <h2 class="text-xl font-bold text-white truncate">{{ $stand->nom }}</h2>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex items-center mb-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 mr-2">
                                        {{ $stand->status == 'approuve' ? 'Approuvé' : $stand->status }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $stand->emplacement ?: 'Emplacement non assigné' }}</span>
                                </div>
                                
                                <p class="text-gray-700 line-clamp-2 h-12 mb-4">{{ $stand->description }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-amber-200 flex items-center justify-center">
                                            <span class="font-medium text-amber-800">{{ strtoupper(substr($stand->user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-2">
                                            <p class="text-sm font-medium text-gray-900">{{ $stand->user->name }}</p>
                                        </div>
                                    </div>
                                    <a href="#" class="inline-flex items-center px-3 py-1.5 border border-amber-600 text-sm font-medium rounded-md text-amber-700 bg-white hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                        Découvrir
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $stands->links() }}
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun exposant disponible</h3>
                    <p class="mt-1 text-sm text-gray-500">Les exposants seront bientôt disponibles, restez à l'écoute !</p>
                </div>
            @endif
        </div>
    </div>
@endsection
