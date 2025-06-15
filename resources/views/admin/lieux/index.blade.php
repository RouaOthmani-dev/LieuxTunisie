@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-4">
    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 text-center">Gestion des Lieux de Tournage</h2>

    <!-- Bouton d'ajout centré -->
    <div class="flex justify-center mb-4">
        <a href="{{ route('admin.lieux.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-full shadow-md transition transform hover:scale-105">
            + Ajouter un lieu
        </a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4 text-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tableau Responsive -->
    <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-left table-auto">
            <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                <tr>
                    <th class="py-2 px-2 text-center">ID</th>
                    <th class="py-2 px-2">Nom</th>
                    <th class="py-2 px-2">Catégorie</th>
                    <th class="py-2 px-2 hidden md:table-cell">Région</th>
                    <th class="py-2 px-2 hidden lg:table-cell">Adresse</th>
                    <th class="py-2 px-2 text-center">Vedette</th>
                    <th class="py-2 px-2 text-center">Image</th>
                    <th class="py-2 px-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white text-gray-700">
                @forelse($lieux as $lieu)
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="py-2 px-2 text-center">{{ $lieu->id }}</td>
                        <td class="py-2 px-2 font-medium">{{ $lieu->nom }}</td>
                        <td class="py-2 px-2">{{ $lieu->categorie->nom ?? 'Non défini' }}</td>
                        <td class="py-2 px-2 hidden md:table-cell">{{ $lieu->region }}</td>
                        <td class="py-2 px-2 hidden lg:table-cell">{{ $lieu->adresse ?? '-' }}</td>
                        <td class="py-2 px-2 text-center">
                            <span class="{{ $lieu->vedette ? 'text-green-600 font-semibold' : 'text-red-500' }}">
                                {{ $lieu->vedette ? 'Oui' : 'Non' }}
                            </span>
                        </td>
                        <td class="py-2 px-2 text-center">
                            @if($lieu->image)
                                <div class="flex items-center justify-center space-x-2">
                                    <img src="{{ asset('storage/' . $lieu->image) }}" alt="Image" 
                                         class="w-8 h-8 object-cover rounded-full shadow">
                                </div>
                            @else
                                <span class="text-gray-400 text-xs">Aucune</span>
                            @endif
                        </td>
                        <td class="py-2 px-2 text-center space-x-1">
                            <a href="{{ route('admin.lieux.edit', $lieu) }}" 
                               class="text-blue-500 hover:text-blue-700 text-lg" 
                               title="Modifier">✏️</a>
                            <form action="{{ route('admin.lieux.destroy', $lieu) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr ?')"
                                        class="text-red-500 hover:text-red-700 text-lg" title="Supprimer">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-4 px-2 text-center text-gray-500">Aucun lieu trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center">
        {{ $lieux->links() }}
    </div>
</div>
@endsection
