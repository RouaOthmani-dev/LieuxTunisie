<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lieux de tournage en Tunisie')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 : framework CSS pour la mise en page et composants -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts : Police Roboto pour un design moderne -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


    
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
            background-color:rgba(227, 210, 193, 0.89) ; 
            overflow-x: hidden; 
        }

        main {
            flex: 1 0 auto;
            margin-top: 70px; 
        }

        .navbar {
    background-color: rgba(0, 51, 102, 0.13) !important; 
    transition: background-color 0.4s ease, box-shadow 0.4s ease;
    position: fixed;
    width: 100%;
    z-index: 1030;
    box-shadow: none;
}


.navbar.navbar-scrolled {
    background-color: rgba(134, 179, 223, 0.27) !important; 
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}


.navbar-brand,
.nav-link {
    color: #fff !important;
    font-weight: 700;
    transition: color 0.3s ease;
}


.nav-link:hover,
.nav-link:focus {
    color: #ffd54f !important; 
    text-decoration: underline;
}


.navbar-toggler {
    border-color: rgba(255, 255, 255, 0.7);
}

.navbar-toggler-icon {
    filter: invert(1); 
}


.navbar-nav .dropdown-menu {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 8px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    min-width: 220px;
    padding: 10px 0;
    opacity: 0;
    transform: translateY(15px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.navbar-nav .dropdown-menu.show {
    opacity: 1;
    transform: translateY(0);
}

.navbar-nav .dropdown-item {
    color: #003366; 
    font-weight: 600;
    padding: 8px 20px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar-nav .dropdown-item:hover,
.navbar-nav .dropdown-item:focus {
    background-color: #00509e; 
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

        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
               
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                </li>


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
                    <a class="nav-link {{ request()->routeIs('expert.show') ? 'active' : '' }}" href="{{ route('experts.index') }}">Expert Cinéma</a>
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

                <!-- Liens selon authentification -->
                @auth
                    @if(Auth::user()->is_admin)
                        <!-- Admin : lien dashboard -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>

                        <!-- Déconnexion -->
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <!-- Utilisateur : menu Profil -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                               {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Modifier mes infos</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0 m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-decoration-none text-start w-100">Se déconnecter</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @else
                    <!-- Non connecté -->
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


<!-- Contenu principal de la page -->
<main>
    @yield('content') <!-- La section 'content' des vues sera injectée ici -->
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
    background: rgba(0, 0, 0, 0.08);  /* Overlay noir semi-transparent */
    backdrop-filter: blur(5px);      /* Flou léger sur l’image */
    -webkit-backdrop-filter: blur(5px);
    z-index: 0;
  }
  .footer .content {
    position: relative;
    z-index: 1;                     /* Pour être au-dessus de l’overlay */
  }
  /* Animation simple fadeIn */
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
            <!-- Colonne 1 : Logo & Slogan -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">Tournage Tunisie</h5>
                <p>Explorez des décors uniques pour vos projets vidéo et photo en Tunisie.</p>
            </div>

            <!-- Colonne 2 : Navigation -->
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

            <!-- Colonne 3 : Réseaux sociaux -->
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



<!-- Bootstrap Bundle JS (inclut Popper pour dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
</script>



<!-- Pour ajouter d'autres scripts via @push('scripts') dans les vues -->
@stack('scripts')
</body>
</html>
