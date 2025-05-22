<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function index()
    {
        // Tu peux envoyer des données à la vue si besoin
        $message = "Bienvenue dans la page d'accueil !";
        return view('welcome', compact('message'));
    }
}
