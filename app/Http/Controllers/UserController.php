<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    // Afficher le formulaire d'édition
    public function edit(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    // Mise à jour des informations d'un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
           ' email' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'role' => 'required|string|in:professeur,eleve',
        ]);

        $user->update([
            'prenom' => $request->prenom,
            'nom'  => $request->nom,
            'dateNaissance' => $request->dateNaissance,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'role'       => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Suppression d'un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
    }

    // Activer un utilisateur
   

    // Export des utilisateurs au format CSV
    public function export(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="utilisateurs.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');

            // En-têtes
            fputcsv($handle, ['Nom', 'Prénom', 'Date de naissance', 'Email', 'Rôle', 'Statut']);

            // Lignes de données
            foreach (User::all() as $user) {
                fputcsv($handle, [
                    $user->last_name,
                    $user->first_name,
                    $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Non spécifié',
                    $user->email,
                    $user->role,
                    $user->active ? 'Actif' : 'Désactivé',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
