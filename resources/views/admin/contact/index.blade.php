@extends('layouts.app')

@section('title', 'Messages de Contact')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .contact-container {
        background: rgba(255, 255, 255, 0.85);
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

    .btn-back {
        display: inline-block;
        background: linear-gradient(45deg, #ff416c 0%, #ff4b2b 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        margin-bottom: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        font-size: 1rem;
    }

    .btn-back:hover {
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

    .btn-info {
        background-color: #36b9cc;
        border: none;
        padding: 7px 12px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
        transition: transform 0.3s, background-color 0.3s;
        display: inline-block;
    }

    .btn-info:hover {
        transform: scale(1.1);
        background-color: #2c9faf;
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
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

<div class="contact-container">
    <h1>Messages de Contact</h1>

    <a href="{{ route('admin.dashboard') }}" class="btn-back">← Retour au Dashboard</a>

    @if($messages->isEmpty())
        <p style="text-align:center; color:#555;">Aucun message reçu.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom / Prénom</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td data-label="ID">{{ $message->id }}</td>
                    <td data-label="Nom / Prénom">{{ $message->nom_prenom }}</td>
                    <td data-label="Email">{{ $message->email }}</td>
                    <td data-label="Date">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td data-label="Actions">
                        <a href="{{ route('admin.contact.show', $message->id) }}" class="btn btn-info btn-sm">Voir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
