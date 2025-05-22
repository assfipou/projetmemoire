@extends('layouts.app')  <!-- Utilisation de app.blade.php comme layout -->

@section('title', 'Page admin')

@section('content')
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Barre latérale -->
        <div class="bg-dark text-white p-3" style="width: 250px;">
            <h4>Menu Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="dashboard">Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="">Simulations</a></li>
               <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
        Gestion des Utilisateurs
    </a>


           
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="flex-grow-1 p-4" style="background: linear-gradient(to bottom, #ffffff, #e0f7fa);">
            <h1>Tableau de bord Admin</h1>
       <div class="d-flex gap-3 mt-3 ms-3">
  <a href="dashboard" class="text-decoration-none">
    <div class="border rounded d-flex align-items-center justify-content-center text-white fw-bold"
         style="width: 200px; height: 90px; background-color: #34db8d;">
      Tableau de bord
    </div>
  </a>
  <a href="users" class="text-decoration-none">
    <div class="border rounded d-flex align-items-center justify-content-center text-white fw-bold"
         style="width: 200px; height: 90px; background-color: #ccc92e;">
      Simulations
    </div>
  </a>
     <a class="text-decoration-none" href="{{ route('admin.users.index') }}">
        <div class="border rounded d-flex align-items-center justify-content-center text-white fw-bold"
             style="width: 200px; height: 90px; background-color: #f94525;">
        Gestion des Utilisateurs
        </div>
</div>


        </div>
        <!-- Inclure jQuery pour faciliter l'AJAX -->
          
    </div>
@endsection
