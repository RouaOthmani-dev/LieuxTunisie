@extends('layouts.app')

@section('title', $lieu->nom)

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">{{ $lieu->nom }}</h1>
    
    @if($lieu->image)
        <img src="{{ asset('storage/' . $lieu->image) }}" alt="{{ $lieu->nom }}" class="img-fluid mb-4">
    @else
        <img src="{{ asset('images/default-lieu.jpg') }}" alt="Image non disponible" class="img-fluid mb-4">
    @endif

    <p><strong>Description :</strong> {{ $lieu->description }}</p>
    <p><strong>Région :</strong> {{ $lieu->region }}</p>
    <p><strong>Adresse :</strong> {{ $lieu->adresse ?? 'Non spécifiée' }}</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Retour à l'accueil</a>
</div>
@endsection
