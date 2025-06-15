<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title', 'Lieux de tournage en Tunisie')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Vite (Laravel) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Bootstrap & Google Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

        <!-- AOS Animate On Scroll CSS -->
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

        <style>
            body {
                background: linear-gradient(135deg, #1096E3 0%, #fceabb 100%);
                font-family: 'Poppins', sans-serif;
                color: #fff;
                min-height: 100vh;
                margin: 0;
                padding: 0;
                overflow-x: hidden;
            }

            .custom-navbar {
                background: rgba(0, 0, 0, 0.22);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                transition: background-color 0.5s ease;
            }

            .custom-navbar a {
                color: #fff !important;
                font-weight: 600;
                transition: color 0.3s, transform 0.3s;
            }

            .custom-navbar a:hover {
                color: rgb(250, 165, 95) !important;
                transform: scale(1.05);
            }

            .container {
                max-width: 1600px;
                background: rgba(0, 0, 0, 0.06);
                padding: 40px;
                border-radius: 16px;
                box-shadow: 0 12px 30px rgba(255, 255, 255, 0.24);
                margin: 40px auto;
                animation: fadeIn 1s ease-out;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #fff;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .carousel-item img {
                max-height: 500px;
                width: 100%;
                object-fit: cover;
                border-radius: 12px;
                box-shadow: 0 6px 16px rgba(0,0,0,0.4);
                transition: transform 0.4s ease;
            }

            .carousel-item img:hover {
                transform: scale(1.03);
            }

            .btn-logout {
                border: none;
                background: none;
                color: #e63946;
                cursor: pointer;
                font-weight: bold;
                transition: color 0.3s, transform 0.3s;
            }

            .btn-logout:hover {
                color: #b71c1c;
                transform: scale(1.1);
            }

            .btn {
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: scale(1.05);
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            }

            /* Section spécifique Lieux de Tournage */
            .cinema-section {
                background-color: #000;
                color: #fff;
                padding: 60px 20px;
                text-align: center;
                margin-top: 60px;
            }

            .cinema-section h2 {
                font-size: 2.5rem;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            .cinema-section p {
                font-size: 1.2rem;
                max-width: 800px;
                margin: 0 auto;
                line-height: 1.8;
            }
        </style>
    </head>

    <body class="font-sans antialiased">


        @include('layouts.navbar')

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="container mt-4">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </div>
        </div>

        <!-- Section Personnalisée : Lieux de Tournage -->
        <section class="cinema-section">
            <h2>Des lieux de tournage uniques en Tunisie</h2>
            <p>
                Explorez une sélection exclusive de sites naturels et urbains pour vos projets audiovisuels et photographiques.
                Bénéficiez d'un accompagnement professionnel pour concrétiser vos idées dans des décors authentiques.
            </p>
            <p>
                Que ce soit pour un film, une publicité, un shooting photo ou un documentaire, la Tunisie offre une palette exceptionnelle de paysages et d'ambiances.
            </p>
        </section>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1200,
            });
        </script>
    </body>
</html>
