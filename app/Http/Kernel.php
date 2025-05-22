<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Les middleware HTTP globaux de l'application.
     *
     * @var array<int, class-string|string>
     */
 
    /**
     * Les middleware de route individuels.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
       
        // Middlewares personnalisés pour les rôles
        'admin' => \App\Http\Middleware\RedirectIfAdmin::class,
        'prof' => \App\Http\Middleware\RedirectIfProf::class,
        'eleve' => \App\Http\Middleware\RedirectIfEleve::class,
    ];
}
