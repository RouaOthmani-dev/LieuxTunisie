<?php
// Ouvre le fichier PHP

namespace App\Http\Controllers;
// Déclare l'espace de nom du contrôleur

use App\Models\Lieu;
// On utilise le modèle 'Lieu' pour interagir avec la table 'lieux'

use Illuminate\Http\Request;
// Permet d'utiliser les requêtes HTTP si besoin (utile pour récupérer des données depuis l’utilisateur)

class AccueilController extends Controller
// Déclare une classe nommée AccueilController qui hérite de la classe de base 'Controller' de Laravel
{
        public function index()
    {
        $lieux = Lieu::with('categorie')->get(); // charge les catégories avec les lieux
        $lieuxVedettes = Lieu::with('categorie')->where('vedette', true)->take(6)->get();

       return view('accueil.index', compact('lieux', 'lieuxVedettes'));

    }
}
