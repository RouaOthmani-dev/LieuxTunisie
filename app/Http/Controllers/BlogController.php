<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // 1. Affiche la liste des articles
    public function index()
    {
        $blogs = Blog::all(); // récupère tous les articles
        return view('blog.index', compact('blogs')); // passe à la vue
    }

    // 2. Formulaire de création
    public function create()
    {
        return view('blog.create');
    }

    // 3. Enregistre un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Blog::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'image' => $imagePath,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Article ajouté !');
    }

    // 4. Affiche un article via son slug
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('blog'));
    }

    // 5. Formulaire d'édition
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    // 6. Mise à jour de l'article
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $blog = Blog::findOrFail($id);

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
            $blog->image = $imagePath;
        }

        $blog->titre = $request->titre;
        $blog->contenu = $request->contenu;
        $blog->slug = \Str::slug($request->titre);
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Article mis à jour !');
    }

    // 7. Supprime un article
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Article supprimé !');
    }
}
