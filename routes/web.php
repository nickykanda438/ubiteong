<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\DocumentController; 
use App\Http\Controllers\CadreController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\EpargneController; 
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
        Route::get('/{membre}/fiche', [MembreController::class, 'fiche'])->name('fiche'); 
        Route::get('/{membre}/edit', [MembreController::class, 'edit'])->name('edit');
        Route::put('/{membre}', [MembreController::class, 'update'])->name('update');
        Route::delete('/{membre}', [MembreController::class, 'destroy'])->name('destroy');
        Route::get('/{membre}/carte', [MembreController::class, 'generateCard'])->name('generateCard');
        Route::get('/{membre}/piece-identite', [MembreController::class, 'viewPieceIdentite'])->name('viewPieceIdentite');
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

    // --- MODULE COMMUNICATION ---
    Route::prefix('communication')->group(function () {
        Route::get('/', [CommunicationController::class, 'index'])->name('communication.index');
        Route::post('/communique', [CommunicationController::class, 'storeCommunique'])->name('communique.store');
        Route::post('/event', [CommunicationController::class, 'storeEvent'])->name('event.store');
        Route::delete('/{model}/{id}', [CommunicationController::class, 'destroy'])->name('communication.destroy');
    });

    // --- MODULE FINANCE ---
    Route::prefix('finance')->name('finance.')->group(function () {
        
        // Page principale
        Route::get('/', [CreditController::class, 'index'])->name('index');

        // CORRECTION ICI : Changement de 'create' vers 'index'
        Route::get('/credit', [CreditController::class, 'index'])->name('credit');

        // --- GESTION DES CRÉDITS (Actions) ---
        Route::prefix('credits')->name('credits.')->group(function () {
            Route::get('/retard', [CreditController::class, 'enRetard'])->name('retard');
            Route::post('/', [CreditController::class, 'store'])->name('store');
            Route::get('/{id}', [CreditController::class, 'show'])->name('show');
            Route::post('/{id}/rembourser', [CreditController::class, 'rembourser'])->name('rembourser');
        });

        // --- GESTION DES ÉPARGNES ---
        Route::prefix('epargnes')->name('epargnes.')->group(function () {
            Route::post('/', [EpargneController::class, 'store'])->name('store');
            Route::post('/depose', [EpargneController::class, 'depose'])->name('depose');
            Route::post('/{id}/decaisse', [EpargneController::class, 'decaisse'])->name('decaisse');
        });
    });
    
});

require __DIR__.'/auth.php';