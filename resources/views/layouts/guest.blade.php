<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Lieux de tournage en Tunisie')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vite (Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- AOS Animate On Scroll CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Roboto', sans-serif;
            background-color: rgba(202, 167, 133, 0.52);
            overflow-x: hidden;
        }
        main {
            flex: 1 0 auto;
            margin-top: 70px;
        }
        .navbar {
            background-color: rgba(97, 166, 216, 0.21);
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
        }
        .nav-link:hover {
            color: #ffc107 !important;
        }
        .navbar-nav .dropdown-menu {
            background: rgba(212, 163, 115, 0.94);
            border-radius: 10px;
            border: none;
            box-shadow: 0 8px 15px rgba(212, 163, 115, 0.3);
            min-width: 200px;
            padding: 10px 0;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .navbar-nav .dropdown-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        .navbar-nav .dropdown-item {
            color: #003f63;
            font-weight: 600;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .navbar-nav .dropdown-item:hover,
        .navbar-nav .dropdown-item:focus {
            background-color: #87CEEB;
            color: #fff;
            border-radius: 5px;
        }
        .navbar-nav .dropdown-toggle:focus {
            outline: none;
            box-shadow: none;
        }
        footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            color: #555;
            padding: 20px 0;
            text-align: center;
            font-size: 15px;
            font-weight: 400;
            border-top: 2px solid #0077B6;
            letter-spacing: 0.5px;
        }
        form button.btn-logout {
            background: none;
            border: none;
            padding: 0;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        form button.btn-logout:hover {
            color: #ffc107;
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Tournage Tunisie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Découvrir les lieux</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('categories.show', $category->id) }}">{{ $category->nom }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('experts.index') ? 'active' : '' }}" href="{{ route('experts.index') }}">Expert Cinéma</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('devis.create') ? 'active' : '' }}" href="{{ route('devis.create') }}">Demande de Devis</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blog</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.show') ? 'active' : '' }}" href="{{ route('contact.show') }}">Contact</a></li>
                @auth
                    @if(Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">@csrf
                            <button type="submit" class="btn-logout nav-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main>
    @yield('content')
</main>
<!-- Footer toujours en bas -->
<style>
  .footer {
    position: relative;
    background-image: url('{{ asset('storage/Djerba.png') }}');
    background-size: cover;
    background-position: center;
    color: white;
    overflow: hidden;
  }
  .footer::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.08); 
    backdrop-filter: blur(5px);      
    -webkit-backdrop-filter: blur(5px);
    z-index: 0;
  }
  .footer .content {
    position: relative;
    z-index: 1;                    
  }
  
  @keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
  }
  .footer .content > * {
    animation: fadeIn 1s ease forwards;
  }
  .footer .content > *:nth-child(2) {
    animation-delay: 0.3s;
  }
  .footer .content > *:nth-child(3) {
    animation-delay: 0.6s;
  }
</style>

<footer class="footer mt-auto py-5">
    <div class="container content">
        <div class="row">
            
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Tournage Tunisie</h5>
                <p>Explorez des décors uniques pour vos projets vidéo et photo en Tunisie.</p>
            </div>

            <div class="col-md-4 mb-4">
                <h6>Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Accueil</a></li>
                    <li><a href="{{ url('#galerie') }}" class="text-white text-decoration-none">Découvrir les lieux</a></li>
                    <li><a href="{{ url('/experts') }}" class="text-white text-decoration-none">Expert Cinéma</a></li>
                    <li><a href="{{ url('/devis') }}" class="text-white text-decoration-none">Demande de devis</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h6>Suivez-nous</h6>
                <a href="https://instagram.com" target="_blank" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="https://pinterest.com" target="_blank" class="text-white me-3"><i class="bi bi-pinterest"></i></a>
                <a href="https://tiktok.com" target="_blank" class="text-white"><i class="bi bi-tiktok"></i></a>
                <p class="mt-3">
                    <a href="{{ url('/confidentialite') }}" class="text-white text-decoration-underline small">Politique de confidentialité</a>
                </p>
            </div>
        </div>

        <div class="text-center mt-3 small">
            &copy; {{ date('Y') }} Tunisie Casting - Tous droits réservés.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200 });
</script>
@stack('scripts')
</body>
</html>
