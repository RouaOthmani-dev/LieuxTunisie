@extends('layouts.app')

@section('title', 'Détail du devis #' . $devis->id)

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .detail-container {
        background: rgba(255, 255, 255, 0.95);
        max-width: 700px;
        margin: 50px auto 80px;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        color: #333;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 25px 30px;
        font-size: 1.1rem;
        color: #444;
    }

    .card p {
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .card p strong {
        color: #2c3e50;
        min-width: 100px;
        display: inline-block;
    }

    .btn-secondary {
        display: inline-block;
        margin-top: 30px;
        padding: 10px 25px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-3px);
    }

    @media (max-width: 600px) {
        .detail-container {
            padding: 20px 15px;
            margin: 30px 15px 60px;
        }

        h1 {
            font-size: 1.5rem;
        }

        .card {
            font-size: 1rem;
            padding: 20px 20px;
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
        }
    }
</style>

<div class="detail-container">
    <h1>Détail du devis #{{ $devis->id }}</h1>

    <div class="card">
        <p><strong>Nom :</strong> {{ $devis->nom }}</p>
        <p><strong>Email :</strong> {{ $devis->email }}</p>
        <p><strong>Téléphone :</strong> {{ $devis->telephone }}</p>
        <p><strong>Sujet :</strong> {{ $devis->sujet }}</p>
        <p><strong>Message :</strong></p>
        <p>{{ $devis->message ?? 'Aucun message' }}</p>
        <p><strong>Date de création :</strong> {{ $devis->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <a href="{{ route('admin.devis.index') }}" class="btn btn-secondary">← Retour à la liste</a>
</div>
@endsection
