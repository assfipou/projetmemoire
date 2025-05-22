<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simulation; // ou le modèle que tu veux rechercher
use App\Models\User; // ou le modèle que tu veux rechercher


class RechercheController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Exemple de recherche sur une table "experiences"
        $resultats = user::where('titre', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        return view('resultats', compact('resultats', 'query'));
    }
}
