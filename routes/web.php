<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\DocumentController; 
use App\Http\Controllers\CadreController;
use App\Http\Controllers\CommunicationController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard protégé
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Groupe de routes nécessitant une authentification
Route::middleware('auth')->group(function () {
    
    // --- PROFIL UTILISATEUR ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- GESTION DES MEMBRES ---
    Route::prefix('membres')->name('membres.')->group(function () {
        Route::get('/', [MembreController::class, 'index'])->name('index');
        Route::get('/creer', [MembreController::class, 'create'])->name('create');
        Route::post('/', [MembreController::class, 'store'])->name('store');
        Route::get('/{membre}/edit', [MembreController::class, 'edit'])->name('edit');
        Route::put('/{membre}', [MembreController::class, 'update'])->name('update');
        Route::delete('/{membre}', [MembreController::class, 'destroy'])->name('destroy');
        Route::get('/{membre}/carte', [MembreController::class, 'generateCard'])->name('generateCard');
    });

    // --- GESTION DES DOCUMENTS ---
    Route::prefix('documents')->name('documents.')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::post('/', [DocumentController::class, 'store'])->name('store');
        Route::get('/{document}', [DocumentController::class, 'show'])->name('show');
        Route::get('/{document}/download', [DocumentController::class, 'download'])->name('download');
    });

    // --- GESTION DES CADRES ---
    Route::prefix('cadres')->name('cadres.')->group(function () {
        Route::get('/', [CadreController::class, 'index'])->name('index');
        Route::post('/', [CadreController::class, 'store'])->name('store');
        Route::get('/{cadre}', [CadreController::class, 'show'])->name('show');
        Route::put('/{cadre}', [CadreController::class, 'update'])->name('update');
        Route::delete('/{cadre}', [CadreController::class, 'destroy'])->name('destroy');
    });

    // --- MODULE COMMUNICATION (Communiqués & Events) ---
    Route::prefix('communication')->group(function () {
        // Vue principale (Formulaires + Liste)
        Route::get('/', [CommunicationController::class, 'index'])->name('communication.index');
        
        // Actions de stockage
        Route::post('/communique', [CommunicationController::class, 'storeCommunique'])->name('communique.store');
        Route::post('/event', [CommunicationController::class, 'storeEvent'])->name('event.store');
        
        // Suppression (Dynamique via le contrôleur unique)
        Route::delete('/{model}/{id}', [CommunicationController::class, 'destroy'])->name('communication.destroy');
    });
    
});

require __DIR__.'/auth.php';