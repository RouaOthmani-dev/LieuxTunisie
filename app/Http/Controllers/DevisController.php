<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    // Partie Visiteur : Afficher le formulaire de demande de devis
    public function create()
    {
        return view('devis.create');
    }

    // Partie Visiteur : Traiter et enregistrer le formulaire
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'type_projet' => 'required|string',
            'nb_jours' => 'required|integer|min:1',
            'lieu_recherche' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'message' => 'nullable|string',
        ]);

        Devis::create($request->all());

        return redirect()->back()->with('success', 'Votre demande de devis a été envoyée avec succès.');
    }

    // Partie Admin : Lister tous les devis
    public function index()
    {
        $devis = Devis::all();
        return view('admin.devis.index', compact('devis'));
    }

    // Partie Admin : Afficher un devis précis
    public function show(Devis $devis)
    {
        return view('admin.devis.show', compact('devis'));
    }

    // Partie Admin : Supprimer un devis
    public function destroy(Devis $devis)
    {
        $devis->delete();
        return redirect()->route('admin.devis.index')->with('success', 'Le devis a été supprimé avec succès.');
    }
}

