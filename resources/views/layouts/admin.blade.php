<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Barre latérale -->
        <div class="bg-dark text-white p-3" style="width: 250px;">
            <h4>Menu Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Cours</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">TP</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Élèves</a></li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="flex-grow-1 p-4" style="background: linear-gradient(to bottom, #ffffff, #e0f7fa);">
            @yield('content') <!-- Le contenu change ici selon la page -->
        </div>
    </div>
</body>
</html>
