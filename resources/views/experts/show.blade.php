@extends('layouts.app')

@section('title', 'Expert Cinéma')

@section('content')
<div class="container mt-5 expert-container">
    <div class="expert-card shadow p-4 rounded bg-white animate-fade-in">
        <h1 class="expert-name mb-3">{{ $expert->nom }}</h1>
        <h4 class="expert-title mb-4 text-secondary">{{ $expert->titre }}</h4>

        @if($expert->photo)
            <div class="expert-photo mb-4 text-center">
                <img src="{{ asset('storage/' . $expert->photo) }}" alt="{{ $expert->nom }}" class="img-fluid rounded-circle" style="max-width: 250px; border: 5px solid #0077B6;">
            </div>
        @endif

        <p><strong>Expérience :</strong> <span class="expert-info">{{ $expert->experience }}</span></p>

        <p><strong>Films :</strong> <span class="expert-info">{{ $expert->films }}</span></p>

        @if($expert->imdb_link)
            <p class="mt-4">
                <a href="{{ $expert->imdb_link }}" target="_blank" class="btn btn-primary btn-lg expert-btn">
                    Voir la fiche IMDB
                </a>
            </p>
        @endif
    </div>
</div>
@endsection
