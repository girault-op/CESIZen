<?php

namespace App\Http\Controllers;

use App\Models\BreathingSession; // ✅ À ajouter
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ✅ À ajouter
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Applique le middleware auth à toutes les méthodes du contrôleur
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche le formulaire d'édition du profil.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Passe uniquement l'objet user à la vue
        return view('profile.edit', compact('user'));
    }

    /**
     * Affiche le tableau de bord.
     */
    public function dashboard(): View
    {
    $user = Auth::user();
    $user->refresh(); // rafraîchir les données de l'utilisateur

    // Statistiques globales
    $totalSessions = BreathingSession::where('user_id', $user->id)->count();
    $totalDuration = BreathingSession::where('user_id', $user->id)->sum('duration');
    $lastSession = BreathingSession::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->first();

    // Sessions groupées par mode
    $sessionsByMode = BreathingSession::where('user_id', $user->id)
        ->select('breathing_mode_id', DB::raw('count(*) as total'))
        ->groupBy('breathing_mode_id')
        ->with('mode') // assure-toi que la relation mode est bien définie dans le modèle
        ->get();

    // Sessions groupées par mois
    $sessionsByMonth = BreathingSession::where('user_id', $user->id)
        ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return view('dashboard', compact(
        'user',
        'totalSessions',
        'totalDuration',
        'lastSession',
        'sessionsByMode',
        'sessionsByMonth'
    ));
}

    /**
     * 
     * Met à jour les informations du profil utilisateur.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
    
        // Validation des champs
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'pseudo' => 'required|string|max:255|unique:users,pseudo,' . $user->id,
            'avatar' => 'required|string|in:adventurer,bottts,micah',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Mise à jour des infos de base
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->pseudo = $request->pseudo;
    
        // Mise à jour avatar (DiceBear)
        if ($request->filled('avatar')) {
            $user->avatar = 'https://api.dicebear.com/6.x/' . $request->avatar . '/svg?seed=' . $request->pseudo;
        }
    
        // Mise à jour mot de passe si fourni
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Le mot de passe actuel est incorrect.',
                ]);
            }
            $user->password = Hash::make($request->new_password);
        }
    
        // Sauvegarde unique
        $user->save();
    
        return redirect()->route('dashboard')->with('success', 'Profil mis à jour avec succès.');
    }
    /**
     * Affiche la page de profil.
     */
    public function show(): View
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    /**
     * Met à jour uniquement le mot de passe.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // Validation des champs
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Vérification du mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Déconnexion pour forcer la reconnexion
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès. Veuillez vous reconnecter.');
    }

    /**
     * Mise à jour du profil via dashboard (upload avatar image).
     */
    public function updateDashboard(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'pseudo' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->pseudo = $validatedData['pseudo'];
        $user->email = $validatedData['email'];

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Mise à jour mot de passe si champ rempli
        if ($request->filled('new_password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])->withInput();
            }

            $user->password = $request->input('password'); // mot de passe en clair, sera hashé automatiquement
            $user->save();

        $user->save(); // Toujours sauvegarder

        // Si le mot de passe a été modifié, déconnexion
        if ($request->filled('new_password')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Mot de passe mis à jour avec succès. Veuillez vous reconnecter.');
        }

        return redirect()->route('dashboard')->with('success', 'Profil mis à jour avec succès.');
    }
}
    /**
     * Affiche le tableau de bord (index).
     */
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();
        $sessionsByMonth = DB::table('coherence_sessions')
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->where('user_id', $user->id)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month')
        ->get();

    return view('dashboard', compact('sessionsByMonth', 'user'));

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder au tableau de bord.');
        }

        $totalSessions = BreathingSession::where('user_id', $user->id)->count();
        $totalDuration = BreathingSession::where('user_id', $user->id)->sum('duration');

        $lastSession = BreathingSession::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $sessionsByMode = BreathingSession::where('user_id', $user->id)
            ->select('breathing_mode_id', DB::raw('count(*) as total'))
            ->groupBy('breathing_mode_id')
            ->with('mode')
            ->get();

        $sessionsByMonth = BreathingSession::where('user_id', $user->id)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact(
            'user',
            'totalSessions',
            'totalDuration',
            'lastSession',
            'sessionsByMode',
            'sessionsByMonth'
        ));
    }

    public function profile(): View
{
    $user = Auth::user();
    $user->refresh(); // Actualise les données de l'utilisateur depuis la base de données

    return view('profile', compact('user'));
}
}

