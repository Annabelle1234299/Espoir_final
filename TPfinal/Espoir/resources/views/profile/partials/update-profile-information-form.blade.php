<section>
    <header>
        <h2 class="text-lg font-medium text-amber-800">
            {{ __('Mes informations personnelles') }}
        </h2>

        <p class="mt-1 text-sm text-amber-700">
            {{ __('Modifiez vos informations personnelles et votre adresse email.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informations de base -->
            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Nom complet')" class="text-amber-700" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-amber-300 focus:border-amber-500 focus:ring-amber-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Adresse email')" class="text-amber-700" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-amber-300 focus:border-amber-500 focus:ring-amber-500" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                
                <div>
                    <x-input-label for="phone" :value="__('Téléphone')" class="text-amber-700" />
                    <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full border-amber-300 focus:border-amber-500 focus:ring-amber-500" :value="old('phone', $user->phone ?? '')" placeholder="+33 6 XX XX XX XX" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>
            </div>

            <!-- Préférences et photo -->
            <div class="space-y-4">
                <div>
                    <x-input-label for="photo_profil" :value="__('Photo de profil')" class="text-amber-700" />
                    <div class="mt-2 flex items-center gap-6">
                        @if($user->photo_profil)
                            <div class="relative h-20 w-20 rounded-full overflow-hidden border-2 border-amber-400">
                                <img src="{{ Storage::url($user->photo_profil) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="h-20 w-20 rounded-full bg-amber-100 flex items-center justify-center text-amber-500 border-2 border-amber-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <label class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-800 focus:outline-none focus:border-amber-800 focus:ring focus:ring-amber-200 transition cursor-pointer">
                                <span>{{ __('Choisir une image') }}</span>
                                <input id="photo_profil" name="photo_profil" type="file" class="hidden" accept="image/*">
                            </label>
                            <p class="text-sm text-gray-500 mt-1">JPEG, PNG, GIF (max 2Mo)</p>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('photo_profil')" />
                </div>
                
                <div>
                    <x-input-label for="address" :value="__('Adresse postale')" class="text-amber-700" />
                    <textarea id="address" name="address" class="mt-1 block w-full rounded-md border-amber-300 focus:border-amber-500 focus:ring-amber-500" rows="3">{{ old('address', $user->address ?? '') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div>
                    <x-input-label for="preferences" :value="__('Préférences culinaires')" class="text-amber-700" />
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="preferences[]" value="vegetarien" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500" {{ isset($user->preferences) && in_array('vegetarien', json_decode($user->preferences)) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ __('Végétarien') }}</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="preferences[]" value="vegan" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500" {{ isset($user->preferences) && in_array('vegan', json_decode($user->preferences)) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ __('Vegan') }}</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="preferences[]" value="sans_gluten" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500" {{ isset($user->preferences) && in_array('sans_gluten', json_decode($user->preferences)) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ __('Sans gluten') }}</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="preferences[]" value="local" class="rounded border-amber-300 text-amber-600 focus:ring-amber-500" {{ isset($user->preferences) && in_array('local', json_decode($user->preferences)) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ __('Produits locaux') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4">
                <p class="text-sm text-amber-700">
                    {{ __('Votre adresse email n\'est pas vérifiée.') }}

                    <button form="send-verification" class="underline text-sm text-amber-600 hover:text-amber-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                    </p>
                @endif
            </div>
        @endif
        <div class="mt-6 flex items-center gap-4">
            <button type="submit" class="bg-gradient-to-r from-amber-500 to-red-500 hover:from-amber-600 hover:to-red-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                {{ __('Enregistrer les modifications') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-amber-700 bg-amber-100 px-3 py-1 rounded-full"
                >{{ __('Modifications enregistrées!') }}</p>
            @endif
        </div>
    </form>
</section>
