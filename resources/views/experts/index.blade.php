@extends('layouts.app')

@section('title', 'Expert Cinéma')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .expert-container {
        max-width: 700px;
        margin: 50px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 25px rgba(179, 194, 214, 0.4);
        padding: 36px 32px;
        animation: fadeTranslateUp 1s ease forwards;
        color: #365f7e;
        text-align: center;
    }

    .expert-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #216583;
        margin-bottom: 0.3em;
        text-shadow: 1px 1px 4px rgba(255,255,255,0.8);
        text-transform: uppercase;
    }

    .expert-subtitle {
        font-size: 1.3rem;
        font-style: italic;
        color: #57ba98;
        margin-bottom: 30px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    }

    .expert-photo {
        max-width: 250px;
        border-radius: 50%;
        border: 5px solid #0077B6;
        box-shadow: 0 6px 20px rgba(0, 119, 182, 0.4);
        margin: 0 auto 30px auto;
        display: block;
        animation: zoomIn 1.2s ease forwards;
        transition: transform 0.5s ease, filter 0.5s ease;
        cursor: default;
    }
    .expert-photo:hover {
        transform: scale(1.07) rotate(1deg);
        filter: brightness(1.1);
    }

    .expert-info {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        animation: fadeTranslateUp 1s ease forwards;
        color: #365f7e;
        text-align: left;
    }
    .expert-info strong {
        color: #216583;
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
        margin: 20px 10px 0 10px;
        text-decoration: none;
    }
    .btn-animated:hover {
        background-color: #D4A373;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.6);
    }

    /* Animations */
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

    @keyframes zoomIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .expert-title {
            font-size: 2rem;
        }
        .expert-subtitle {
            font-size: 1.1rem;
        }
        .expert-photo {
            max-width: 180px;
            margin-bottom: 20px;
        }
        .expert-info {
            font-size: 1rem;
            text-align: center;
        }
        .btn-animated {
            padding: 10px 30px;
            margin: 15px 5px 0 5px;
        }
    }
</style>

<div class="expert-container">
    <h1 class="expert-title">{{ $expert->nom }}</h1>
    <h4 class="expert-subtitle">{{ $expert->titre }}</h4>

    @if($expert->photo)
        <img src="{{ asset('storage/' . $expert->photo) }}" alt="{{ $expert->nom }}" class="expert-photo">
    @endif

    <p class="expert-info"><strong>Expérience :</strong> {{ $expert->experience }}</p>
    <p class="expert-info"><strong>Films :</strong> {{ $expert->films }}</p>

    @if($expert->imdb_link)
        <a href="{{ $expert->imdb_link }}" target="_blank" class="btn-animated">Voir la fiche IMDB</a>
    @endif

    <a href="{{ route('home') }}" class="btn-animated">Retour à l'accueil</a>
</div>
@endsection
