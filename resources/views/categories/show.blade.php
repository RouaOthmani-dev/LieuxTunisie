{{-- Étend le layout principal --}}
@extends('layouts.app')

{{-- Titre dynamique basé sur la catégorie --}}
@section('title', 'Découvrir ' . $categorie->nom)

{{-- Contenu principal --}}
@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    }
    .category-container {
        max-width: 1100px;
        margin: 40px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px #b3c2d6b0;
        padding: 32px 28px;
        position: relative;
        overflow: hidden;
    }
    .category-title {
        font-size: 2.5em;
        color: #216583;
        margin-bottom: .3em;
        text-align: center;
        text-shadow: 1px 1px 3px #fff;
    }
    .lieux-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .lieu-card {
        background: #f3f9fd;
        border-radius: 12px;
        box-shadow: 0 2px 8px #b3c2d640;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 300px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        opacity: 0;
        animation: fadeTranslateUp 0.8s ease forwards;
    }
    .lieu-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
    }
    .lieu-card img:hover {
        transform: scale(1.05);
        filter: brightness(1.1);
    }
    .lieu-card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .lieu-card-title {
        color: #216583;
        font-size: 1.3em;
        text-align: center;
        margin-bottom: 10px;
    }
    .lieu-card-text {
        text-align: center;
        color: #003f63;
        font-size: 1em;
        margin-bottom: 15px;
    }
    .btn-animated {
        background-color: #87CEEB;
        border: none;
        color: #000;
        padding: 8px 20px;
        border-radius: 50px;
        transition: all 0.4s ease;
        font-weight: bold;
    }
    .btn-animated:hover {
        background-color: #D4A373;
        color: #fff;
        box-shadow: 0 8px 15px rgba(212, 163, 115, 0.5);
        transform: translateY(-3px);
    }

    @keyframes fadeTranslateUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .lieux-grid { flex-direction: column; align-items: center; }
        .lieu-card { width: 90%; }
    }
</style>

<div class="category-container">
    <div class="category-title">{{ $categorie->nom }}</div>

    @if($lieux->count() > 0)
        <div class="lieux-grid">
            @foreach($lieux as $index => $lieu)
                <div class="lieu-card" style="animation-delay: {{ 0.15 * $index }}s;">
                    @if($lieu->image)
                        <img src="{{ asset('storage/' . $lieu->image) }}" alt="{{ $lieu->nom }}">
                    @else
                        <img src="{{ asset('images/default-lieu.jpg') }}" alt="Image non disponible">
                    @endif

                    <div class="lieu-card-body">
                        <div class="lieu-card-title">{{ $lieu->nom }}</div>
                        <div class="lieu-card-text">{{ Str::limit($lieu->description, 100) }}</div>
                        <div class="text-center mt-auto">
                            <a href="{{ route('lieux.show', $lieu->id) }}" class="btn btn-animated">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center" style="color: #003f63; font-size: 1.2rem;">Aucun lieu disponible pour cette catégorie.</p>
    @endif
</div>
@endsection
