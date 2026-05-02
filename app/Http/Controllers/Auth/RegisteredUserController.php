<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche la page d'inscription
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription de l'utilisateur
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔍 Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 👤 Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ❌ IMPORTANT : on ne connecte PAS automatiquement l'utilisateur

        // 🔁 Redirection vers la page de connexion
        return redirect()->route('login')
            ->with('success', 'Compte créé avec succès. Vous pouvez maintenant vous connecter.');
    }
}