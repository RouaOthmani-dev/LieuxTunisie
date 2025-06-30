@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container py-5 animate-fade" style="min-height: 80vh;">
    <h1 class="text-center mb-5 fw-bold fade-in-title" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.3);">
        Nos Derniers Articles
    </h1>

    @if($blogs->isEmpty())
        <div class="alert alert-info text-center fw-bold fs-5 animate-fade-in" style="background-color: rgba(212, 163, 115, 0.6); color: #fff;">
            Aucun article n'a été publié pour le moment.
        </div>
    @else
        <div class="row justify-content-center">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                    <div class="card blog-card shadow animate-fade-in h-100">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->titre }}">
                        @else
                            <img src="{{ asset('images/default-blog.jpg') }}" class="card-img-top" alt="Image par défaut">
                        @endif

                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold text-primary">{{ $blog->titre }}</h5>
                            <p class="card-text text-muted" style="flex-grow:1;">{{ Str::limit($blog->contenu, 120) }}</p>
                        </div>
                        <div class="card-footer bg-transparent text-center pb-3">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-animated rounded-pill px-4 shadow-sm">
                                Lire l'article
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
body {
    background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    font-size: 1.1rem;
}

footer {
    background-color: #fff !important;
    color: #333;
    border-top: 1px solid #ccc;
    padding: 20px 10px;
    text-align: center;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
}

/* Animation fade */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeInUp 1s ease forwards;
}

.fade-in-title {
    animation: fadeInUp 1s ease forwards;
    color: #003f63;
    font-size: 2.5rem;
}

/* Card style transparent et moderne */
.blog-card {
    background: rgba(255, 255, 255, 0.75);
    border: 1px solid rgba(0, 119, 182, 0.2);
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.4s, box-shadow 0.4s;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 119, 182, 0.3);
}

/* Image */
.blog-card img {
    height: 220px;
    object-fit: cover;
    border-bottom: 2px solid rgba(0,119,182,0.2);
}

/* Bouton harmonisé */
.btn-animated {
    background-color: #87CEEB;
    border: none;
    color: #003f63;
    font-weight: bold;
    transition: all 0.4s ease;
    border-radius: 30px;
}

.btn-animated:hover {
    background-color: #D4A373;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(212, 163, 115, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .fade-in-title { font-size: 2rem; }
    .card-title { font-size: 1.2rem; }
    .card-text { font-size: 0.95rem; }
    .btn-animated { padding: 8px 20px; font-size: 0.9rem; }
}
</style>
@endpush
