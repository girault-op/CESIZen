<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $availableAvatars = ['adventurer', 'bottts', 'micah'];
        return view('auth.register', compact('availableAvatars'));
    }

    public function store(Request $request)
    {
        $availableAvatars = ['adventurer', 'bottts', 'micah'];

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'pseudo' => 'required|string|max:255|unique:users',
            'avatar' => 'required|string|in:' . implode(',', $availableAvatars),
        ], [
            'firstname.required' => 'Le prénom est obligatoire.',
            'lastname.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'pseudo.required' => 'Le pseudo est obligatoire.',
            'pseudo.unique' => 'Ce pseudo est déjà utilisé.',
            'avatar.required' => 'Veuillez choisir un avatar.',
            'avatar.in' => 'L\'avatar sélectionné est invalide.',
        ]);

        // Avatar par défaut (sécurité au cas où)
        $validatedData['avatar'] = $validatedData['avatar'] ?? 'adventurer';

        // Création de l'utilisateur
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'], // Hashé automatiquement via le mutator
            'pseudo' => $validatedData['pseudo'],
            'avatar' => 'https://api.dicebear.com/6.x/' . $validatedData['avatar'] . '/svg?seed=' . $validatedData['pseudo'],
        ]);

        // Événement Laravel (utile si tu veux envoyer un email de confirmation)
        event(new Registered($user));

        // Connexion de l'utilisateur
        Auth::login($user);

        // Redirection vers le dashboard
        return redirect()->route('dashboard')->with('success', 'Bienvenue sur votre tableau de bord !');
    }
}