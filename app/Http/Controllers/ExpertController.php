<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expert;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expert = Expert::first();
        return view('experts.index', compact('expert'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'photo' => 'nullable|string', // Ou 'image' si upload
            'experience' => 'nullable|string',
            'films' => 'nullable|string',
            'imdb_link' => 'nullable|url',
        ]);

        Expert::create($validated);

        return redirect()->route('experts.index')->with('success', 'Expert ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expert $expert)
    {
        return view('experts.show', compact('expert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expert $expert)
    {
        return view('admin.experts.edit', compact('expert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expert $expert)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'titre' => 'required|string|max:255',
        'photo' => 'nullable|string', // ou 'image' si upload
        'experience' => 'nullable|string',
        'films' => 'nullable|string',
        'imdb_link' => 'nullable|url',
    ]);

    $expert->update($validated);

    return redirect()->route('admin.dashboard')->with('success', 'Expert mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expert $expert)
    {
        $expert->delete();

        return redirect()->route('experts.index')->with('success', 'Expert supprimé avec succès.');
    }
}
