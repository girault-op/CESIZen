<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Connexion réussie
            return redirect()->intended('dashboard');
        }
    
        // Connexion échouée
        return back()->withErrors([
            'email' => 'Les informations d’identification ne sont pas correctes.',
        ])->onlyInput('email');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash le mot de passe
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->save();
        


        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Search for a user by name.
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $users = User::where('lastname', 'like', '%' . $request->search . '%')
            ->orWhere('firstname', 'like', '%' . $request->search . '%')
            ->get();

        return view('user.index', [
            'users' => $users
        ]);
    }


    /**
     * Sort users by name.
     */
    public function sortByName(Request $request)
    {
        $request->validate([
            'sort' => 'required|in:asc,desc',
        ]);

        $users = User::orderBy('lastname', $request->sort)->paginate(10);

        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function debugPasswordCheck(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'Utilisateur introuvable'], 404);
    }

    if (Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Mot de passe correct'], 200);
    } else {
        return response()->json(['message' => 'Mot de passe incorrect'], 401);
    }
}

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function index()
    {
        $users = User::all(); // Récupère tous les utilisateurs
        return view('dashboard', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role; // Met à jour le rôle
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Rôle mis à jour avec succès.');
    }
}