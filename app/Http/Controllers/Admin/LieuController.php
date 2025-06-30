<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lieu;
use App\Models\Categorie; 
use Illuminate\Http\Request;

class LieuController extends Controller
{
    public function index()
    {
        $lieux = Lieu::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lieux.index', compact('lieux'));
    }

    public function create()
    {
        $categories = Categorie::all(); 
        return view('admin.lieux.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',
            'region' => 'required|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'vedette' => 'nullable|boolean',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('lieux_images', 'public');
        }

        // Si la checkbox vedette n'est pas cochée, elle vaut false
        $data['vedette'] = $request->has('vedette');

        Lieu::create($data);

        return redirect()->route('admin.lieux.index')->with('success', 'Lieu ajouté avec succès.');
    }

    public function edit(Lieu $lieu)
    {
        $categories = Categorie::all(); 
        return view('admin.lieux.edit', compact('lieu', 'categories'));
    }

   public function update(Request $request, Lieu $lieu)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'categorie_id' => 'required|exists:categories,id',
        'region' => 'required|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
        'vedette' => 'nullable|boolean',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('lieux_images', 'public');
    }

    $data['vedette'] = $request->has('vedette');

    $lieu->update($data);

    return redirect()->route('admin.lieux.index')->with('success', 'Lieu modifié avec succès.');
}

public function destroy(Lieu $lieu)
{
    $lieu->delete();
    return redirect()->route('admin.lieux.index')->with('success', 'Lieu supprimé avec succès.');
}

}
