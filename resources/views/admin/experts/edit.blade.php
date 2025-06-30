@extends('layouts.app')

@section('title', 'Modifier Expert')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .expert-container {
        background: rgba(255, 255, 255, 0.95);
        max-width: 700px;
        margin: 50px auto;
        padding: 30px 35px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        animation: fadeInDown 0.8s ease forwards;
        backdrop-filter: blur(8px);
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #222;
        font-weight: 700;
        font-size: 1.9rem;
    }

    label {
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
        display: block;
    }

    input[type="text"],
    input[type="url"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border: 1.8px solid #bbb;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        resize: vertical;
    }

    input[type="text"]:focus,
    input[type="url"]:focus,
    textarea:focus {
        outline: none;
        border-color: #6a11cb;
        box-shadow: 0 0 6px #6a11cba0;
    }

    .img-thumbnail {
        display: block;
        max-height: 150px;
        margin-top: 10px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: -14px;
        margin-bottom: 12px;
    }

    .btns-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
    }

    .btn {
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s, transform 0.3s;
        text-decoration: none;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        box-shadow: 0 5px 12px rgba(101,59,255,0.5);
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #4a09aa 0%, #1b5fdc 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(101,59,255,0.7);
    }

    .btn-secondary {
        background: #aaa;
        color: #222;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn-secondary:hover {
        background: #888;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .alert {
        padding: 12px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
        text-align: center;
        background-color: #d4edda;
        color: #155724;
        box-shadow: 0 4px 10px rgba(0, 128, 0, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .expert-container {
            margin: 30px 15px;
            padding: 25px 20px;
        }

        .btns-wrapper {
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="expert-container">
    <h2>Modifier l'Expert Cinéma</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.expert.update', $expert->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" 
               class="@error('nom') is-invalid @enderror" 
               value="{{ old('nom', $expert->nom) }}" required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Titre --}}
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" 
               class="@error('titre') is-invalid @enderror" 
               value="{{ old('titre', $expert->titre) }}" required>
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Photo (URL ou upload) --}}
        <label for="photo">Photo (URL)</label>
        <input type="text" id="photo" name="photo" 
               class="@error('photo') is-invalid @enderror" 
               value="{{ old('photo', $expert->photo) }}">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if($expert->photo)
            <img src="{{ $expert->photo }}" alt="Photo Expert" class="img-thumbnail">
        @endif

        {{-- Expérience --}}
        <label for="experience">Expérience</label>
        <textarea id="experience" name="experience" rows="4" 
                  class="@error('experience') is-invalid @enderror">{{ old('experience', $expert->experience) }}</textarea>
        @error('experience')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Films --}}
        <label for="films">Films (liste ou description)</label>
        <textarea id="films" name="films" rows="3" 
                  class="@error('films') is-invalid @enderror">{{ old('films', $expert->films) }}</textarea>
        @error('films')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Lien IMDB --}}
        <label for="imdb_link">Lien IMDB</label>
        <input type="url" id="imdb_link" name="imdb_link" 
               class="@error('imdb_link') is-invalid @enderror" 
               value="{{ old('imdb_link', $expert->imdb_link) }}">
        @error('imdb_link')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        {{-- Boutons --}}
        <div class="btns-wrapper">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
