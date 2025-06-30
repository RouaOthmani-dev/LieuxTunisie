@extends('layouts.app')

@section('title', isset($blog->id) ? 'Modifier un article' : 'Créer un article')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        padding: 50px 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background: white;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        max-width: 600px;
        width: 100%;
        animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 600;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: box-shadow 0.3s;
    }

    input[type="text"]:focus,
    textarea:focus {
        box-shadow: 0 0 8px rgba(100, 149, 237, 0.5);
        outline: none;
    }

    button {
        display: inline-block;
        width: 100%;
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #2575fc;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #6a11cb;
    }
</style>

<div class="form-container">
    <h1>{{ isset($blog->id) ? 'Modifier un article' : 'Créer un article' }}</h1>

    <form action="{{ isset($blog->id) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($blog->id))
            @method('PUT')
        @endif

        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="{{ old('titre', $blog->titre) }}" required>

        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu" rows="6" required>{{ old('contenu', $blog->contenu) }}</textarea>

        <label for="image">Image (optionnelle)</label>
        <input type="file" name="image" id="image">

        <button type="submit">{{ isset($blog->id) ? 'Modifier' : 'Créer' }}</button>
    </form>

    <a href="{{ route('admin.blog.index') }}" class="back-link">← Retour à la liste des articles</a>
</div>
@endsection
