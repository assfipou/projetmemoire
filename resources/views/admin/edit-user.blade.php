@extends('layouts.app') {{-- ou ton layout principal --}}

@section('content')
<div class="container">
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
        <h1>Modifier l'utilisateur</h1>

        
         
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
                 <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" name="prenom" value="{{ $user->prenom }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" value="{{ $user->nom }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label"> Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="dateNaissance" class="form-label">Date de Naissance</label>
            <input type="text" name="dateNaissance" value="{{ $user->dateNaissance }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Etablissement</label>
            <input type="text" name="adresse" value="{{ $user->adresse }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" class="form-select">
                <option value="eleve" {{ $user->role == 'eleve' ? 'selected' : '' }}>Élève</option>
                <option value="professeur" {{ $user->role == 'professeur' ? 'selected' : '' }}>Professeur</option>
                
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
