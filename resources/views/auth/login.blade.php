
@extends('layouts.guest')

@section('title', 'Connexion')

@push('styles')
<style>
body {
    background: linear-gradient(135deg, #D4A373 20%, #87CEEB 80%);
    font-family: 'Poppins', sans-serif;
    font-size: 1.05rem;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 0;
}

.login-container {
    max-width: 480px;
    width: 90%;
    margin: 60px auto;
    background: rgba(255, 255, 255, 0.90);
    border-radius: 20px;
    padding: 40px 30px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(6px);
    animation: fadeInUp 1s ease-out forwards;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.login-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}


@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}


h2 {
    color: #0077B6;
    font-weight: 700;
    text-align: center;
    margin-bottom: 25px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.15);
}


input.form-control {
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid #90e0ef;
    border-radius: 12px;
    color: #023e8a;
    transition: all 0.3s ease;
}

input.form-control:focus {
    border-color: #0077B6;
    box-shadow: 0 0 12px rgba(0, 119, 182, 0.4);
}


label.form-label {
    font-weight: 600;
    color: #0077B6;
}


.btn-primary {
    background: linear-gradient(120deg, #87CEEB 0%, #D4A373 100%);
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 12px 25px;
    border-radius: 30px;
    box-shadow: 0 8px 20px rgba(0, 119, 182, 0.3);
    transition: all 0.4s ease;
}

.btn-primary:hover {
    background: linear-gradient(120deg, #D4A373 0%, #87CEEB 100%);
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(212, 163, 115, 0.4);
}


a.text-decoration-none {
    color: #0077B6;
    font-weight: 500;
    transition: color 0.3s ease;
}

a.text-decoration-none:hover {
    color: #D4A373;
    text-decoration: underline;
}


.form-check-label {
    color: #555;
}


@media (max-width: 576px) {
    .login-container {
        padding: 30px 20px;
    }
    h2 {
        font-size: 1.6rem;
    }
    .btn-primary {
        padding: 10px 20px;
        font-size: 0.95rem;
    }
    input.form-control {
        font-size: 0.95rem;
    }
}
</style>
@endpush

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 70vh;">
        <div class="login-container">

            
            @if (session('status'))
                <div class="alert alert-info text-center fw-bold" style="background-color: rgba(212, 163, 115, 0.6); color: #fff;">
                    {{ session('status') }}
                </div>
            @endif

            <h2>Connexion</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                     <input class="form-check-input" type="checkbox" name="rgpd" id="rjpd" required>
                     <lable class="form-check-label" for="rjpd" >
                         j'accepte la <a href="{{route('confidentialite')}}">politique de confidentialité. </a>
                     <label>
                </div>

                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Se souvenir de moi
                    </label>
                </div>

                
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-none small" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
