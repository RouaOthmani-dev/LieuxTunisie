@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profil utilisateur
    </h2>
@endsection

@section('content')
    <style>
        /* === Styles globaux pour la page profil === */

        body {
            background-color:linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        h2 {
            color: #1e293b;
        }

        h3 {
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 0.3rem;
            margin-bottom: 1rem;
            color: #1e293b;
        }

        section {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgb(0 0 0 / 0.05);
            border: 1px solid #e2e8f0;
            transition: box-shadow 0.3s ease;
        }

        section:hover {
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #334155;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #cbd5e1;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .error-message {
            color: #dc2626; /* rouge */
            font-size: 0.875rem;
        }

        button,
        input[type="submit"] {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-self: flex-start;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: #2563eb;
        }

        button.delete-account {
            background-color: #ef4444;
        }

        button.delete-account:hover {
            background-color: #b91c1c;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <section>
                <h3>Modifier les informations du profil</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <section>
                <h3>Changer le mot de passe</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <section>
                <h3 style="color: #dc2626;">Supprimer le compte</h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>
@endsection
