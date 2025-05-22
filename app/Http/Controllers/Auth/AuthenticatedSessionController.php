<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            
            // Rediriger vers le bon tableau de bord selon le rôle
            if (Auth::user()->role == 'admin') {
                return redirect()->route('pageadmin');
            } elseif (Auth::user()->role == 'professeur') {
                return redirect()->route('pageprof');
            } else {
                return redirect()->route('pageeleve');
            }
        }
        else {

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne sont pas valides.',
             
        ]);
         }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
