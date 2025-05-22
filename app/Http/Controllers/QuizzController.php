<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizzController extends Controller
{
    public function afficherQuizz()
    {
        // Ici, tu peux récupérer les données de ton quizz depuis la base de données

        return view('quizz');
    }
}
