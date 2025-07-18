<?php

require_once 'vendor/autoload.php';

use Carbon\Carbon;

// Test du format de date français
$dateString = "23/01/1998";

try {
    // Gérer le format de date français (dd/mm/yyyy)
    $dateParts = explode('/', $dateString);
    if (count($dateParts) === 3) {
        // Format français: dd/mm/yyyy -> yyyy-mm-dd
        $dateString = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
        $birthDate = Carbon::parse($dateString);
        $age = $birthDate->age;
        echo "Date: $dateString\n";
        echo "Âge: $age\n";
        echo "Date de naissance: " . $birthDate->format('d/m/Y') . "\n";
    }
} catch (\Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
} 