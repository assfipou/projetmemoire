<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfController extends Controller
{
    public function afficherProf(){
        return view('prof.pageprof');
    }

}
