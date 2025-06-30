@extends('layouts.app')

@section('title', 'Ajouter un Nouveau Lieu')

@section('content')
<style>

  body {
    background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    margin: 0;
    padding: 0;
  }

  
  .container.custom-form-container {
    max-width: 700px;
    margin: 50px auto 70px auto;
    padding: 0 15px;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.8s ease forwards;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    backdrop-filter: blur(8px);
  }

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    text-align: center;
    margin: 30px 0;
  }

  .form-floating > .form-control,
  .form-floating > .form-select {
    height: 50px;
    font-size: 1rem;
    padding: 1rem 1rem 0 1rem;
    border-radius: 10px;
    border: 1.6px solid #ccc;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-floating > .form-control:focus,
  .form-floating > .form-select:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 8px #6a11cba0;
    outline: none;
  }

  .form-floating > label {
    padding-left: 15px;
    font-weight: 600;
    color: #555;
    transition: color 0.3s ease;
  }

  .form-floating > .form-control:focus ~ label,
  .form-floating > .form-select:focus ~ label {
    color: #6a11cb;
  }

  textarea.form-control {
    min-height: 100px;
    resize: vertical;
  }

  .form-label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #444;
  }

  input[type="file"] {
    padding: 5px;
    border-radius: 10px;
    border: 1.5px solid #ccc;
    width: 100%;
  }

  .form-check-label {
    font-weight: 600;
    color: #444;
  }

  .btn-submit-zone {
    margin: 35px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f0f0f0 0%, #ffffff 100%);
    padding: 15px 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
    transition: box-shadow 0.3s ease;
  }

  .btn-submit-zone:hover {
    box-shadow: 0 10px 35px rgba(0,0,0,0.12);
  }

  .btn-outline-secondary,
  .btn-primary {
    padding: 12px 28px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 1.1rem;
    min-width: 130px;
    transition: all 0.3s ease;
  }

  .btn-outline-secondary {
    border: 2.5px solid #6a11cb;
    color: #6a11cb;
    background: transparent;
  }

  .btn-outline-secondary:hover {
    background: #6a11cb;
    color: white;
    border-color: #5a0fb0;
  }

  .btn-primary {
    background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
    border: none;
    color: white;
    box-shadow: 0 5px 15px rgba(101, 59, 255, 0.6);
  }

  .btn-primary:hover {
    background: linear-gradient(45deg, #5a0fb0 0%, #1b5fdc 100%);
    box-shadow: 0 8px 25px rgba(101, 59, 255, 0.8);
    transform: translateY(-3px);
  }

  @media (max-width: 576px) {
    h2 {
      font-size: 1.7rem;
    }

    .btn-submit-zone {
      flex-direction: column;
      gap: 15px;
      padding: 20px;
    }

    .btn-outline-secondary,
    .btn-primary {
      width: 100%;
      min-width: auto;
    }
  }
</style>

<div class="container custom-form-container">
  <h2>Ajouter un Nouveau Lieu</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <strong>Oups !</strong> Veuillez corriger les erreurs ci-dessous :
          <ul class="mb-0 mt-2">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form action="{{ route('admin.lieux.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="form-floating mb-3">
      <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" placeholder="Nom du lieu" required>
      <label for="nom">Nom du lieu</label>
    </div>

    <div class="form-floating mb-3">
      <textarea name="description" class="form-control" placeholder="Description" id="description" required>{{ old('description') }}</textarea>
      <label for="description">Description</label>
    </div>

    <div class="form-floating mb-3">
      <select name="categorie_id" class="form-select" id="categorie_id" required>
        <option value="">-- Choisir une catégorie --</option>
        @foreach($categories as $categorie)
          <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
            {{ $categorie->nom }}
          </option>
        @endforeach
      </select>
      <label for="categorie_id">Catégorie</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" name="region" value="{{ old('region') }}" class="form-control" id="region" placeholder="Région" required>
      <label for="region">Région</label>
    </div>

    <div class="form-floating mb-3">
      <input type="text" name="adresse" value="{{ old('adresse') }}" class="form-control" id="adresse" placeholder="Adresse (optionnel)">
      <label for="adresse">Adresse (optionnel)</label>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Image (optionnel)</label>
      <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <div class="form-check form-switch mb-4">
      <input class="form-check-input" type="checkbox" name="vedette" id="vedette" value="1" {{ old('vedette') ? 'checked' : '' }}>
      <label class="form-check-label" for="vedette">Mettre en vedette</label>
    </div>
    <div class="mb-3">
    <label for="latitude" class="form-label">Latitude</label>
    <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $lieu->latitude ?? '') }}">
</div>

<div class="mb-3">
    <label for="longitude" class="form-label">Longitude</label>
    <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $lieu->longitude ?? '') }}">
</div>


    <div class="btn-submit-zone">
      <a href="{{ route('admin.lieux.index') }}" class="btn btn-outline-secondary">Annuler</a>
      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
  </form>
</div>
@endsection
