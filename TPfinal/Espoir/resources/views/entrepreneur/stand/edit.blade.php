<x-entrepreneur-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-amber-800 leading-tight font-playfair">
            {{ __('Gérer mon stand') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête avec badge de statut -->
            <div class="bg-gradient-to-r from-amber-50 to-red-50 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-amber-200">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-amber-100 p-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-amber-800">{{ $stand->nom }}</h2>
                                <p class="text-amber-700">{{ __('Emplacement') }}: {{ $stand->emplacement }}</p>
                            </div>
                        </div>
                        <span class="{{ $stand->visible ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }} py-1 px-4 rounded-full text-sm font-medium">
                            {{ $stand->visible ? __('Visible au public') : __('Non visible') }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-amber-100">
                <div class="p-6">
                    <!-- Onglets de navigation -->
                    <div class="border-b border-amber-200 mb-6">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            <li class="mr-2">
                                <a href="#" class="inline-block p-4 border-b-2 border-amber-500 rounded-t-lg text-amber-600 font-semibold">
                                    {{ __('Information du stand') }}
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('entrepreneur.produits.index') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-amber-600 hover:border-amber-300">
                                    {{ __('Gérer mes produits') }}
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="{{ route('entrepreneur.commandes.index') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-amber-600 hover:border-amber-300">
                                    {{ __('Commandes reçues') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form method="POST" action="{{ route('entrepreneur.stand.update', $stand->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="nom" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Nom du stand') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="nom" id="nom" value="{{ old('nom', $stand->nom) }}" required
                                        class="w-full pl-10 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                                </div>
                                @error('nom')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="emplacement" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Emplacement') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="emplacement" id="emplacement" value="{{ old('emplacement', $stand->emplacement) }}" required
                                        class="w-full pl-10 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                                </div>
                                @error('emplacement')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Description de votre stand') }}</label>
                            <div class="relative">
                                <textarea name="description" id="description" rows="4" required
                                    class="w-full rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">{{ old('description', $stand->description) }}</textarea>
                                <p class="text-xs text-amber-600 mt-1">{{ __('Décrivez votre stand, vos spécialités et ce qui vous rend unique.') }}</p>
                            </div>
                            @error('description')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="telephone" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Téléphone') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $stand->telephone) }}" placeholder="06 XX XX XX XX"
                                        class="w-full pl-10 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                                </div>
                                <p class="text-xs text-amber-600 mt-1">{{ __('Comment les clients peuvent vous contacter') }}</p>
                                @error('telephone')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="horaires" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Horaires d\'ouverture') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="horaires" id="horaires" value="{{ old('horaires', $stand->horaires) }}" placeholder="10h-19h tous les jours"
                                        class="w-full pl-10 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                                </div>
                                <p class="text-xs text-amber-600 mt-1">{{ __('Pendant quelles heures serez-vous présent sur votre stand ?') }}</p>
                                @error('horaires')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Image de votre stand') }}</label>
                            <div class="bg-amber-50 p-4 rounded-lg border border-amber-200">
                                @if($stand->image)
                                    <div class="mb-4 flex items-center">
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $stand->image) }}" alt="Image du stand" class="w-40 h-40 object-cover rounded-lg shadow-md border-2 border-amber-300">
                                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                                <span class="text-white text-sm font-medium">Image actuelle</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm text-amber-800 font-medium">{{ __('Image actuelle') }}</p>
                                            <p class="text-xs text-amber-600">{{ __('Téléchargez une nouvelle image pour la remplacer') }}</p>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="relative border-2 border-dashed border-amber-300 rounded-lg p-6 flex flex-col items-center justify-center bg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-amber-800 text-sm font-medium mb-1">{{ __('Glissez votre image ici ou cliquez pour parcourir') }}</p>
                                    <p class="text-amber-600 text-xs mb-4">{{ __('JPG, PNG ou GIF, max 2MB') }}</p>
                                    
                                    <input type="file" name="image" id="image"
                                        class="block w-full text-sm text-amber-700
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-gradient-to-r file:from-amber-500 file:to-red-500
                                            file:text-white
                                            hover:file:from-amber-600 hover:file:to-red-600">
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type_produits" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Type de produits') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <select name="type_produits" id="type_produits" required
                                    class="w-full pl-10 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 appearance-none bg-white">
                                    <option value="">{{ __('Sélectionner...') }}</option>
                                    <option value="alimentaire" {{ (old('type_produits', $stand->type_produits) == 'alimentaire') ? 'selected' : '' }}>{{ __('Alimentaire') }}</option>
                                    <option value="boisson" {{ (old('type_produits', $stand->type_produits) == 'boisson') ? 'selected' : '' }}>{{ __('Boissons') }}</option>
                                    <option value="artisanat" {{ (old('type_produits', $stand->type_produits) == 'artisanat') ? 'selected' : '' }}>{{ __('Artisanat') }}</option>
                                    <option value="vetements" {{ (old('type_produits', $stand->type_produits) == 'vetements') ? 'selected' : '' }}>{{ __('Vêtements') }}</option>
                                    <option value="bijoux" {{ (old('type_produits', $stand->type_produits) == 'bijoux') ? 'selected' : '' }}>{{ __('Bijoux') }}</option>
                                    <option value="cosmetiques" {{ (old('type_produits', $stand->type_produits) == 'cosmetiques') ? 'selected' : '' }}>{{ __('Cosmétiques') }}</option>
                                    <option value="decoration" {{ (old('type_produits', $stand->type_produits) == 'decoration') ? 'selected' : '' }}>{{ __('Décoration') }}</option>
                                    <option value="autre" {{ (old('type_produits', $stand->type_produits) == 'autre') ? 'selected' : '' }}>{{ __('Autre') }}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-amber-600 mt-1">{{ __('Catégorie principale de vos produits') }}</p>
                            @error('type_produits')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="infos_supplementaires" class="block text-sm font-semibold text-amber-800 mb-2">{{ __('Informations supplémentaires') }}</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <textarea name="infos_supplementaires" id="infos_supplementaires" rows="4"
                                    class="w-full pl-10 pt-2 rounded-md shadow-sm border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50"
                                    placeholder="Décrivez vos promotions, événements ou toute information utile pour les visiteurs...">{{ old('infos_supplementaires', $stand->infos_supplementaires) }}</textarea>
                            </div>
                            <p class="text-xs text-amber-600 mt-1">{{ __('Ces informations seront visibles sur la page de votre stand (promotions, événements spéciaux, etc.)') }}</p>
                        </div>

                        <div class="mb-8 bg-amber-50 p-4 rounded-lg border border-amber-200">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="visible" name="visible" type="checkbox" {{ old('visible', $stand->visible) ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-amber-300 text-amber-600 shadow-sm focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                                </div>
                                <div class="ml-3">
                                    <label for="visible" class="font-medium text-amber-800 text-base">{{ __('Rendre mon stand visible au public') }}</label>
                                    <p class="text-amber-600 text-sm mt-1">{{ __('Activez cette option pour que les visiteurs puissent voir votre stand et commander vos produits') }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4 border-t border-amber-200 pt-4">
                                <div class="flex items-center text-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm">{{ __('Vous pouvez modifier cette option à tout moment') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('entrepreneur.dashboard') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-100 border border-transparent rounded-full font-medium text-sm text-amber-700 hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-300 transition ease-in-out duration-150 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                                </svg>
                                {{ __('Retour') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 border border-transparent rounded-full font-semibold text-sm text-white shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition ease-in-out duration-300 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Enregistrer les modifications') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-entrepreneur-layout>
