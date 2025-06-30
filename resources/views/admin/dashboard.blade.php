@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        min-height: 100vh;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-container {
        max-width: 920px;
        margin: 60px auto 80px;
        background: #ffffffdd;
        border-radius: 25px;
        padding: 50px 40px;
        box-shadow: 0 18px 40px rgba(30, 58, 138, 0.18);
        border: 1px solid #d0d7e1;
        transition: box-shadow 0.3s ease;
    }

    .dashboard-container:hover {
        box-shadow: 0 25px 60px rgba(30, 58, 138, 0.25);
    }

    h1 {
        font-weight: 700;
        font-size: 3rem;
        color: #1e3a8a;
        margin-bottom: 2.8rem;
        text-align: center;
        letter-spacing: 1.3px;
        user-select: none;
    }

    nav.admin-nav {
        margin-bottom: 45px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 22px;
    }

    nav.admin-nav a {
        padding: 14px 38px;
        border-radius: 40px;
        font-size: 1.2rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        user-select: none;
        transition: all 0.35s ease;
        box-shadow: 0 12px 25px rgba(30, 58, 138, 0.2);
        white-space: nowrap;
        display: inline-block;
        color: #fff;
        background: linear-gradient(135deg, #4a6ef8, #1e3a8a);
        border: none;
    }

    nav.admin-nav a.btn-outline-secondary {
        background: linear-gradient(135deg, #4a6ef8, #1e3a8a);
        color: #fff;
        border: none;
        box-shadow: 0 12px 25px rgba(30, 58, 138, 0.2);
    }

    nav.admin-nav a.btn-info {
        background: linear-gradient(135deg, #0dcaf0, #0aa2cc);
        color: #fff;
        box-shadow: 0 12px 28px rgba(13, 202, 240, 0.35);
    }

    nav.admin-nav a.btn-danger {
        background: linear-gradient(135deg, #dc3545, #b02a37);
        color: #fff;
        box-shadow: 0 12px 28px rgba(220, 53, 69, 0.35);
    }

    nav.admin-nav a:hover {
        transform: scale(1.08);
        box-shadow: 0 22px 58px rgba(30, 58, 138, 0.6);
    }

    p.welcome-text {
        font-size: 1.3rem;
        color: #3e4a72;
        margin-top: 1rem;
        text-align: center;
        font-weight: 500;
        user-select: none;
    }

    p.welcome-text strong {
        color: #1e3a8a;
    }

    @media (max-width: 992px) {
        .dashboard-container {
            max-width: 90%;
            padding: 40px 30px;
            margin: 40px auto 60px;
        }

        h1 {
            font-size: 2.4rem;
            margin-bottom: 2rem;
        }

        nav.admin-nav a {
            font-size: 1.1rem;
            padding: 12px 32px;
        }

        p.welcome-text {
            font-size: 1.15rem;
            margin-top: 1.2rem;
        }
    }
</style>

<div class="dashboard-container">
    <h1>Tableau de Bord Administrateur</h1>

    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}">Accueil Admin</a>
        <a href="{{ route('admin.lieux.index') }}">Gérer les Lieux</a>
        <a href="{{ route('admin.blog.index') }}">Gérer le Blog</a>
        <a href="{{ route('admin.expert.edit', $expert->id) }}">Gérer l'Expert</a>
        <a href="{{ route('admin.devis.index') }}">Voir les Devis</a>
        <a href="{{ route('admin.contact.index') }}">Voir les Contacts</a>
        <a href="{{ url('/') }}" class="btn-info">Retour au Site</a>
    </nav>

    <p class="welcome-text">
        Bonjour <strong>{{ Auth::user()->name }}</strong>, vous êtes connecté en tant qu'<strong>Administrateur</strong>.
    </p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button type="submit" class="btn btn-danger">Se déconnecter</button>
    </form>
</div>
@endsection
