<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.users.create');
    }

    // Création d'utilisateur/administrateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,admin'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Utilisateur créé avec succès');
    }

    // Désactivation d'un compte
    public function deactivate(User $user)
    {
        $user->update(['is_active' => false]);
        
        return back()->with('success', 'Compte désactivé avec succès');
    }

    // Suppression d'un compte
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            
            // Supprimer les données liées (exercices, etc.)
            $user->exercises()->delete();
            $user->diagnostics()->delete();
            
            $user->delete();
            
            DB::commit();
            return redirect()->route('admin.users.index')
                           ->with('success', 'Utilisateur supprimé avec succès');
                           
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la suppression');
        }
    }

    // Affichage du formulaire d'édition
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Valider les données
        $request->validate([
            'role' => 'required|integer',
        ]);
    
        // Mettre à jour le rôle
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->route('dashboard')->with('success', 'Rôle mis à jour avec succès.');
    }


}
