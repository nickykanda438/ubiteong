<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembreController; // Importez le contrôleur ici
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // --- Profil Utilisateur ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- Gestion des Membres (Lien avec le Contrôleur) ---
    
    // Liste et Statistiques
    Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');
    
    // Formulaire de création
    Route::get('/membres/creer', [MembreController::class, 'create'])->name('membres.create');
    
    // Enregistrement des données (Méthode POST)
    Route::post('/membres', [MembreController::class, 'store'])->name('membres.store');
    
    // Edition et Mise à jour
    Route::get('/membres/{membre}/edit', [MembreController::class, 'edit'])->name('membres.edit');
    Route::put('/membres/{membre}', [MembreController::class, 'update'])->name('membres.update');
    
    // Suppression
    Route::delete('/membres/{membre}', [MembreController::class, 'destroy'])->name('membres.destroy');
    
    // Génération de la carte
    Route::get('/membres/{membre}/carte', [MembreController::class, 'generateCard'])->name('membres.generateCard');
});

require __DIR__.'/auth.php';