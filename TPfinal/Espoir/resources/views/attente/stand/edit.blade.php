@extends('layouts.attente')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Les informations de votre stand sont importantes pour le processus d'approbation. Veuillez remplir ce formulaire avec des détails précis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ isset($stand) ? route('attente.stand.update', $stand->id) : route('attente.stand.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($stand))
                            @method('PUT')
                        @endif

                        <div class="mb-6">
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du stand</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $stand->nom ?? '') }}" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="emplacement" class="block text-sm font-medium text-gray-700 mb-1">Emplacement souhaité</label>
                            <input type="text" name="emplacement" id="emplacement" value="{{ old('emplacement', $stand->emplacement ?? '') }}" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p class="text-sm text-gray-500 mt-1">Indiquez l'emplacement préféré pour votre stand (sera confirmé à l'approbation)</p>
                            @error('emplacement')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="6" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $stand->description ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Décrivez votre activité, vos produits et votre expertise. Cette description aidera les administrateurs à évaluer votre demande.</p>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image du stand</label>
                            @if(isset($stand) && $stand->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $stand->image) }}" alt="{{ $stand->nom }}" class="h-32 object-cover rounded-md">
                                    <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" name="image" id="image" 
                                class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-sm text-gray-500 mt-1">Format recommandé : JPG, PNG ou GIF, max 2 Mo. Utilisez une image représentative de votre stand.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="type_produits" class="block text-sm font-medium text-gray-700 mb-1">Type de produits</label>
                            <select name="type_produits" id="type_produits" required
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sélectionner...</option>
                                <option value="alimentaire" {{ (old('type_produits', $stand->type_produits ?? '') == 'alimentaire') ? 'selected' : '' }}>Produits alimentaires</option>
                                <option value="artisanat" {{ (old('type_produits', $stand->type_produits ?? '') == 'artisanat') ? 'selected' : '' }}>Artisanat</option>
                                <option value="vetements" {{ (old('type_produits', $stand->type_produits ?? '') == 'vetements') ? 'selected' : '' }}>Vêtements</option>
                                <option value="bijoux" {{ (old('type_produits', $stand->type_produits ?? '') == 'bijoux') ? 'selected' : '' }}>Bijoux</option>
                                <option value="cosmetiques" {{ (old('type_produits', $stand->type_produits ?? '') == 'cosmetiques') ? 'selected' : '' }}>Cosmétiques</option>
                                <option value="decoration" {{ (old('type_produits', $stand->type_produits ?? '') == 'decoration') ? 'selected' : '' }}>Décoration</option>
                                <option value="autre" {{ (old('type_produits', $stand->type_produits ?? '') == 'autre') ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('type_produits')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="infos_supplementaires" class="block text-sm font-medium text-gray-700 mb-1">Informations supplémentaires</label>
                            <textarea name="infos_supplementaires" id="infos_supplementaires" rows="4"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('infos_supplementaires', $stand->infos_supplementaires ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Ajoutez toute information complémentaire qui pourrait être utile (besoins spécifiques, expérience précédente, etc.)</p>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('attente.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray transition ease-in-out duration-150 mr-3">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150">
                                {{ isset($stand) ? 'Mettre à jour' : 'Créer mon stand' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
