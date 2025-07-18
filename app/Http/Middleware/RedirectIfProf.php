<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfProf
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('loginPage')->with('error', 'Authentification requise');
        }

        if (Auth::user()->role === 'professeur') {
            return $next($request);
        }

        return match(Auth::user()->role) {
            'admin' => redirect()->route('pageadmin')->with('error', 'Réservé aux professeurs'),
            'eleve' => redirect()->route('pageeleve')->with('error', 'Réservé aux professeurs'),
            default => redirect()->route('accueil')->with('error', 'Accès non autorisé')
        };
    }
}