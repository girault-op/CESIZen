<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10); // pagination correcte
        return view('admin.users.index', compact('users'));
    }
    
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0; // <-- CORRECTION ICI
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur désactivé avec succès.');
    }

    public function activate($id)
{
    $user = User::findOrFail($id);
    $user->status = 1; // <-- NOUVELLE MÉTHODE
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Utilisateur activé avec succès.');
}

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'pseudo' => 'required|string|max:100|unique:users,pseudo',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|integer|in:0,1', // Validation pour les rôles admin (0) et user (1)
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'pseudo' => $validatedData['pseudo'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'], // Enregistrement du rôle directement
            'password' => bcrypt($validatedData['password']),
            'is_admin' => $request->has('is_admin'),
            'status' => 1, // <-- Ajouté ici pour forcer actif
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Récupère l'utilisateur par son ID
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|string|max:100|unique:users,pseudo,' . $user->id,
            'lastname' => 'nullable|string|max:100',
            'firstname' => 'required|string|max:100',
            'role' => 'required|integer|in:0,1', // Validation pour les rôles admin (0) et user (1)
            'is_admin' => 'boolean', // Validation pour le champ is_admin
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'pseudo' => $request->pseudo,
            'role' => (int) $request->role, // Mise à jour du rôle
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'is_admin' => $request->has('is_admin'),
            'is_active' => $request->input('is_active'), // ✅ AJOUT IC
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optionnel : empêcher la suppression de soi-même
        if (auth()->id() == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    
}
?>