<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            $currentRoute = $request->route()->getName();
            
            // Si l'utilisateur est sur la page d'accueil, le rediriger vers sa page appropriée
            if ($currentRoute === 'accueil' || $request->is('/')) {
                switch ($userRole) {
                    case 'admin':
                        return redirect()->route('pageadmin');
                    case 'professeur':
                        return redirect()->route('pageprof');
                    case 'eleve':
                        return redirect()->route('pageeleve');
                    default:
                        // Si le rôle n'est pas reconnu, rester sur la page d'accueil
                        break;
                }
            }
        }

        return $next($request);
    }
} 