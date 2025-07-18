<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function show()
    {
        // Statistiques de base
        $elevesCount = User::where('role', 'eleve')->count();
        $profsCount = User::where('role', 'professeur')->count();
        $adminCount = User::where('role', 'admin')->count();
        $totalUsers = $elevesCount + $profsCount + $adminCount;

        // Si pas de données, utiliser des valeurs de test
        if ($totalUsers == 0) {
            $elevesCount = 25;
            $profsCount = 8;
            $adminCount = 2;
            $totalUsers = $elevesCount + $profsCount + $adminCount;
        }

        // Statistiques par adresse
        $elevesParAdresse = User::select('adresse', DB::raw('count(*) as total'))
            ->where('role', 'eleve')
            ->groupBy('adresse')
            ->get();

        $profsParAdresse = User::select('adresse', DB::raw('count(*) as total'))
            ->where('role', 'professeur')
            ->groupBy('adresse')
            ->get();

        // Fusionner les données par adresse
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

        // Si pas de données d'adresse, utiliser des données de test
        if (empty($stats)) {
            $stats = [
                'Dakar' => ['adresse' => 'Dakar', 'eleves' => 15, 'profs' => 3],
                'Thiès' => ['adresse' => 'Thiès', 'eleves' => 8, 'profs' => 2],
                'Saint-Louis' => ['adresse' => 'Saint-Louis', 'eleves' => 5, 'profs' => 1],
                'Kaolack' => ['adresse' => 'Kaolack', 'eleves' => 3, 'profs' => 1],
                'Ziguinchor' => ['adresse' => 'Ziguinchor', 'eleves' => 2, 'profs' => 1]
            ];
        }

        // Âge moyen des utilisateurs
        $averageAge = $this->calculateAverageAge();

        // Top 5 des adresses avec le plus d'utilisateurs
        $topAddresses = collect($stats)
            ->sortByDesc(function ($item) {
                return $item['eleves'] + $item['profs'];
            })
            ->take(5);

        // Données pour les graphiques
        $chartData = [
            'labels' => ['Élèves', 'Professeurs'],
            'data' => [$elevesCount, $profsCount],
            'colors' => ['#667eea', '#4facfe']
        ];

        // Données pour le deuxième graphique (tous les rôles)
        $secondChartData = [
            'labels' => ['Élèves', 'Professeurs', 'Administrateurs'],
            'data' => [$elevesCount, $profsCount, $adminCount],
            'colors' => ['#667eea', '#4facfe', '#f093fb']
        ];

        // Données pour le troisième graphique avec couleurs différentes
        $thirdChartData = [
            'labels' => ['Élèves', 'Professeurs', 'Administrateurs'],
            'data' => [$elevesCount, $profsCount, $adminCount],
            'colors' => ['#FF6B6B', '#4ECDC4', '#45B7D1', '#96CEB4', '#FFEAA7']
        ];

        // Debug: Afficher les données dans les logs
        \Log::info('Dashboard Data:', [
            'elevesCount' => $elevesCount,
            'profsCount' => $profsCount,
            'adminCount' => $adminCount,
            'totalUsers' => $totalUsers,
            'chartData' => $chartData
        ]);

        return view('admin.partials.dashboard-content', [
            'elevesCount' => $elevesCount,
            'profsCount' => $profsCount,
            'adminCount' => $adminCount,
            'totalUsers' => $totalUsers,
            'elevesParAdresse' => $elevesParAdresse,
            'profsParAdresse' => $profsParAdresse,
            'stats' => collect($stats),
            'averageAge' => $averageAge,
            'topAddresses' => $topAddresses,
            'chartData' => $chartData,
            'secondChartData' => $secondChartData,
            'thirdChartData' => $thirdChartData,
        ]);
    }

    public function showSimple()
    {
        // Statistiques de base
        $elevesCount = User::where('role', 'eleve')->count();
        $profsCount = User::where('role', 'professeur')->count();
        $adminCount = User::where('role', 'admin')->count();
        $totalUsers = $elevesCount + $profsCount + $adminCount;

        return view('admin.dashboard-simple', [
            'elevesCount' => $elevesCount,
            'profsCount' => $profsCount,
            'adminCount' => $adminCount,
            'totalUsers' => $totalUsers,
        ]);
    }



    private function calculateAverageAge()
    {
        $users = User::whereNotNull('dateNaissance')->get();
        
        if ($users->isEmpty()) {
            return 25; // Valeur par défaut
        }

        $totalAge = 0;
        $count = 0;

        foreach ($users as $user) {
            if ($user->dateNaissance) {
                try {
                    // Gérer le format de date français (dd/mm/yyyy)
                    $dateParts = explode('/', $user->dateNaissance);
                    if (count($dateParts) === 3) {
                        // Format français: dd/mm/yyyy -> yyyy-mm-dd
                        $dateString = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                        $birthDate = Carbon::parse($dateString);
                        $age = $birthDate->age;
                        $totalAge += $age;
                        $count++;
                    } else {
                        // Essayer le format standard
                        $birthDate = Carbon::parse($user->dateNaissance);
                        $age = $birthDate->age;
                        $totalAge += $age;
                        $count++;
                    }
                } catch (\Exception $e) {
                    // Ignorer les dates invalides
                    continue;
                }
            }
        }

        return $count > 0 ? round($totalAge / $count, 1) : 25;
    }


}