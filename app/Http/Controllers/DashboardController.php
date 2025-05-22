<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
{
    // Nombre total d'élèves et de professeurs
    $elevesCount = User::where('role', 'eleve')->count();
    $profsCount = User::where('role', 'professeur')->count();

     // Nombre total d'élèves et de professeurs
    $elevesCount = User::where('role', 'eleve')->count();
    $profsCount = User::where('role', 'professeur')->count();
    // Élèves par adresse
    $elevesParAdresse = User::select('adresse', DB::raw('count(*) as total'))
        ->where('role', 'eleve')
        ->groupBy('adresse')
        ->get();

    // Professeurs par adresse
    $profsParAdresse = User::select('adresse', DB::raw('count(*) as total'))
        ->where('role', 'professeur') // corrigé ici
        ->groupBy('adresse')
        ->get();

    // Fusionner les deux jeux de données dans une structure unique $stats
    $stats = [];

    foreach ($elevesParAdresse as $e) {
        $stats[$e->adresse]['adresse'] = $e->adresse;
        $stats[$e->adresse]['eleves'] = $e->total;
        $stats[$e->adresse]['profs'] = 0;
    }

    foreach ($profsParAdresse as $p) {
        $stats[$p->adresse]['adresse'] = $p->adresse;
        $stats[$p->adresse]['profs'] = $p->total;
        if (!isset($stats[$p->adresse]['eleves'])) {
            $stats[$p->adresse]['eleves'] = 0;
        }
    }

    // Convertir en collection (utile dans Blade)
    $stats = collect($stats);

    return view('admin.dashboard', [
        'elevesCount' => $elevesCount,
        'profsCount' => $profsCount,
        'elevesParAdresse' => $elevesParAdresse,
        'profsParAdresse' => $profsParAdresse,
        'stats' => $stats,
    ]);
}

}