@extends('layouts.guest')

@section('title', 'Inscription')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #D4A373 20%, #87CEEB 80%);
        min-height: 100vh;
    }

    .card-register {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        padding: 30px;
    }

    .form-floating > .form-control, 
    .form-floating > .form-select {
        border-radius: 10px;
    }
</style>
@endpush

@section('content')
    <section class="py-5">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card-register col-md-8 col-lg-6">
                <h2 class="text-center mb-4">Créer un compte</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder="Nom" value="{{ old('name') }}" required autofocus>
                        <label for="name">Nom</label>
                        @error('name')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="Adresse E-mail" value="{{ old('email') }}" required>
                        <label for="email">Adresse E-mail</label>
                        @error('email')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Mot de passe" required>
                        <label for="password">Mot de passe</label>
                        @error('password')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="rgpd" id="rjpd" required>
                        <lable class="form-check-label" for="rjpd" >
                            j'accepte la <a href="{{route('confidentialite')}}">politique de confidentialité. </a>
                        <label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill shadow-sm">S'inscrire</button>
                </form>
            </div>
        </div>
    </section>
@endsection
