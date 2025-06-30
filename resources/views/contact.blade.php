@extends('layouts.app')

@section('title', 'Contact')

@push('styles')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        color: #003f63;
    }

    main {
        flex: 1;
    }

    .container-contact {
        max-width: 800px;
        margin: 60px auto;
        background: #fff;
        border-radius: 20px;
        padding: 40px 35px;
        box-shadow: 0 12px 30px rgba(135, 206, 235, 0.35);
        animation: fadeTranslateUp 1.2s ease forwards;
    }

    h1 {
        text-align: center;
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 40px;
        color: #216583;
        text-shadow: 1px 1px 4px rgba(135, 206, 235, 0.6);
        text-transform: uppercase;
        letter-spacing: 1.2px;
    }

    form {
        background: transparent;
    }

    label.form-label {
        font-weight: 700;
        color: #0077b6;
        margin-bottom: 6px;
    }

    input.form-control,
    textarea.form-control {
        background: #f0f9ff;
        border: 2px solid #90e0ef;
        border-radius: 10px;
        color: #023e8a;
        font-weight: 500;
        box-shadow: 0 3px 8px rgba(135, 206, 235, 0.3);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input.form-control:focus,
    textarea.form-control:focus {
        border-color: #0077b6;
        box-shadow: 0 0 14px rgba(0, 119, 182, 0.5);
        background: #ffffff;
        outline: none;
    }

    .invalid-feedback {
        color: #d00000;
        font-weight: 600;
        margin-top: 4px;
    }

    button.btn-primary {
        background-color: #87CEEB;
        border: none;
        font-weight: 700;
        padding: 14px 40px;
        border-radius: 50px;
        box-shadow: 0 8px 18px rgba(135, 206, 235, 0.6);
        color: #003f63;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        display: inline-block;
        width: 100%;
        max-width: 220px;
        margin: 0 auto;
        text-align: center;
        font-size: 1.1rem;
        user-select: none;
    }

    button.btn-primary:hover {
        background-color: #216583;
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(33, 101, 131, 0.7);
    }

    .alert-success {
        background-color: #D4A373;
        color: #fff;
        font-weight: 700;
        border-radius: 50px;
        padding: 15px 20px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 8px 20px rgba(212, 163, 115, 0.6);
        animation: fadeTranslateUp 1.2s ease forwards;
    }

    /* Animations */
    @keyframes fadeTranslateUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-contact {
            margin: 40px 15px;
            padding: 30px 20px;
        }
        h1 {
            font-size: 2rem;
        }
        button.btn-primary {
            max-width: 100%;
            padding: 12px 0;
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-contact">
    <h1>Contactez-nous</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div class="mb-4">
            <label for="nom_prenom" class="form-label">Nom et prénom</label>
            <input type="text" id="nom_prenom" name="nom_prenom" class="form-control @error('nom_prenom') is-invalid @enderror" value="{{ old('nom_prenom') }}" required>
            @error('nom_prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" id="telephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="sujet" class="form-label">Sujet</label>
            <input type="text" id="sujet" name="sujet" class="form-control @error('sujet') is-invalid @enderror" value="{{ old('sujet') }}">
            @error('sujet')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="form-label">Message</label>
            <textarea id="message" name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="rgpd" id="rjpd" required>
            <lable class="form-check-label" for="rjpd" >
                j'accepte la <a href="{{route('confidentialite')}}">politique de confidentialité. </a>
            <label>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
