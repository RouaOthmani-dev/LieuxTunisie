<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container-fluid">
        <!-- Logo / Titre du site -->
        <a class="navbar-brand" href="{{ route('home') }}">Lieux de tournage</a>

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
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                        href="{{ route('home') }}">Accueil</a>
                </li>

                <!-- Découvrir les lieux (dropdown) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="decouvrirDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Découvrir les lieux
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="decouvrirDropdown">
                        @foreach($categories as $category)
                            <li><a class="dropdown-item" 
                                href="{{ route('categories.show', $category->id) }}">{{ $category->nom }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <!-- Expert Cinéma -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('experts.index') ? 'active' : '' }}" 
                        href="{{ route('experts.index') }}">Expert Cinéma</a>
                </li>

                <!-- Devis -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('devis.create') ? 'active' : '' }}" 
                        href="{{ route('devis.create') }}">Demande de Devis</a>
                </li>

                <!-- Blog -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}" 
                        href="{{ route('blogs.index') }}">Blog</a>
                </li>

                <!-- Contact -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact.show') ? 'active' : '' }}" 
                        href="{{ route('contact.show') }}">Contact</a>
                </li>

                <!-- Authentification -->
                @auth
                    @if(Auth::user()->is_admin)
                        <!-- Dashboard Admin -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>
                    @endif

                    <!-- Logout (form pour CSRF) -->
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-logout">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- Login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    @if (Route::has('register'))
                        <!-- Register -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
