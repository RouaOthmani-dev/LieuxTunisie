@extends('layouts.app')

@section('title', 'Gestion des articles')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.8);
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        width: 95%;
        max-width: 1000px;
        margin: 50px auto;
        animation: fadeIn 1s ease;
        backdrop-filter: blur(4px); 
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 2rem;
    }

    .btn-add, .btn-dashboard {
        display: inline-block;
        background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        margin: 10px 5px;
        transition: transform 0.3s, box-shadow 0.3s;
        font-size: 1rem;
    }

    .btn-add:hover, .btn-dashboard:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 1rem;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 14px;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #f7f7f7;
        color: #555;
        font-weight: bold;
        font-size: 1.1rem;
    }

    tr:hover {
        background-color: #f0f8ff;
        transition: background-color 0.3s;
    }

    img {
        border-radius: 8px;
        max-width: 120px;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #fff;
        padding: 7px 15px;
        border-radius: 6px;
        text-decoration: none;
        transition: transform 0.3s;
        display: inline-block;
        font-size: 0.95rem;
    }

    .btn-edit:hover {
        transform: scale(1.07);
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
        padding: 7px 15px;
        border: none;
        border-radius: 6px;
        transition: transform 0.3s;
        cursor: pointer;
        font-size: 0.95rem;
    }

    .btn-delete:hover {
        transform: scale(1.07);
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        padding: 12px 18px;
        border-radius: 8px;
        color: #155724;
        margin-bottom: 20px;
        text-align: center;
        font-size: 1rem;
    }

    .btn-container {
        text-align: center;
        margin-bottom: 20px;
    }

</style>

<div class="table-container">
    <h1>Gestion des articles du Blog</h1>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="btn-container">
        <a href="{{ route('admin.dashboard') }}" class="btn-dashboard">← Retour au Dashboard</a>
        <a href="{{ route('admin.blog.create') }}" class="btn-add">+ Ajouter un article</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->titre }}</td>
                <td>
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->titre }}">
                    @else
                        Aucun
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn-edit">Modifier</a>

                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
