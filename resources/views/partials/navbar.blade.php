<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Lab🧪Terminale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center me-5" href="#">
            <img src="{{ asset('images/labterminale.jpg') }}" alt="Logo" width="40" class="me-2">
            <strong>Lab🧪Terminale</strong>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto d-flex align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-uppercase text-dark" href="{{ route('accueil') }}">
                        <i class="bi bi-house-door me-1"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-uppercase text-dark" href="{{ route('simulation') }}">
                        <i class="bi bi-flask me-1"></i> Simulation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-uppercase text-dark" href="{{ route('visualisation') }}">
                        <i class="bi bi-cube me-1"></i> Visualisation 3D
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-uppercase text-dark" href="{{ route('quizz') }}">
                        <i class="bi bi-question-circle me-1"></i> Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-uppercase text-dark" href="{{ route('faq') }}">
                        <i class="bi bi-envelope me-1"></i> FAQ
                    </a>
                </li>
            </ul>
            
            <a href="{{ route('register') }}" class="bg-blue-600 btn btn-light hover:bg-blue-700 font-semibold py-2 px-4 rounded-lg shadow">
                Se connecter/S'inscrire
            </a>
        </div>
    </div>
</nav>


