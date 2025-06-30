@extends('layouts.app')

@section('title', $blog->titre)

@section('content')
<div class="container py-5 animate-fade-in" style="min-height: 80vh;">

    <h1 class="mb-4 text-center text-primary fw-bold shadow-sm" style="text-shadow: 2px 2px 5px rgba(0,0,0,0.2);">
        {{ $blog->titre }}
    </h1>

    @if($blog->image)
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->titre }}" 
                 class="img-fluid rounded shadow blog-image">
        </div>
    @endif

    <div class="blog-content mx-auto mb-4 shadow">
        {!! nl2br(e($blog->contenu)) !!}
    </div>

    <div class="text-center">
        <a href="{{ url('/blogs') }}" class="btn btn-return shadow">← Retour au blog</a>
    </div>
</div>
@endsection

@push('styles')
<style>
body {
    background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}


@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
}

.animate-fade-in {
    animation: fadeInUp 0.8s ease forwards;
}


.blog-image {
    max-height: 400px;
    width: 100%;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}


.blog-content {
    background: rgba(255, 255, 255, 0.85);
    padding: 25px 30px;
    border-radius: 20px;
    max-width: 900px;
    font-size: 1.2rem;
    line-height: 1.8;
    color: #444;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}


.btn-return {
    background-color: #87CEEB;
    color: #003f63;
    border: none;
    padding: 12px 30px;
    border-radius: 30px;
    font-weight: bold;
    transition: all 0.4s ease;
    display: inline-block;
}

.btn-return:hover {
    background-color: #D4A373;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(212, 163, 115, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .blog-content {
        padding: 20px 15px;
        font-size: 1rem;
    }
    .btn-return {
        width: 100%;
        font-size: 1.1rem;
        padding: 14px 0;
        text-align: center;
    }
}
</style>
@endpush
