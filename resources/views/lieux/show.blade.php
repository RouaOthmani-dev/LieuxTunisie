@extends('layouts.app')

@section('title', $lieu->nom)

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .lieu-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(179, 194, 214, 0.5);
        padding: 32px 28px;
        position: relative;
        overflow: hidden;
        animation: fadeTranslateUp 1s ease forwards;
    }

    .lieu-title {
        font-size: 2.5em;
        color: #216583;
        text-align: center;
        margin-bottom: 1em;
        text-shadow: 1px 1px 4px rgba(255,255,255,0.8);
    }

    .lieu-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(179, 194, 214, 0.5);
        margin-bottom: 25px;
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .lieu-image:hover {
        transform: scale(1.04);
        filter: brightness(1.1);
    }

    .lieu-info {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #365f7e;
        margin-bottom: 1em;
        text-align: center;
    }

    #map {
        height: 400px;
        margin-top: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    }

    .btn-cta {
        background-color: #87CEEB;
        color: #003f63;
        padding: 10px 26px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.4s ease;
        box-shadow: 0 8px 15px rgba(135, 206, 235, 0.4);
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
    }

    .btn-cta:hover {
        background-color: #D4A373;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(212, 163, 115, 0.5);
    }

    @keyframes fadeTranslateUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .lieu-title { font-size: 2rem; }
        .lieu-image { height: 250px; }
    }

    @media (max-width: 576px) {
        .lieu-title { font-size: 1.7rem; }
        .btn-cta { padding: 8px 20px; font-size: 0.95rem; }
    }
</style>

<div class="lieu-container">
    <div class="lieu-title">{{ $lieu->nom }}</div>

    @if($lieu->image)
        <img src="{{ asset('storage/' . $lieu->image) }}" alt="{{ $lieu->nom }}" class="lieu-image">
    @else
        <img src="{{ asset('images/default-lieu.jpg') }}" alt="Image non disponible" class="lieu-image">
    @endif

    <div class="lieu-info"><strong>Description :</strong> {{ $lieu->description }}</div>
    <div class="lieu-info"><strong>Région :</strong> {{ $lieu->region }}</div>
    <div class="lieu-info"><strong>Adresse :</strong> {{ $lieu->adresse ?? 'Non spécifiée' }}</div>

    {{-- 🗺️ Carte Leaflet --}}
    @if ($lieu->latitude && $lieu->longitude)
        <div id="map"></div>

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var map = L.map('map').setView([{{ $lieu->latitude }}, {{ $lieu->longitude }}], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([{{ $lieu->latitude }}, {{ $lieu->longitude }}])
                    .addTo(map)
                    .bindPopup("<strong>{{ $lieu->nom }}</strong><br>{{ $lieu->adresse ?? 'Adresse non spécifiée' }}")
                    .openPopup();
            });
        </script>
        @endpush
    @else
        <p class="text-muted text-center mt-3">📍 Coordonnées GPS non disponibles pour ce lieu.</p>
    @endif

    <a href="{{ route('home') }}" class="btn-cta">← Retour à l'accueil</a>
</div>
@endsection
