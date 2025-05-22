<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EleveController extends Controller
{
    public function afficherEleve(){
    return view('eleve.pageeleve');
}
}