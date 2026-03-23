<?php

use App\Http\Controllers\ProfileController;
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
    
    Route::get('/membres', function () {
        return view('membres.index'); 
    })->name('membres.index');

    // URL : http://127.0.0.1:8000/membres/creer
    Route::get('/membres/creer', function () {
        // Laravel cherche : resources/views/membres/create.blade.php
        return view('membres.create');
    })->name('membres.create');
});

require __DIR__.'/auth.php';