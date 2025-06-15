<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // Affiche la page/contact form (si tu veux une page dédiée)
    public function show()
    {
        return view('contact'); // Crée la vue resources/views/contact.blade.php
    }

    // Traite la soumission du formulaire contact
    public function submit(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Enregistrer le message dans la base
        ContactMessage::create($validated);

        // Retour avec message de succès
        return redirect()->back()->with('success', 'Votre message a bien été envoyé, merci !');
    }
}
