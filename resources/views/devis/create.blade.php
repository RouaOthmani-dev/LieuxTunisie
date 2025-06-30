@extends('layouts.app')

@section('title', 'Demande de devis')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .devis-container {
        max-width: 700px;
        margin: 50px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 25px rgba(179, 194, 214, 0.4);
        padding: 36px 32px;
        animation: fadeTranslateUp 1s ease forwards;
        color: #365f7e;
    }

    .devis-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        color: #216583;
        text-shadow: 1px 1px 4px rgba(255, 255, 255, 0.8);
    }

    .alert-success {
        border-radius: 50px;
        background-color: #D4A373;
        color: #fff;
        font-weight: 700;
        padding: 15px 25px;
        margin-bottom: 30px;
        text-align: center;
        animation: fadeTranslateUp 1s ease forwards;
    }

    form label {
        font-weight: 600;
        color: #216583;
        margin-bottom: 8px;
        display: block;
    }

    input.form-control,
    textarea.form-control {
        border-radius: 12px;
        border: 1px solid #b3c2d6;
        padding: 10px 14px;
        font-size: 1rem;
        color: #365f7e;
        transition: border-color 0.3s ease;
    }

    input.form-control:focus,
    textarea.form-control:focus {
        border-color: #87CEEB;
        outline: none;
        box-shadow: 0 0 8px rgba(135, 206, 235, 0.4);
    }

    .btn-animated {
        background-color: #87CEEB;
        border: none;
        color: #003f63;
        font-weight: 700;
        padding: 12px 40px;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(135, 206, 235, 0.5);
        transition: all 0.4s ease;
        cursor: pointer;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-animated:hover {
        background-color: #D4A373;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.6);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .devis-container {
            padding: 28px 20px;
            margin: 30px 15px;
        }
        .devis-title {
            font-size: 2rem;
            margin-bottom: 24px;
        }
        .btn-animated {
            width: 100%;
            padding: 12px 0;
        }
    }

    @keyframes fadeTranslateUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="devis-container animate-fade">
    <h1 class="devis-title">Demande de Devis</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('devis.store') }}">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="telephone">Téléphone :</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="type_projet">Type de projet :</label>
                <input type="text" id="type_projet" name="type_projet" value="{{ old('type_projet') }}" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 mb-3 mb-md-0">
                <label for="nb_jours">Nombre de jours :</label>
                <input type="number" id="nb_jours" name="nb_jours" value="{{ old('nb_jours') }}" min="1" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <label for="lieu_recherche">Lieu recherché :</label>
                <input type="text" id="lieu_recherche" name="lieu_recherche" value="{{ old('lieu_recherche') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="budget">Budget estimé :</label>
                <input type="number" id="budget" name="budget" value="{{ old('budget') }}" min="0" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="message">Message (optionnel) :</label>
            <textarea id="message" name="message" rows="4" class="form-control">{{ old('message') }}</textarea>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="rgpd" id="rjpd" required>
            <lable class="form-check-label" for="rjpd" >
                j'accepte la <a href="{{route('confidentialite')}}">politique de confidentialité. </a>
            <label>
        </div>

        <div class="text-center">
            <button type="submit" class="btn-animated">Envoyer la demande</button>
        </div>
    </form>
</div>
@endsection
