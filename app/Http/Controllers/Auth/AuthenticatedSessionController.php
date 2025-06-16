<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la vue de connexion
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gère la tentative de connexion
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des champs
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       /* $user = \App\Models\User::where('email', $request->email)->first();

    if ($user) {
        if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            dd('✅ Le mot de passe est correct !');
        } else {
            dd('❌ Mot de passe incorrect !');
        }
    } else {
        dd('❌ Utilisateur non trouvé');
    }

    */

        // Tentative de connexion
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'Les identifiants sont invalides.',
        ]);

        // En cas d’échec, lancer une exception
        throw ValidationException::withMessages([
            'email' => __('Les identifiants sont invalides.'),
        ]);
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
