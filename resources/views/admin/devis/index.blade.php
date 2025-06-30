@extends('layouts.app')

@section('title', 'Gestion des Demandes de Devis')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .devis-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        width: 95%;
        max-width: 1100px;
        margin: 50px auto;
        animation: fadeIn 1s ease;
        backdrop-filter: blur(5px);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .btn-dashboard {
        display: inline-block;
        margin-bottom: 25px;
        padding: 10px 25px;
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.3s, box-shadow 0.3s;
        font-size: 1rem;
    }

    .btn-dashboard:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .alert {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 1rem;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px 10px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
        font-size: 1.05rem;
    }

    tr:hover {
        background-color: #f0f8ff;
        transition: background-color 0.3s;
    }

    .btn-primary {
        background-color: #36b9cc;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
        transition: transform 0.3s, background-color 0.3s;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background-color: #2c9faf;
    }

    .btn-danger {
        background-color: #e74a3b;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        color: white;
        transition: transform 0.3s, background-color 0.3s;
        cursor: pointer;
    }

    .btn-danger:hover {
        transform: scale(1.05);
        background-color: #c0392b;
    }

    @media screen and (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            display: none;
        }

        tbody tr {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        td {
            text-align: right;
            padding-left: 50%;
            position: relative;
            font-size: 0.95rem;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            width: 45%;
            padding-left: 5px;
            font-weight: bold;
            color: #555;
            text-align: left;
        }
    }
</style>

<div class="devis-container">
    <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">← Retour au dashboard</a>

    <h1>Liste des Demandes de Devis</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($devis->isEmpty())
        <div class="alert alert-info">Aucune demande de devis pour le moment.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Nb Jours</th>
                    <th>Lieu recherché</th>
                    <th>Budget</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devis as $d)
                    <tr>
                        <td data-label="ID">{{ $d->id }}</td>
                        <td data-label="Nom">{{ $d->nom ?? 'N/A' }}</td>
                        <td data-label="Email">{{ $d->email ?? 'N/A' }}</td>
                        <td data-label="Nb Jours">{{ $d->nb_jours }}</td>
                        <td data-label="Lieu">{{ $d->lieu_recherche }}</td>
                        <td data-label="Budget">{{ number_format($d->budget, 2) }} TND</td>
                        <td data-label="Date">{{ $d->created_at->format('d/m/Y H:i') }}</td>
                        <td data-label="Actions">
                            <a href="{{ route('admin.devis.show', $d->id) }}" class="btn btn-primary btn-sm">Voir</a>
                            <form action="{{ route('admin.devis.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce devis ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
