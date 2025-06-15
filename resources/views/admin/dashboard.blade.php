@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container mt-5">
        <div class="p-5 bg-light rounded shadow-sm" style="max-width: 700px; margin: auto;">
            <h1 class="mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 600; font-size: 2.5rem; color: #1e2a78;">
                Dashboard Administrateur
            </h1>

            <nav class="mb-4 d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary rounded-pill px-4 py-2">Accueil Admin</a>
                <a href="{{ route('admin.lieux.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">Gérer les Lieux</a>
                <a href="{{ url('/') }}" class="btn btn-info rounded-pill px-4 py-2 text-white">Retour à l'accueil du site</a>
            </nav>

            <p style="font-size: 1.15rem; color: #333;">
                Bienvenue <strong>{{ Auth::user()->name }}</strong>, vous êtes connecté en tant qu'administrateur.
            </p>

            @if(session('success'))
                <div class="alert alert-success mt-4 shadow-sm" role="alert" style="font-size: 1.1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-5 text-center">
                @csrf
                <button type="submit" class="btn btn-danger rounded-pill px-5 py-2" style="font-weight: 600;">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
@endsection
