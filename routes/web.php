<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\DocumentController; // Importez le contrôleur de documents
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
    
    // --- Gestion des Membres ---
    Route::get('/membres', [MembreController::class, 'index'])->name('membres.index');
    Route::get('/membres/creer', [MembreController::class, 'create'])->name('membres.create');
    Route::post('/membres', [MembreController::class, 'store'])->name('membres.store');
    Route::get('/membres/{membre}/edit', [MembreController::class, 'edit'])->name('membres.edit');
    Route::put('/membres/{membre}', [MembreController::class, 'update'])->name('membres.update');
    Route::delete('/membres/{membre}', [MembreController::class, 'destroy'])->name('membres.destroy');
    Route::get('/membres/{membre}/carte', [MembreController::class, 'generateCard'])->name('membres.generateCard');

    // --- Gestion des Documents (KAZWAZWA) ---
    // Liste et recherche
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    
    // Enregistrement
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    
    // Visualisation (Lire)
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    
    // Téléchargement
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    
});

require __DIR__.'/auth.php';