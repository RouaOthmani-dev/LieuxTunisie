@extends('layouts.app')

@section('title', 'Détail du Message')

@section('content')
<style>
  
  .page-background {
    background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    min-height: 100vh;
    padding: 60px 15px 60px 15px; 
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

  .detail-container {
    background: rgba(255, 255, 255, 0.95);
    padding: 30px 25px;
    max-width: 700px;
    width: 100%;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    animation: fadeInUp 0.8s ease forwards;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    } 
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  h1 {
    font-weight: 700;
    font-size: 2rem;
    color: #004085;
    margin-bottom: 25px;
    text-align: center;
  }

  .card {
    background: #fff;
    padding: 25px 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    color: #333;
  }

  .card p {
    font-size: 1.05rem;
    margin-bottom: 18px;
  }

  .card p strong {
    color: #0056b3;
    min-width: 130px;
    display: inline-block;
  }

  .btn-secondary {
    display: block;
    width: max-content;
    margin: 25px auto 0 auto;
    padding: 12px 28px;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .btn-secondary:hover {
    background-color: #004085;
    color: white;
  }

  @media (max-width: 576px) {
    .detail-container {
      padding: 20px 15px;
      margin: 0 10px;
    }

    h1 {
      font-size: 1.6rem;
      margin-bottom: 20px;
    }

    .card p {
      font-size: 1rem;
      margin-bottom: 15px;
    }

    .card p strong {
      min-width: 100px;
    }
  }
</style>

<div class="page-background">
  <div class="detail-container">
    <h1>Détail du Message #{{ $message->id }}</h1>

    <div class="card shadow-sm">
      <p><strong>Nom / Prénom :</strong> {{ $message->nom_prenom }}</p>
      <p><strong>Email :</strong> {{ $message->email }}</p>
      <p><strong>Téléphone :</strong> {{ $message->telephone ?? '-' }}</p>
      <p><strong>Sujet :</strong> {{ $message->sujet ?? '-' }}</p>
      <p><strong>Message :</strong><br>{{ $message->message }}</p>
      <p><strong>Reçu le :</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
  </div>
</div>
@endsection
