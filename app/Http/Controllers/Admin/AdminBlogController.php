<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    // Affiche la liste des articles
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.index', compact('blogs'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('admin.blog.form', ['blog' => new Blog()]);
    }

    // Enregistre un nouvel article
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Blog::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'image' => $imagePath,
            'slug' => \Str::slug($request->titre),
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Article ajouté !');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.form', compact('blog'));
    }

    // Met à jour l'article
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required',
            'contenu' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $blog->image = $imagePath;
        }

        $blog->titre = $request->titre;
        $blog->contenu = $request->contenu;
        $blog->slug = \Str::slug($request->titre);
        $blog->save();

        return redirect()->route('admin.blog.index')->with('success', 'Article mis à jour !');
    }

    // Supprime un article
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Article supprimé !');
    }
}
