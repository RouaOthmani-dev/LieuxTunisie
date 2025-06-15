@extends('layouts.app')

@section('title', $categorie->nom)

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">{{ $categorie->nom }}</h1>

    @if($lieux->count() > 0)
        <div class="row">
            @foreach($lieux as $lieu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($lieu->image)
                            <img src="{{ asset('storage/' . $lieu->image) }}" class="card-img-top" alt="{{ $lieu->nom }}">
                        @else
                            <img src="{{ asset('images/default-lieu.jpg') }}" class="card-img-top" alt="Lieu non disponible">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $lieu->nom }}</h5>
                            <p class="card-text">{{ Str::limit($lieu->description, 100) }}</p>
                            <a href="{{ route('lieux.show', $lieu->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Aucun lieu disponible pour cette catégorie.</p>
    @endif
</div>
@endsection
