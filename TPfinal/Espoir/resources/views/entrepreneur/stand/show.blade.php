<x-entrepreneur-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Stand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 pr-4">
                            @if($stand->image)
                                <img src="{{ asset('storage/' . $stand->image) }}" alt="{{ $stand->nom }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4a1 1 0 01-1-1V6.414l2.293 2.293a1 1 0 001.414 0L10 5.414l3.293 3.293a1 1 0 001.414 0L18 5.414V14a1 1 0 01-1 1zM5.5 5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif

                            <div class="mt-4">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-700">Statut:</span>
                                    @if($stand->visible)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Visible
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Masqué
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('entrepreneur.stand.edit') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Modifier mon stand
                                </a>
                            </div>
                        </div>

                        <div class="md:w-2/3 mt-6 md:mt-0 md:pl-6">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $stand->nom }}</h3>
                            
                            <div class="mt-4">
                                <h4 class="text-md font-medium text-gray-700">Emplacement</h4>
                                <p class="mt-1 text-gray-600">{{ $stand->emplacement }}</p>
                            </div>
                            
                            <div class="mt-4">
                                <h4 class="text-md font-medium text-gray-700">Description</h4>
                                <p class="mt-1 text-gray-600">{{ $stand->description }}</p>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-md font-medium text-gray-700">Type de produits</h4>
                                    <p class="mt-1 text-gray-600">
                                        @switch($stand->type_produits)
                                            @case('alimentaire')
                                                Produits alimentaires
                                                @break
                                            @case('artisanat')
                                                Artisanat
                                                @break
                                            @case('vetements')
                                                Vêtements
                                                @break
                                            @case('bijoux')
                                                Bijoux
                                                @break
                                            @case('cosmetiques')
                                                Cosmétiques
                                                @break
                                            @case('decoration')
                                                Décoration
                                                @break
                                            @default
                                                Autre
                                        @endswitch
                                    </p>
                                </div>
                                
                                <div>
                                    <h4 class="text-md font-medium text-gray-700">Téléphone</h4>
                                    <p class="mt-1 text-gray-600">{{ $stand->telephone ?? 'Non renseigné' }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h4 class="text-md font-medium text-gray-700">Horaires d'ouverture</h4>
                                <p class="mt-1 text-gray-600">{{ $stand->horaires ?? 'Non renseigné' }}</p>
                            </div>
                            
                            @if($stand->infos_supplementaires)
                                <div class="mt-4">
                                    <h4 class="text-md font-medium text-gray-700">Informations supplémentaires</h4>
                                    <p class="mt-1 text-gray-600">{{ $stand->infos_supplementaires }}</p>
                                </div>
                            @endif

                            <div class="mt-6 border-t pt-4">
                                <div class="flex justify-between items-center">
                                    <h4 class="text-lg font-medium text-gray-800">Statistiques</h4>
                                </div>
                                
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="text-2xl font-bold text-blue-600">{{ $produits_count }}</div>
                                        <div class="text-sm text-gray-500">Produits</div>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="text-2xl font-bold text-green-600">{{ $commandes_count }}</div>
                                        <div class="text-sm text-gray-500">Commandes</div>
                                    </div>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="text-2xl font-bold text-purple-600">{{ $total_ventes }} €</div>
                                        <div class="text-sm text-gray-500">Total des ventes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-entrepreneur-layout>
