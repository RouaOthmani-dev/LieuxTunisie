@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    }

    .table-image {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 0 5px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }

    .table-image:hover {
        transform: scale(1.1);
    }

    .action-btn {
        display: inline-block;
        font-size: 1.4rem;
        padding: 6px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: transparent;
        border: none;
    }

    .action-btn.edit { color: #0d6efd; }
    .action-btn.edit:hover { color: #084298; transform: scale(1.15); }
    .action-btn.delete { color: #dc3545; }
    .action-btn.delete:hover { color: #a71d2a; transform: scale(1.15); }

    .btn-retour {
        font-size: 1rem;
        padding: 10px 20px;
        background-color: rgba(13, 109, 253, 0.66);
        color: white;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-retour:hover {
        background-color: rgb(125, 170, 237);
        transform: scale(1.05);
    }

    .btn-retour .arrow {
        font-size: 1.5rem;
    }

    .btn-ajouter {
        font-size: 1.1rem;
        padding: 10px 20px;
        background-color: #198754;
        color: white;
        border-radius: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .btn-ajouter:hover {
        background-color: #146c43;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .action-btn { font-size: 1.2rem; padding: 4px 8px; }
        .table-image { width: 30px; height: 30px; }
        .btn-retour, .btn-ajouter { width: 100%; text-align: center; justify-content: center; }
    }
</style>

<div class="container mx-auto px-2 py-4">
    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800 text-center">
        Gestion des Lieux de Tournage
    </h2>

    
    <div class="flex justify-start mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn-retour">
            <span class="arrow">⬅️</span> Retour au Dashboard
        </a>
    </div>

    <div class="flex justify-center mb-6">
        <a href="{{ route('admin.lieux.create') }}" class="btn-ajouter">
            + Ajouter un nouveau lieu
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded mb-4 text-center text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-left table-auto">
            <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                <tr>
                    <th class="py-2 px-2 text-center">ID</th>
                    <th class="py-2 px-2">Nom</th>
                    <th class="py-2 px-2">Catégorie</th>
                    <th class="py-2 px-2 hidden md:table-cell">Région</th>
                    <th class="py-2 px-2 hidden lg:table-cell">Adresse</th>
                    <th class="py-2 px-2 text-center">Latitude</th>
                    <th class="py-2 px-2 text-center">Longitude</th>
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
                        <td class="py-2 px-2 text-center">{{ $lieu->latitude ?? '-' }}</td>
                        <td class="py-2 px-2 text-center">{{ $lieu->longitude ?? '-' }}</td>
                        <td class="py-2 px-2 text-center">
                            <span class="{{ $lieu->vedette ? 'text-green-600 font-semibold' : 'text-red-500' }}">
                                {{ $lieu->vedette ? 'Oui' : 'Non' }}
                            </span>
                        </td>
                        <td class="py-2 px-2 text-center">
                            @if($lieu->image)
                                <img src="{{ asset('storage/' . $lieu->image) }}" alt="Image" class="table-image" />
                            @else
                                <span class="text-gray-400 text-xs">Aucune</span>
                            @endif
                        </td>
                        <td class="py-2 px-2 text-center space-x-2">
                            <a href="{{ route('admin.lieux.edit', $lieu) }}" class="action-btn edit" title="Modifier">✏️</a>
                            <form action="{{ route('admin.lieux.destroy', $lieu) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr ?')" class="action-btn delete" title="Supprimer">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="py-4 px-2 text-center text-gray-500">Aucun lieu trouvé.</td>
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
