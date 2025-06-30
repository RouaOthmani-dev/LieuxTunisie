<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // <-- changement ici

class ContactController extends Controller
{
    // Affiche la page formulaire de contact
    public function show()
    {
        return view('contact'); // View utilisateur (frontend)
    }

    // Traite la soumission du formulaire
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated); // 
        return redirect()->back()->with('success', 'Votre message a bien été envoyé, merci !');
    }


    // Affiche tous les messages (index)
    public function index()
    {
        $messages = Contact::latest()->paginate(10); 
        return view('admin.contact.index', compact('messages'));
    }

    // Affiche le détail d'un message spécifique (show)
    public function showMessage($id)
    {
        $message = Contact::findOrFail($id); 
        return view('admin.contact.show', compact('message'));
    }

    // Affiche le formulaire d'édition d'un message (edit)
    public function edit($id)
    {
        $message = Contact::findOrFail($id); 
        return view('admin.contact.edit', compact('message'));
    }

    // Met à jour un message existant (update)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Contact::findOrFail($id); 
        $message->update($validated);

        return redirect()->route('admin.contact.index')->with('success', 'Message mis à jour avec succès.');
    }

    // Supprime un message (destroy)
    public function destroy($id)
    {
        $message = Contact::findOrFail($id); 
        $message->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Message supprimé avec succès.');
    }
}
