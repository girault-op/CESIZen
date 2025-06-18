<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('admin.users.create');
    }

    // Enregistrement d'un nouvel utilisateur
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'nullable|string|max:100',
            'pseudo' => 'required|string|max:100|unique:users,pseudo',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|in:0,1',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'pseudo' => $validatedData['pseudo'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'status' => $validatedData['status'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Met à jour les infos de l'utilisateur
  // Met à jour un utilisateur existant
  public function update(Request $request, $id)
  {
      $validatedData = $request->validate([
          'firstname' => 'required|string|max:100',
          'lastname' => 'nullable|string|max:100',
          'pseudo' => 'required|string|max:100|unique:users,pseudo,' . $id,
          'email' => 'required|email|max:255|unique:users,email,' . $id,
          'role' => 'required|in:0,1',
          'status' => 'required|in:active,inactive',
      ]);

      $user = User::findOrFail($id); // Récupère l'utilisateur ou retourne une erreur 404

      // Met à jour les données de l'utilisateur
      $user->update([
          'firstname' => $validatedData['firstname'],
          'lastname' => $validatedData['lastname'],
          'pseudo' => $validatedData['pseudo'],
          'email' => $validatedData['email'],
          'role' => $validatedData['role'],
          'status' => $validatedData['status'],
      ]);

      return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
  }

    // Activation de l'utilisateur
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur activé.');
    }

    // Désactivation de l'utilisateur
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';
        $user->save();

        return redirect()->back()->with('success', 'Utilisateur désactivé.');
    }

    // Affiche un utilisateur en détail
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // Suppression d'un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Supprime un utilisateur existant
public function delete($id)
{
    // Récupère l'utilisateur par son ID ou retourne une erreur 404
    $user = User::findOrFail($id);

    // Supprime l'utilisateur
    $user->delete();

    // Redirige vers la liste des utilisateurs avec un message de succès
    return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
}

public function updateUserRole(Request $request, $id)
    {
        // Valide le rôle envoyé dans la requête
        $request->validate([
            'role' => 'required|boolean', // Le rôle doit être un booléen : true (admin) ou false (utilisateur)
        ]);

        // Récupère l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Met à jour le rôle de l'utilisateur
        $user->role = $request->input('role');
        $user->save();

        // Redirige avec un message de succès
        return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Met à jour le statut d'un utilisateur.
     */
    public function updateUserStatus(Request $request, $id)
    {
        // Valide le statut envoyé dans la requête
        $request->validate([
            'status' => 'required|string|in:active,inactive,suspended', // Liste des statuts autorisés
        ]);

        // Récupère l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Met à jour le statut de l'utilisateur
        $user->status = $request->input('status');
        $user->save();

        // Redirige avec un message de succès
        return redirect()->route('admin.users.index')->with('success', 'Statut mis à jour avec succès.');
    }

    /**
     * Réinitialise le rôle d'un utilisateur en "utilisateur".
     */
    public function resetUserRole($id)
    {
        // Récupère l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Réinitialise le rôle à "utilisateur" (false)
        $user->role = false;
        $user->save();

        // Redirige avec un message de succès
        return redirect()->route('admin.users.index')->with('success', 'Rôle réinitialisé en utilisateur.');
    }


}
