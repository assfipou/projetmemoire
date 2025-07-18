<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfEleve
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Authentification requise');
        }

        if (Auth::user()->role === 'eleve') {
            return $next($request);
        }

        return match(Auth::user()->role) {
            'admin' => redirect()->route('pageadmin')->with('error', 'Réservé aux élèves'),
            'professeur' => redirect()->route('pageprof')->with('error', 'Réservé aux élèves'),
            default => redirect()->route('accueil')->with('error', 'Accès non autorisé')
        };
    }
}