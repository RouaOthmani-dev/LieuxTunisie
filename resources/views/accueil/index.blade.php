@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

{{-- Diaporama plein écran avec texte en bas à gauche --}}
<div id="bandeauLieu" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" style="height: 80vh; overflow: hidden; position: relative;">

    <div class="carousel-inner h-100">
        @foreach($lieux as $key => $lieu)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100">
                <img src="{{ asset('storage/'.$lieu->image) }}" alt="{{ $lieu->nom }}" class="d-block w-100 h-100" style="object-fit: cover; filter: brightness(0.7); transition: filter 0.5s ease;">
                
                {{-- Texte superposé en bas à gauche --}}
                <div class="carousel-caption-custom">
                    <h1 class="animated-title">Explorez des paysages uniques<br>pour vos projets audiovisuels en Tunisie</h1>
                    <p class="animated-subtitle">Lieux de tournage exceptionnels | Services professionnels | Inspiration créative</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Contrôles --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#bandeauLieu" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bandeauLieu" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>

{{-- Galerie --}}
<section id="galerie" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold fade-in-title">Spots d’Exception</h2>
        <div class="row justify-content-center">
            @foreach($lieuxVedettes as $lieu)
                <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card h-100 shadow-lg border-0 animate-card">
                        <div class="overflow-hidden rounded-top">
                            <img src="{{ asset('storage/' . $lieu->image) }}" 
                                 class="card-img-top img-hover-effect" 
                                 alt="{{ $lieu->nom }}" 
                                 style="height: 250px; object-fit: cover;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center fw-bold">{{ $lieu->nom }}</h5>
                            <p class="card-text text-muted text-center">{{ Str::limit($lieu->description, 80) }}</p>
                            <div class="mt-auto text-center">
                                <a href="{{ route('lieux.show', $lieu->id) }}" class="btn btn-primary rounded-pill px-4 shadow-sm btn-animated">Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



{{-- Formulaire Devis amélioré --}}
<section id="devis" class="py-5 bg-light">
    <h2 class="text-center mb-4">Demandez un devis personnalisé</h2>
    <form method="POST" action="{{ route('devis.store') }}" class="mx-auto" style="max-width: 900px;">

        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <input type="text" name="nom_prenom" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Nom et Prénom" required>
            </div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Email" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="telephone" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Téléphone" required>
            </div>
            <div class="col-md-6">
                <select name="type_projet" class="form-select form-select-lg rounded-pill shadow-sm" required>
                    <option value="" disabled selected>Type de projet</option>
                    <option>Vidéo</option>
                    <option>Photo</option>
                    <option>Film</option>
                    <option>Publicité</option>
                    <option>Documentaire</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="number" name="nombre_jours" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Nombre de jours estimés" required min="1">
            </div>
            <div class="col-md-6">
                <input type="text" name="type_lieu" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Type de lieu recherché" required>
            </div>
            <div class="col-md-6">
                <input type="number" name="budget" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Budget approximatif" required min="0">
            </div>
            <div class="col-md-12">
                <textarea name="message" class="form-control form-control-lg rounded shadow-sm" placeholder="Message personnalisé" rows="5"></textarea>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Envoyer la demande</button>
            </div>
        </div>
    </form>
</section>

{{-- Section Expert --}}
<section id="expert" class="py-5 text-center">
    <h2 class="mb-4">Notre Expert Cinéma</h2>
    <img src="{{ asset('images/expert.jpg') }}" alt="Expert" class="rounded-circle mb-3 shadow" width="150" height="150" style="object-fit: cover;">
    <h4>Ahmed Ben Ali</h4>
    <p>Coordinateur de lieux de tournage en Tunisie</p>
    <p><em>Expérience :</em> Star Wars, Indiana Jones, Game of Thrones...</p>
    <a href="https://www.imdb.com/" target="_blank" class="btn btn-secondary">Voir sur IMDb</a>
</section>

{{-- CTA --}}
<section id="cta" class="py-5 bg-dark text-white text-center">
    <h2>Prêt pour votre prochain projet ?</h2>
    <p>Contactez-nous dès aujourd'hui pour une offre sur mesure ou explorez nos lieux exceptionnels.</p>
    <a href="#devis" class="btn btn-primary m-2">Demander un devis</a>
    <a href="#galerie" class="btn btn-light m-2">Explorer les lieux</a>
</section>

@endsection

@push('styles')
<style>
/* Diaporama */
#bandeauLieu {
    position: relative;
}

/* Texte superposé dans carousel en bas à gauche */
.carousel-caption-custom {
    position: absolute;
    bottom: 30px;
    left: 30px;
    text-align: left;
    color: #fff;
    max-width: 40%;
    background: rgba(0,0,0,0.45);
    padding: 20px 25px;
    border-radius: 12px;
    backdrop-filter: blur(6px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: all 0.4s ease;
}

/* Animation du texte */
@keyframes fadeSlideIn {
    0% {
        opacity: 0;
        transform: translateX(-30px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.animated-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    animation: fadeSlideIn 1.3s ease forwards;
}

.animated-subtitle {
    font-size: 1.3rem;
    animation: fadeSlideIn 1.7s ease forwards;
    animation-delay: 0.4s;
}

/* Assombrir les images */
.carousel-item img {
    filter: brightness(0.7);
    transition: filter 0.5s ease;
}

/* Responsive */
@media (max-width: 992px) {
    .carousel-caption-custom {
        max-width: 70%;
        bottom: 20px;
        left: 20px;
        padding: 15px 20px;
    }
    .animated-title {
        font-size: 2rem;
    }
    .animated-subtitle {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .carousel-caption-custom {
        max-width: 90%;
        bottom: 15px;
        left: 15px;
        padding: 10px 15px;
    }
    .animated-title {
        font-size: 1.5rem;
    }
    .animated-subtitle {
        font-size: 0.9rem;
    }
}

/* Formulaire amélioré */
form#devis-form {
    max-width: 900px;
    margin: 0 auto;
}

.form-control, .form-select {
    border-radius: 50px !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 12px rgba(0, 123, 255, 0.6);
    border-color: #0d6efd !important;
    outline: none;
}

textarea.form-control {
    border-radius: 12px !important;
}

.btn-primary {
    border-radius: 50px;
    padding-left: 3rem;
    padding-right: 3rem;
    box-shadow: 0 6px 15px rgba(13, 110, 253, 0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    box-shadow: 0 8px 20px rgba(11, 94, 215, 0.7);
}
<style>
    /* Titre principal fade-in */
    .fade-in-title {
        opacity: 0;
        transform: translateY(-20px);
        animation: fadeInUp 1s ease-out forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animation carte au chargement */
    .animate-card {
        transform: scale(0.95);
        opacity: 0;
        animation: cardFade 0.8s ease-in-out forwards;
    }

    @keyframes cardFade {
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Effet zoom + rotation subtile sur image hover */
    .img-hover-effect {
        transition: transform 0.5s ease, filter 0.5s ease;
    }

    .img-hover-effect:hover {
        transform: scale(1.05) rotate(1deg);
        filter: brightness(1.1);
    }

    /* Animation bouton */
    .btn-animated {
        transition: all 0.4s ease;
    }

    .btn-animated:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
        background-color: #0d6efd;
    }
</style>

</style>
@endpush
