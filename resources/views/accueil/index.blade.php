@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<div id="bandeauLieu" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000" 
     aria-label="Bandeau lieux de tournage" style="height: 100vh; overflow: hidden; position: relative;">

    <div class="carousel-inner h-100">
        @foreach($lieuxVedettes as $key => $lieu)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }} h-100 position-relative">
                <img src="{{ asset('storage/'.$lieu->image) }}" 
                     alt="{{ $lieu->nom }}" 
                     class="d-block w-100 h-100 diapo-img" 
                     style="object-fit: cover;">

                <div class="diapo-overlay"></div>

                <div class="carousel-caption-custom text-start">
                    <h1 class="animated-title">Explorez des paysages uniques<br>pour vos projets audiovisuels en Tunisie</h1>
                    <p class="animated-subtitle">Lieux de tournage exceptionnels | Services professionnels | Inspiration créative</p>
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#bandeauLieu" data-bs-slide="prev" aria-label="Image précédente">
        <span class="carousel-control-prev-icon visually-hidden-focusable"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bandeauLieu" data-bs-slide="next" aria-label="Image suivante">
        <span class="carousel-control-next-icon visually-hidden-focusable"></span>
    </button>

</div>


    <button class="carousel-control-prev" type="button" data-bs-target="#bandeauLieu" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bandeauLieu" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>


{{-- Galerie modernisée --}}
<section id="galerie" class="py-5 rounded">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold fade-in-title">Spots d’Exception</h2>
        <div class="row justify-content-center">
            @foreach($lieuxVedettes as $lieu)
                <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch animate-card">
                    <div class="card h-100 shadow-lg border-0 glass-card overflow-hidden">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $lieu->image) }}" 
                                 class="card-img-top img-hover-effect" 
                                 alt="{{ $lieu->nom }}" 
                                 loading="lazy"
                                 style="height: 250px; object-fit: cover;">
                            <div class="img-overlay"></div>
                        </div>
                        <div class="card-body d-flex flex-column text-dark">
                            <h5 class="card-title text-center fw-bold">{{ $lieu->nom }}</h5>
                            <p class="card-text text-center">{{ Str::limit($lieu->description, 80) }}</p>
                            <div class="mt-auto text-center">
                                <a href="{{ route('lieux.show', $lieu->id) }}" class="btn btn-animated rounded-pill px-4 shadow-sm">Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


</section>

{{-- Formulaire Devis (clair, lisible, réel et fonctionnel) --}}
<section id="devis" class="py-5 bg-light text-dark">
    <h2 class="text-center mb-4">Demandez un devis personnalisé</h2>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="text-center mx-auto my-4" style="background-color: #D2A679; color: white; padding: 15px; border-radius: 25px; max-width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Erreurs validation --}}
    @if($errors->any())
        <div class="alert alert-danger text-center mx-auto" style="max-width:500px;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('devis.store') }}" class="mx-auto" style="max-width: 900px;">
        @csrf
        <div class="row g-4 d-flex flex-wrap">
            <div class="col-md-6">
                <input type="text" name="nom" value="{{ old('nom') }}" required
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Nom complet">
            </div>
            <div class="col-md-6">
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Email">
            </div>
            <div class="col-md-6">
                <input type="tel" name="telephone" value="{{ old('telephone') }}" required
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Téléphone">
            </div>
            <div class="col-md-6">
                <select name="type_projet" required
                    class="form-select form-select-lg rounded-pill shadow-sm">
                    <option disabled {{ old('type_projet') ? '' : 'selected' }}>Type de projet</option>
                    @foreach(['Vidéo', 'Photo', 'Film', 'Publicité', 'Documentaire'] as $type)
                        <option value="{{ $type }}" {{ old('type_projet') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <input type="number" name="nb_jours" value="{{ old('nb_jours') }}" required min="1"
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Nombre de jours">
            </div>
            <div class="col-md-6">
                <input type="text" name="lieu_recherche" value="{{ old('lieu_recherche') }}" required
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Lieu recherché">
            </div>
            <div class="col-md-6">
                <input type="number" step="0.01" name="budget" value="{{ old('budget') }}" required min="0"
                    class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Budget">
            </div>
            <div class="col-md-12">
                <textarea name="message" rows="5"
                    class="form-control form-control-lg rounded shadow-sm"
                    placeholder="Message">{{ old('message') }}</textarea>
            </div>
            <div class="col-md-12">
               <div class="form-check mb-3">
                   <input class="form-check-input" type="checkbox" name="rgpd" id="rgpd" required>
                   <label class="form-check-label" for="rgpd">
                        j'accepte la <a href="{{ route('confidentialite') }}">politique de confidentialité.</a>
                   </label>
               </div>
           </div>


            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Envoyer la demande</button>
            </div>
        </div>
    </form>
</section>


{{-- Expert --}}
<section id="expert" class="py-5 text-center rounded">
    <div class="container">
        <h2 class="mb-4 fw-bold fade-in-title">Notre Expert Cinéma</h2>
        <img src="{{ asset('images/expert.jpg') }}" alt="Expert" 
             class="rounded-circle mb-3 shadow-lg mx-auto d-block expert-img" 
             width="160" height="160" style="object-fit: cover;">
        <h4 class="fw-semibold">Ahmed Ben Ali</h4>
        <p class="fst-italic">Coordinateur de lieux de tournage en Tunisie</p>
        <p><em>Expérience :</em> Star Wars, Indiana Jones, Game of Thrones...</p>
        <a href="https://www.imdb.com/" target="_blank" class="btn btn-expert mt-3 px-4 py-2 rounded-pill shadow-sm">Voir sur IMDb</a>
    </div>
</section>


{{-- CTA --}}
<section id="cta" class="py-5 text-center rounded">
    <h2 class="mb-3 cta-title">Transformez vos idées en réalité</h2>
    <p class="cta-subtitle mb-4">Découvrez des lieux uniques et obtenez une offre sur mesure pour vos projets audiovisuels en Tunisie.</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="#devis" class="btn btn-cta">Demander un devis</a>
        <a href="#galerie" class="btn btn-cta">Explorer les lieux</a>
    </div>
</section>


@endsection

@push('styles')
<style>

#devis form {
    background-color: rgba(255, 255, 255, 0.2);
    padding: 2rem;
    border-radius: 20px;
    backdrop-filter: blur(6px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

#devis input,
#devis select,
#devis textarea {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid #ccc;
    color: #333;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

#devis input:focus,
#devis select:focus,
#devis textarea:focus {
    border-color: #87CEEB;
    box-shadow: 0 0 8px rgba(135, 206, 235, 0.5);
}

#devis ::placeholder {
    color: #999;
    opacity: 1;
}


#devis button[type="submit"] {
    background-color: #87CEEB;
    border: none;
    color: #003f63;
    font-weight: 700;
    padding: 0.75rem 2.5rem;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

#devis button[type="submit"]:hover {
    background-color:linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(0, 119, 182, 0.5);
}

@media (max-width: 768px) {
    #devis .row.g-4 {
        flex-direction: column;
    }
}

#bandeauLieu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    background: linear-gradient(135deg, #e6eef3 0%, #ffffff 100%);
    z-index: 1;
}


.diapo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(1.2) contrast(1.05); 
    transform: none; 
    transition: filter 0.8s ease-in-out;
}

.diapo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2); 
    backdrop-filter: blur(2px); 
    -webkit-backdrop-filter: blur(2px);
    z-index: 2; 
}


.carousel-caption-custom {
    position: absolute;
    top: 40px;
    left: 50px;
    z-index: 2;
    padding: 25px 30px;
    max-width: 40%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(6px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: fadeInZoom 1.5s ease forwards;
    overflow: hidden;
}

@keyframes fadeInZoom {
    0% { opacity: 0; transform: translateY(-20px) scale(0.95); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

.animated-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #ffffff;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
}

.animated-subtitle {
    font-size: 1.2rem;
    color: #f5f5f5;
    margin-top: 10px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

/* Responsive */
@media (max-width: 992px) {
    .carousel-caption-custom {
        max-width: 70%;
        left: 20px;
        top: 30px;
        padding: 20px;
    }
    .animated-title { font-size: 2rem; }
    .animated-subtitle { font-size: 1.1rem; }
}

@media (max-width: 576px) {
    .carousel-caption-custom {
        max-width: 90%;
        padding: 15px;
        left: 15px;
        top: 25px;
    }
    .animated-title { font-size: 1.6rem; }
    .animated-subtitle { font-size: 0.95rem; }
}

#galerie {
    background: linear-gradient(135deg, #fff 30%, #D4A373 90%);
    border-radius: 15px;
    padding: 3rem 1rem !important;
}

#galerie h2 {
    color: #333;
    text-shadow: 1px 1px 5px #ccc;
}

@keyframes fadeTranslateUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.animate-card {
    animation: fadeTranslateUp 0.8s ease forwards;
}

.row.justify-content-center > div {
    opacity: 0;
    animation: fadeTranslateUp 0.8s ease forwards;
}

.row.justify-content-center > div:nth-child(1) { animation-delay: 0.1s; }
.row.justify-content-center > div:nth-child(2) { animation-delay: 0.25s; }
.row.justify-content-center > div:nth-child(3) { animation-delay: 0.4s; }

.glass-card {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(8px);
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.glass-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.25);
}

.img-hover-effect {
    transition: transform 0.5s ease, filter 0.5s ease;
}

.img-hover-effect:hover {
    transform: scale(1.1);
    filter: brightness(1.15) contrast(1.05);
}

.img-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.05);
    transition: background 0.4s ease;
}

.glass-card:hover .img-overlay {
    background: rgba(135,206,235,0.2);
}

.glass-card .card-title,
.glass-card .card-text {
    color: #333;
}

.btn-animated {
    background-color: #87CEEB;
    border-color: #87CEEB;
    color:linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    transition: all 0.4s ease;
}

.btn-animated:hover {
    background-color:linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    border-color:linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    color: #fff;
    box-shadow: 0 8px 15px rgba(212, 163, 115, 0.5);
    transform: translateY(-3px);
}

#expert {
    background: linear-gradient(135deg, rgba(255,255,255,0.85) 20%,rgb(142, 104, 67) 100%);
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    color:white;
    text-shadow: 0 1px 3px rgba(255,255,255,0.5);
    padding: 5rem 2rem;
    position: relative;
    overflow: hidden;
}

#expert::before {
    content: "";
    position: absolute;
    top: -40%; left: -40%;
    width: 180%; height: 180%;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
    animation: bgPulse 10s infinite alternate ease-in-out;
    z-index: 0;
}

@keyframes bgPulse {
    0% { transform: scale(1); opacity: 0.3; }
    100% { transform: scale(1.1); opacity: 0.1; }
}

#expert .container {
    position: relative;
    z-index: 2;
}

#expert h2 {
    font-size: 2.8rem;
    margin-bottom: 1.5rem;
    color:white;
    animation: fadeSlideIn 1.2s ease forwards;
}

#expert h4 {
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
    color: white;
    animation: fadeSlideIn 1.5s ease forwards;
}

#expert p {
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto 1rem;
    color:white;
    animation: fadeSlideIn 1.8s ease forwards;
}

.expert-img {
    border: 4px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 0 15px rgba(212, 163, 115, 0.5);
    animation: pulseGlow 4s infinite ease-in-out;
}

@keyframes pulseGlow {
    0%, 100% {
        box-shadow: 0 0 15px rgba(212, 163, 115, 0.4);
    }
    50% {
        box-shadow: 0 0 30px rgba(212, 163, 115, 0.7);
    }
}

.btn-expert {
    background-color:0 5px 15px rgba(212, 163, 115, 0.4);
    border: none;
    color: #fff;
    font-weight: 600;
    padding: 0.6rem 1.8rem;
    border-radius: 50px;
    transition: all 0.4s ease;
    box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
}

.btn-expert:hover {
    background-color: #b8865b;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(212, 163, 115, 0.6);
}


@keyframes pulseGlow {
    0%, 100% {
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.6);
    }
}

.btn-secondary.btn-glow {
    background-color: #9a7c4f;
    border-color: #9a7c4f;
    color: #f0f4f8;
    box-shadow: 0 0 12px #9a7c4fbb;
    transition: all 0.3s ease;
}

.btn-secondary.btn-glow:hover {
    background-color: #365f7e;
    border-color: #365f7e;
    color: #fff;
    box-shadow: 0 0 18px #365f7ebb;
}

#cta {
    padding-top: 5rem !important;
    padding-bottom: 5rem !important;
    background:rgba(211, 167, 122, 0.69);;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(212, 163, 115, 0.3);
    color:rgb(221, 211, 211);
    text-shadow: none;
    transition: background-color 0.7s ease;
}

#cta h2.cta-title {
    font-size: 2.8rem;
    margin-bottom: 1rem;
    font-weight: 700;
    animation: fadeSlideIn 1.2s ease forwards;
    color:rgb(232, 241, 248);
}

#cta p.cta-subtitle {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 2rem;
    color:rgb(220, 228, 232);
}

#cta .btn {
    font-size: 1.1rem;
    padding: 0.75rem 2.5rem;
    margin: 0.5rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.4s ease;
    box-shadow: 0 5px 15px rgba(116, 204, 238, 0.71);
    animation: fadeSlideIn 1.5s ease forwards;
}

.btn-glow-light {
    background-color: #87CEEB;
    color:rgb(227, 237, 243);
    border: none;
}

.btn-glow-light:hover {
    background-color:rgba(107, 182, 219, 0.84);
    color: #fff;
    box-shadow: 0 0 20px #6bb5dbee;
}

.btn-glow-dark {
    background-color: #365f7e;
    color: #f0f8ff;
    border: none;
    box-shadow: 0 0 15pxrgba(0, 0, 0, 0.73);
}

.btn-glow-dark:hover {
    background-color: #25435a;
    color: #f0f8ff;
    box-shadow:  #87CEEB;
}

@media (max-width: 992px) {
    .carousel-caption-custom { max-width: 70%; left: 20px; bottom: 20px; }
}
@media (max-width: 576px) {
    .carousel-caption-custom { max-width: 90%; left: 15px; bottom: 15px; }
    .animated-title { font-size: 1.8rem; }
    .animated-subtitle { font-size: 1rem; }
}

@media (max-width: 768px) {
    #devis h2,
    #expert h2,
    #cta h2.cta-title {
        font-size: 2rem !important;
    }
}
#bandeauLieu,
#galerie,
#devis,
#expert,
#cta {
    min-height: 100vh; /* occupe 100% de la hauteur de l'écran */
    display: flex;
    align-items: center; /* centre verticalement le contenu */
    justify-content: center; /* centre horizontalement si besoin */
    flex-direction: column; /* contenu empilé verticalement */
}


#bandeauLieu {
    display: block; 
    min-height: 100vh;
}

#galerie, #devis, #expert, #cta {
    padding-top: 5rem;
    padding-bottom: 5rem;
}

#cta {
    padding-top: 5rem !important;
    padding-bottom: 5rem !important;
    background: rgba(227, 210, 193, 0.89);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(54, 95, 126, 0.4);
    color:rgb(1, 6, 12);
    text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
    transition: background 0.5s ease;
}

#cta h2.cta-title {
    font-size: 2.8rem;
    color:white;
    margin-bottom: 1rem;
    font-weight: 700;
    animation: fadeSlideIn 1.2s ease forwards;
}

#cta p.cta-subtitle {
    font-size: 1.3rem;
    max-width: 700px;
    margin: 0 auto 2rem;
    color:white;
    animation: fadeSlideIn 1.4s ease forwards;
}

#cta .btn-cta {
    font-size: 1.1rem;
    padding: 0.75rem 2.5rem;
    margin: 0.5rem;
    font-weight: 600;
    border-radius: 50px;
    background-color: #ffffff;
    color: #365f7e;
    border: 2px solid #fff;
    box-shadow: 0 5px 15px rgba(255, 255, 255, 0.4);
    transition: all 0.4s ease, transform 0.4s ease;
    animation: fadeTranslateUp 1.6s ease forwards;
}

#cta .btn-cta:hover {
    background-color: #365f7e;
    color: #fff;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(54, 95, 126, 0.7);
}


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

#galerie {
    background: linear-gradient(135deg, #fefefe 30%, #d4a373 100%);
    border-radius: 20px;
    padding: 4rem 2rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

#galerie h2 {
    font-size: 2.8rem;
    color:rgba(12, 125, 238, 0.62);
    text-shadow: 1px 1px 6px #e2d9cd;
    animation: fadeTranslateUp 1s ease forwards;
}

.glass-card {
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    overflow: hidden;
}

.glass-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(212, 163, 115, 0.4);
}

.img-hover-effect {
    transition: transform 0.5s ease, filter 0.5s ease;
    object-fit: cover;
    width: 100%;
    height: 250px;
}

.img-hover-effect:hover {
    transform: scale(1.08);
    filter: brightness(1.15) contrast(1.1);
}

.img-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255,255,255,0.05);
    transition: background 0.4s ease;
    z-index: 1;
}

.glass-card:hover .img-overlay {
    background: rgba(255,255,255,0.12);
}

.card-body {
    padding: 1.8rem 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    color: #4a4a4a;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.card-text {
    color: #5a5a5a;
    font-size: 1rem;
    margin-bottom: 1.5rem;
}

.btn-animated {
    background-color: #d4a373;
    border: none;
    color: #fff;
    font-weight: 600;
    padding: 0.65rem 2rem;
    border-radius: 50px;
    box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
    transition: all 0.3s ease;
}

.btn-animated:hover {
    background-color: #c18b5c;
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(193, 139, 92, 0.6);
}

@keyframes fadeTranslateUp {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
}

.animate-card {
    opacity: 0;
    animation: fadeTranslateUp 1s ease forwards;
}

.row.justify-content-center > div:nth-child(1) { animation-delay: 0.1s; }
.row.justify-content-center > div:nth-child(2) { animation-delay: 0.3s; }
.row.justify-content-center > div:nth-child(3) { animation-delay: 0.5s; }

@media (max-width: 768px) {
    #galerie h2 {
        font-size: 2.2rem;
    }
    .card-title {
        font-size: 1.1rem;
    }
    .card-text {
        font-size: 0.95rem;
    }
}
.form-check-input {
    appearance: auto !important; 
    -webkit-appearance: checkbox !important;
    background-color: initial !important;
    border: 1px solid #ccc !important;
    width: 1.2em;
    height: 1.2em;
    cursor: pointer;
}



</style>
@endpush
