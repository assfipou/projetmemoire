<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function afficherSimulation()
    {
        return view('simulation'); // Assure-toi que ce fichier existe dans resources/views/simulation/index.blade.php
    }
}
