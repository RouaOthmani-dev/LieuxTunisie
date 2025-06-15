<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experts=Expert::all();
        return view('expert.index',compact('experts'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $expert->delete();

        return redirect()->route('experts.index')->with('success', 'Expert supprimé avec succès.');
    
    }
}
