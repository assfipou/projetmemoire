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
            
            <a href="{{ route('registerPage') }}" class="bg-blue-600 btn btn-light hover:bg-blue-700 font-semibold py-2 px-4 rounded-lg shadow">
                Se connecter/S'inscrire
            </a>
        </div>
    </div>
</nav>


    <!-- Header -->
    <div class="header-bg text-center">
        <div class="container">
            <h1 class="display-4">Bienvenue sur notre Laboratoire Virtuel de Chimie pour la classe de terminale</h1>
            <p class="lead">Apprenez, explorez et experimentez la chimie depuis chez vous !</p>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="container container-text text-center mt-5">

        <!-- À propos -->
        <section class="py-5 text-center bg-white">
            <div class="container">
                <h2 class="mb-4">À propos de nous</h2>
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="text-primary">🎯 Notre Mission</h4>
                        <p>Offrir un espace numérique interactif pour permettre aux élèves d’apprendre la chimie en toute sécurité et à leur rythme.</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-primary">🌟 Notre Vision</h4>
                        <p>Rendre l’apprentissage scientifique plus attractif, accessible et inclusif grâce aux technologies numériques.</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-primary">📌 Nos Objectifs</h4>
                        <p>Développer des compétences pratiques, stimuler la curiosité scientifique et renforcer la compréhension des notions de chimie.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 text-center bg-light">
            <div class="container">
                <div class="row">
                    <!-- Simulation -->
                    <div class="col-md-4">
                        <i class="bi bi-flask display-4 text-primary"></i>
                        <div class="mt-3">
                            <img src="{{ asset('images/simulation.png') }}" alt="Simulation" class="img-fluid rounded" style="height: 200px;">
                        </div>
                        <h4 class="mt-3">Simulations</h4>
                        <p>Réalisez des expériences chimiques en toute sécurité.</p>
                    </div>
        
                    <!-- Visualisation 3D -->
                    <div class="col-md-4">
                        <i class="bi bi-cube display-4 text-success"></i>
                        <div class="mt-3">
                            <img src="{{ asset('images/visualisation3d.png') }}" alt="Visualisation 3D" class="img-fluid rounded" style="height: 200px;">
                        </div>
                        <h4 class="mt-3">Visualisation3D</h4>
                      
                        

                        <p>Observez des molécules et réactions en trois dimensions.</p>
                    </div>
        
                    <!-- Quiz -->
                    <div class="col-md-4">
                        
                        <div class="mt-3">
                            <img src="{{ asset('images/quiz.jpg') }}" alt="Quiz" class="img-fluid rounded" style="height: 200px;">
                        </div>
                        <h4 class="mt-3">Quiz</h4>
                        <p>Testez vos connaissances en chimie avec des quiz interactifs.</p>
                    </div>
                </div>
            </div>
        </section>
        

        <!-- Réseaux sociaux -->
        <section class="py-5 text-center bg-white">
            <div class="container">
                <h2>Suivez-nous sur les réseaux sociaux</h2>
                <p class="lead">Restez informé des dernières nouvelles et mises à jour en nous suivant sur nos réseaux sociaux.</p>
                <a href="#" class="btn btn-primary"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="#" class="btn btn-info"><i class="bi bi-twitter"></i> Twitter</a>
                <a href="#" class="btn btn-danger"><i class="bi bi-instagram"></i> Instagram</a>
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; Lab🧪Terminale. Tous droits réservés.</p>
            <p><a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a></p>
        </div>
    </footer>

    <!-- Scripts propres -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            console.log("Bienvenue sur le Laboratoire Virtuel !");
        });
    </script>
</body>
</html>
