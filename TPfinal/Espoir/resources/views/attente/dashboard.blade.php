@extends('layouts.attente')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-amber-700">
                                    Votre compte entrepreneur est en attente d'approbation. Un administrateur examinera votre demande dans les plus brefs délais.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations du stand -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-amber-100">
                            <h3 class="text-lg font-semibold mb-4 text-amber-800 border-b border-amber-200 pb-2">Votre stand</h3>
                            @if($stand)
                                <div class="mb-4">
                                    <p class="text-amber-600 text-sm font-medium">Nom du stand</p>
                                    <p class="text-xl font-semibold">{{ $stand->nom }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-amber-600 text-sm font-medium">Emplacement</p>
                                    <p>{{ $stand->emplacement }}</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-amber-600 text-sm font-medium">Description</p>
                                    <p>{{ $stand->description }}</p>
                                </div>
                                <div>
                                    <p class="text-amber-600 text-sm font-medium">Date de la demande</p>
                                    <p>{{ $stand->created_at->format('d/m/Y H:i') }}</p>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('attente.stand.edit') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white rounded-full shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        {{ __('Modifier les informations') }}
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500">Vous n'avez pas encore créé de stand. Complétez votre profil pour accélérer le processus d'approbation.</p>
                                <div class="mt-4">
                                    <a href="{{ route('attente.stand.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white rounded-full shadow-md hover:shadow-lg transition duration-300 transform hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        {{ __('Créer mon stand') }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Informations du compte -->
                        <div class="bg-white p-6 rounded-lg shadow-md border border-amber-100">
                            <h3 class="text-lg font-semibold mb-4 text-amber-800 border-b border-amber-200 pb-2">Statut de votre compte</h3>
                                                        @if($stand)
                                @if($stand->status === 'en_attente')
                                <div class="flex items-center mb-2 text-amber-800">
                                    <svg class="h-8 w-8 text-yellow-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold">En attente d'approbation</h4>
                                        <p class="text-sm text-amber-600">Un administrateur examinera votre demande prochainement</p>
                                        <p class="text-xs text-amber-500 mt-1">Délai moyen d'attente: 24-48h</p>
                                    </div>
                                </div>
                                @elseif($stand->status === 'approuve')
                                <div class="flex items-center mb-2 text-green-800">
                                    <svg class="h-8 w-8 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold">Stand approuvé !</h4>
                                        <p class="text-sm text-green-600">Votre stand a été approuvé ! Vous pouvez maintenant ajouter des produits.</p>
                                        <p class="text-xs text-green-500 mt-1">Date d'approbation: {{ $stand->updated_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @elseif($stand->status === 'rejete')
                                <div class="flex items-center mb-2 text-red-800">
                                    <svg class="h-8 w-8 text-red-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold">Stand refusé</h4>
                                        <p class="text-sm text-red-600">Votre stand n'a pas été approuvé.</p>
                                    </div>
                                </div>
                                <div class="p-3 bg-red-50 rounded mt-2 text-red-700 text-sm border border-red-200 mb-4">
                                    <p class="font-medium">Motif du refus:</p>
                                    <p>{{ $stand->message_rejet ?? 'Aucune raison spécifiée. Veuillez nous contacter pour plus d\'informations.' }}</p>
                                </div>
                                @endif
                            @else
                                <div class="flex items-center mb-2 text-gray-800">
                                    <svg class="h-8 w-8 text-gray-500 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold">En attente de création de stand</h4>
                                        <p class="text-sm text-gray-600">Vous devez créer un stand pour pouvoir participer au festival</p>
                                    </div>
                                </div>
                            @endif

                            @if(!$stand)
                                <div class="bg-blue-50 p-4 rounded-lg mb-4 border-l-4 border-blue-400">
                                    <h4 class="font-medium mb-2 text-blue-800">Prochaines étapes</h4>
                                    <ol class="list-decimal list-inside space-y-2 text-sm text-blue-700 mb-4 pl-2">
                                        <li>Créez votre stand en fournissant les informations requises</li>
                                        <li>Soumettez votre demande pour examen par l'équipe d'administration</li>
                                        <li>Recevez une notification par email sur la décision</li>
                                    </ol>
                                </div>
                            @elseif($stand->status === 'en_attente')
                                <div class="bg-amber-50 p-4 rounded-lg mb-4 border-l-4 border-amber-400">
                                    <h4 class="font-medium mb-2 text-amber-800">Que se passe-t-il ensuite ?</h4>
                                    <ol class="list-decimal list-inside space-y-2 text-sm text-amber-700 mb-4 pl-2">
                                        <li>Un administrateur examine votre demande</li>
                                        <li>Vous recevrez un email avec la décision</li>
                                        <li>En cas d'approbation, vous pourrez accéder à toutes les fonctionnalités</li>
                                        <li>En cas de refus, vous pourrez modifier votre demande et soumettre à nouveau</li>
                                    </ol>
                                </div>
                            @elseif($stand->status === 'approuve')
                                <div class="bg-green-50 p-4 rounded-lg mb-4 border-l-4 border-green-400">
                                    <h4 class="font-medium mb-2 text-green-800">Félicitations ! Prochaines étapes</h4>
                                    <ol class="list-decimal list-inside space-y-2 text-sm text-green-700 mb-4 pl-2">
                                        <li>Ajoutez vos produits au catalogue</li>
                                        <li>Personnalisez la présentation de votre stand</li>
                                        <li>Commencez à recevoir des commandes des clients</li>
                                        <li>Gérez votre inventaire et préparez-vous pour le festival</li>
                                    </ol>
                                </div>
                            @elseif($stand->status === 'rejete')
                                <div class="bg-red-50 p-4 rounded-lg mb-4 border-l-4 border-red-400">
                                    <h4 class="font-medium mb-2 text-red-800">Comment procéder après le refus</h4>
                                    <ol class="list-decimal list-inside space-y-2 text-sm text-red-700 mb-4 pl-2">
                                        <li>Révisez les informations de votre stand en fonction du motif de refus</li>
                                        <li>Mettez à jour les détails et améliorez la description</li>
                                        <li>Soumettez à nouveau votre demande modifiée</li>
                                        <li>Contactez l'administrateur si vous avez besoin d'aide supplémentaire</li>
                                    </ol>
                                </div>
                            @endif

                            <div class="mt-6">
                                <p class="text-sm text-amber-700 mb-2">Pour toute question ou pour accélérer votre demande :</p>
                                <a href="mailto:support@espoir.com" class="text-red-500 hover:text-amber-700 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Contactez-nous par email
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Étapes suivantes -->
                    <div class="mt-8 bg-white p-6 rounded-lg shadow-md border border-amber-100">
                        @if(!$stand || $stand->status === 'en_attente')
                            <h3 class="text-lg font-semibold mb-4 text-amber-800 border-b border-amber-200 pb-2">Préparez votre boutique</h3>
                            <p class="mb-6 text-amber-700">En attendant l'approbation de votre compte, vous pouvez préparer les informations suivantes :</p>
                        @elseif($stand->status === 'approuve')
                            <h3 class="text-lg font-semibold mb-4 text-green-800 border-b border-green-200 pb-2">Gérez votre boutique</h3>
                            <p class="mb-6 text-green-700">Votre stand est approuvé ! Voici les actions recommandées :</p>
                        @elseif($stand->status === 'rejete')
                            <h3 class="text-lg font-semibold mb-4 text-red-800 border-b border-red-200 pb-2">Améliorez votre demande</h3>
                            <p class="mb-6 text-red-700">Pour augmenter vos chances d'approbation lors d'une nouvelle soumission :</p>
                        @endif
                        
                        <div class="space-y-4">
                            @if(!$stand || $stand->status === 'en_attente')
                                <div class="flex items-center">
                                    <div class="bg-amber-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-amber-800">Photos et descriptions de vos produits</h4>
                                        <p class="text-sm text-amber-600">Préparez des photos de qualité et des descriptions détaillées</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-amber-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-amber-800">Tarification de vos produits</h4>
                                        <p class="text-sm text-amber-600">Déterminez les prix et quantités disponibles</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-amber-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-amber-800">Planning et organisation</h4>
                                        <p class="text-sm text-amber-600">Planifiez vos horaires de disponibilité et votre logistique</p>
                                    </div>
                                </div>
                            @elseif($stand->status === 'approuve')
                                <div class="flex items-center">
                                    <div class="bg-green-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-green-800">Ajoutez vos produits</h4>
                                        <p class="text-sm text-green-600">Créez votre catalogue de produits pour le festival</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-green-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-green-800">Personnalisez votre stand</h4>
                                        <p class="text-sm text-green-600">Ajoutez des images et une description attractive de votre stand</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-green-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-green-800">Gérez vos commandes</h4>
                                        <p class="text-sm text-green-600">Préparez-vous à recevoir et traiter des commandes</p>
                                    </div>
                                </div>
                            @elseif($stand->status === 'rejete')
                                <div class="flex items-center">
                                    <div class="bg-red-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-red-800">Révisez la description de votre stand</h4>
                                        <p class="text-sm text-red-600">Ajoutez plus de détails et clarifiez votre offre</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-red-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-red-800">Améliorez vos visuels</h4>
                                        <p class="text-sm text-red-600">Ajoutez des photos de meilleure qualité et plus représentatives</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="bg-red-100 rounded-full p-3 mr-3 shadow-sm">
                                        <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-red-800">Soumettez à nouveau</h4>
                                        <p class="text-sm text-red-600">Une fois les modifications apportées, n'oubliez pas de soumettre à nouveau</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($stand && $stand->status !== 'rejete')
                                <div class="mt-6 border-t border-gray-100 pt-4">
                                    <p class="text-sm font-medium mb-2 {{ $stand && $stand->status === 'approuve' ? 'text-green-700' : 'text-amber-700' }}">Avez-vous besoin d'aide ?</p>
                                    <a href="#" class="inline-flex items-center text-sm {{ $stand && $stand->status === 'approuve' ? 'text-green-600 hover:text-green-800' : 'text-amber-600 hover:text-amber-800' }} hover:underline">
                                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Consulter notre guide d'aide en ligne
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
