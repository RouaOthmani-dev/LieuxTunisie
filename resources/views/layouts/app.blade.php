<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lieux de tournage en Tunisie')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Styles personnalisés -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(1, 1, 1, 0.76);
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Carousel plein écran */
        #bandeauLieu {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        #bandeauLieu .carousel-inner,
        #bandeauLieu .carousel-item,
        #bandeauLieu .carousel-item img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        /* Titre animé en haut à droite */
        .carousel-title {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1.8rem;
            font-weight: bold;
            z-index: 10;
            animation: fadeInRight 1.5s ease forwards;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Footer */
        footer {
            background-color:rgba(61, 66, 72, 0.87);
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        /* Bouton logout ressemblant aux liens */
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

<!-- Navbar dynamique -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <!-- Logo / Titre du site -->
        <a class="navbar-brand" href="{{ route('home') }}">Tournage Tunisie</a>

        <!-- Burger (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens navbar -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <!-- Accueil -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                </li>

                <!-- Découvrir les lieux (dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="decouvrirDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Découvrir les lieux
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="decouvrirDropdown">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('categories.show', $category->id) }}">{{ $category->nom }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <!-- Expert Cinéma -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('experts.index') ? 'active' : '' }}" href="{{ route('experts.index') }}">Expert Cinéma</a>
                </li>

                <!-- Devis -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('devis.create') ? 'active' : '' }}" href="{{ route('devis.create') }}">Demande de Devis</a>
                </li>

                <!-- Blog -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" href="{{ route('blogs.index') }}">Blog</a>
                </li>

                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact.show') ? 'active' : '' }}" href="{{ route('contact.show') }}">Contact</a>
                </li>

                <!-- Authentification -->
                @auth
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-logout nav-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu de la page -->
<main style="margin-top: 70px;">
    @yield('content')
</main>

<!-- Footer -->
<footer>
    <div class="container">
        &copy; 2025 Tournage Tunisie. Tous droits réservés.
    </div>
</footer>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
