<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisualisationController extends Controller
{
    public function index()
    {
        // Tu peux envoyer des données à la vue si besoin
        $message = "Bienvenue dans la page de visualisation !";
        return view('visualisation', compact('message'));
    }
}
