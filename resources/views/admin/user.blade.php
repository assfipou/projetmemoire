@extends('layouts.app')
@section('title', 'Gestion des utilisateurs')
@section('content')
<div class="d-flex" style="min-height: 100vh;">
        <!-- Barre latérale -->
        <div class="bg-dark text-white p-3" style="width: 250px;">
            <h2>Menu Admin</h2>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="dashboard">Tableau de bord</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="">Simulations</a></li>
               <li class="nav-item">
    <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
        Gestion des Utilisateurs
    </a>
</li>

               </ul>
        </div>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
           
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Etablissement</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->dateNaissance }}</td>
            <td>{{ $user->email }}</td> 
             <td>{{ $user->role }}</td>
             <td>{{ $user->adresse }}</td>
          
            
            <td>
               
               
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Confirmer la suppression ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
