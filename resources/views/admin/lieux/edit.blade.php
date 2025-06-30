@extends('layouts.app')

@section('title', 'Modifier Lieu')

@section('content')
<div class="container py-5" style="max-width: 700px;">
    <h1 class="mb-4 fw-bold text-primary text-center" style="font-size: 2.2rem;">Modifier le lieu : {{ $lieu->nom }}</h1>

    <form action="{{ route('admin.lieux.update', ['lieu' => $lieu->id]) }}" method="POST" enctype="multipart/form-data" class="p-4 rounded shadow" style="background: #fff; border-radius: 15px;">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div class="form-floating mb-3">
            <input type="text" name="nom" class="form-control" id="nom" value="{{ old('nom', $lieu->nom) }}" placeholder="Nom du lieu" required>
            <label for="nom">Nom du lieu</label>
        </div>

        {{-- Description --}}
        <div class="form-floating mb-3">
            <textarea name="description" class="form-control" placeholder="Description" id="description" style="height: 120px;">{{ old('description', $lieu->description) }}</textarea>
            <label for="description">Description</label>
        </div>

        {{-- Catégorie --}}
        <div class="form-floating mb-3">
            <select name="categorie_id" class="form-select" id="categorie_id" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $lieu->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            <label for="categorie_id">Catégorie</label>
        </div>

        {{-- Image --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Image (facultatif)</label>
            <input type="file" name="image" class="form-control">
            @if($lieu->image)
                <p class="mt-3 mb-1">Image actuelle :</p>
                <img src="{{ asset('storage/' . $lieu->image) }}" alt="Image actuelle" width="250" class="img-fluid rounded shadow-sm">
            @endif
        </div>

        {{-- Adresse --}}
        <div class="form-floating mb-3">
            <input type="text" name="adresse" class="form-control" id="adresse" value="{{ old('adresse', $lieu->adresse) }}" placeholder="Adresse">
            <label for="adresse">Adresse (optionnel)</label>
        </div>

        {{-- Région --}}
        <div class="form-floating mb-4">
            <input type="text" name="region" class="form-control" id="region" value="{{ old('region', $lieu->region) }}" placeholder="Région" required>
            <label for="region">Région</label>
        </div>
        <div class="mb-3">
    <label for="latitude" class="form-label">Latitude</label>
    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $lieu->latitude ?? '') }}">
</div>

<div class="mb-3">
    <label for="longitude" class="form-label">Longitude</label>
    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $lieu->longitude ?? '') }}">
</div>


        {{-- Boutons --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 p-3 rounded-3" style="background: linear-gradient(135deg, #f0f0f0 0%, #ffffff 100%); box-shadow: 0 6px 12px rgba(0,0,0,0.05);">
            <a href="{{ route('admin.lieux.index') }}" class="btn btn-outline-secondary btn-lg w-100 w-md-auto">Annuler</a>
            <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%)
        ;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-select:focus ~ label {
        color: #007bff;
        font-weight: 600;
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 1.8rem !important;
        }

        .btn-lg {
            font-size: 1rem !important;
            padding: 10px !important;
        }

        .d-flex.flex-column.flex-md-row {
            flex-direction: column !important;
            gap: 15px !important;
        }
    }
</style>
@endpush
