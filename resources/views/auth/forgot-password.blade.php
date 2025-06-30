@extends('layouts.guest')

@push('styles')
<style>
    /*  Fond général en dégradé inspiré des paysages tunisiens */
    body {
        background: linear-gradient(135deg, #D4A373 20%, #87CEEB 80%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Bloc flottant pour le formulaire */
    .form-floating-box {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        padding: 2.5rem;
        max-width: 500px;
        width: 90%;
        margin: 4rem auto;
        animation: floatUp 0.6s ease-out;
    }

    /*  Animation douce */
    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
    <div class="form-floating-box">
        <!--  Titre et instructions -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">Réinitialiser votre mot de passe</h1>
            <p class="mt-2 text-sm text-gray-600">
                Pas de problème ! Entrez votre adresse e-mail et recevez un lien pour choisir un nouveau mot de passe.
            </p>
        </div>

        <!-- Statut de session -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Formulaire -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Adresse e-mail -->
            <div>
                <x-input-label for="email" :value="__('Adresse e-mail')" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="exemple@domaine.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Boutons -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 underline">
                    ← Retour à la connexion
                </a>

                <button type="submit" class="btn btn-primary btn-lg px-5 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
                   <i class="bi bi-send-fill"></i>
                     Envoyer
                 </button>

            </div>
        </form>
    </div>
@endsection
