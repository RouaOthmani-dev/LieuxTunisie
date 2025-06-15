<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Créer un compte</h2>

        @php
            // Fonction helper pour gérer la classe des inputs selon la présence d'erreurs
            function inputClass($errors, $field) {
                $base = "block mt-1 w-full rounded-md px-3 py-2 shadow-sm border focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400";
                return $errors->has($field) ? $base . " border-red-500" : $base . " border-gray-300";
            }
        @endphp

        <!-- Nom complet -->
        <div>
            <label for="name" class="block text-gray-800 font-semibold mb-2">Nom complet <span class="text-red-500">*</span></label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="{{ inputClass($errors, 'name') }}">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Adresse e-mail -->
        <div class="mt-4">
            <label for="email" class="block text-gray-800 font-semibold mb-2">Adresse e-mail <span class="text-red-500">*</span></label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="{{ inputClass($errors, 'email') }}">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <label for="password" class="block text-gray-800 font-semibold mb-2">Mot de passe <span class="text-red-500">*</span></label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="{{ inputClass($errors, 'password') }}">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-gray-800 font-semibold mb-2">Confirmer le mot de passe <span class="text-red-500">*</span></label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="{{ inputClass($errors, 'password_confirmation') }}">
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-blue-600">
                Déjà inscrit ? Connectez-vous
            </a>

            <button type="submit" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:ring-2 focus:ring-blue-500">
                Créer un compte
            </button>
        </div>
    </form>
</x-guest-layout>
