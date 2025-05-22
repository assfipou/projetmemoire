<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisualisationController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

Route::get('/visualisation', [VisualisationController::class, 'index'])->name('visualisation');
Route::get('/quizz', [QuizzController::class, 'afficherQuizz'])->name('quizz');
Route::view('/faq', 'faq')->name('faq');
Route::post('/faq/contact', [FaqController::class, 'submitQuestion'])->name('faq.contact');
Route::get('/simulation', [SimulationController::class, 'afficherSimulation'])->name('simulation');
Route::middleware(['auth'])->get('/pageadmin', [AdminController::class, 'afficherAdmin'])->name('pageadmin');
Route::middleware(['auth'])->get('/pageprof', [ProfController::class, 'afficherProf'])->name('pageprof');
Route::middleware(['auth'])->get('/pageeleve', [EleveController::class, 'afficherEleve'])->name('pageeleve');
Route::get('/recherche', [App\Http\Controllers\RechercheController::class, 'index'])->name('recherche');
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
   
});

// Inclure les routes Breeze (authentification)
require __DIR__.'/auth.php';