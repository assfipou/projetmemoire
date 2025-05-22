

    <div class="container my-4">
        <h1 class="text-center text-white">Inscription</h1>
        <p class="text-center text-white">Rejoignez-nous pour explorer les merveilles de la chimie !</p>
    </div>

    
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<!-- Prenom-->
<div>
    <x-input-label for="prenom" :value="__('Prenom')" class="text-blue-900"/>
    <x-text-input id="prenom" class="block mt-1 w-full " type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
    <x-input-error :messages="$errors->get('prenom')" class="mt-2"class="mt-2 text-blue-300" />
</div>

        <!-- Name -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" class="text-blue-900"/>
            <x-text-input id="nom" class="block mt-1 w-full text-blue-900 " type="text" name="nom" :value="old('nom')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2"class="mt-2 text-blue-300" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- adresse -->
        <div>
            <x-input-label for="adresse" :value="__('Adresse')" class="text-blue-200"/>
            <x-text-input id="adresse" class="block mt-1 w-full " type="text" name="adresse" :value="old('adresse')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2"class="mt-2 text-blue-300" />
        </div>
        
 <!-- dateNaissance -->
 <div>
    <x-input-label for="dateNaissance" :value="__('dateNaissance')" class="text-blue-200"/>
    <x-text-input id="dateNaissance" class="block mt-1 w-full " type="text" name="dateNaissance" :value="old('dateNaissance')" required autofocus autocomplete="name" />
    <x-input-error :messages="$errors->get('dateNaissance')" class="mt-2"class="mt-2 text-blue-300" />
</div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('deja inscrit ?connectez-vous') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __("S'inscrire") }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

