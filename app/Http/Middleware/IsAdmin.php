<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // pour vérifier si l'utilisateur est connecté

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté ET s'il est admin (colonne is_admin = true)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // il est admin → passe vers la page demandée
        }

        // Sinon → on le bloque et on le redirige vers l'accueil avec un message d'erreur
        return redirect('/')->with('error', "Accès réservé aux administrateurs.");
    }
}
