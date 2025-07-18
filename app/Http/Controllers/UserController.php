<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;

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
        return view('admin.partials.edit-user-content', compact('user'));
    }

    // Mise à jour des informations d'un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'dateNaissance' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'adresse' => 'required|string|max:255',
            'role' => 'required|string|in:professeur,eleve,admin',
        ]);

        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'dateNaissance' => $request->dateNaissance,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'role' => $request->role,
        ]);

        

        return redirect()->route('pageadmin')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Suppression d'un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        
        // Vérifier si c'est une requête AJAX
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès.'
            ]);
        }
        
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
            fputcsv($handle, ['Nom', 'Prénom', 'Date de naissance', 'Email', 'Rôle', 'Établissement']);

            // Lignes de données
            foreach (User::all() as $user) {
                fputcsv($handle, [
                    $user->nom,
                    $user->prenom,
                    $user->dateNaissance ? \Carbon\Carbon::parse($user->dateNaissance)->format('d/m/Y') : 'Non spécifié',
                    $user->email,
                    $user->role,
                    $user->adresse,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
