
@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 70vh;">
        <div class="col-md-6 bg-white p-4 rounded shadow" style="background: rgba(255, 255, 255, 0.9);">

            <!-- Statut de la session -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            <h2 class="text-center mb-4" style="color: rgb(16, 150, 227); font-weight: 600;">Connexion </h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Adresse Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Se souvenir de moi -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Se souvenir de moi
                    </label>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

   