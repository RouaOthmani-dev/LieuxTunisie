@extends('layouts.app')
@section('title','politique de confidentialite')
@section('content')
<div  class="container py-5">
    {{-- boutton retour dynamique --}}
     <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
        ← Retour à la page précédente
    </a>
    <h1 class="mb-4 text-primary fw-bold">politique de confidentialité</h1>
    <p>
        Nous respectons votre vie privé.les informations que vous fournir(nom,email,etc.) sont utilise uniquement pour vous contacter ou vous fournir les services demendés((formulaire de contact, demande de devis, etc.).
    </p>
    <p>
        Nous ne partageons jamais vos données avec des tiers sans votre consentement. Vous avez le droit d’accéder à vos données, de les corriger ou de demander leur suppression.
    </p>
    <p>
         En utilisant ce site, vous acceptez notre politique de confidentialité.
    </p> 
</div>
@endsection

