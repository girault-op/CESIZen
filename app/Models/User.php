<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\CoherenceCardiaqueStat;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    // ... ton code existant ...

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'role',    // 0 = admin, 1 = user
        'password',
        'pseudo',
        'avatar',
        'status' => 'boolean', // Cast le champ status en boolean
    ];

    // Méthode pour savoir si cet utilisateur peut gérer d'autres utilisateurs
    public function canManageUsers()
    {
        return $this->isAdmin();
    }

    // Hypothèse : on ne stocke pas dans la BDD les liens admin/utilisateur
    // => on va juste filtrer par role dans une query, par exemple pour récupérer tous les users
    public static function getAllUsers()
    {
        return self::where('role', 1)->get();
    }

    public static function getAllAdmins()
    {
        return self::where('role', 0)->get();
    }

    public function getIsAdminAttribute()
{
    return $this->role === 0; // 0 = admin
}

public function setPasswordAttribute($value)
{
    $this->attributes['password'] = Hash::make($value);
}

   // Méthode pour vérifier si l'utilisateur connecté est admin
   public function isAdmin()
   {
       return $this->role === true; // ou return $this->role;
   }
   
   public function isUser()
   {
       return !$this->role; // ou return $this->role === false;
   }
   
   public function updateRoleToAdmin()
   {
       $this->role = true;
       $this->save();
   }
   
   public function updateRoleToUser()
   {
       $this->role = false;
       $this->save();
   }

   public function getStatusTextAttribute()
{
    return $this->status ? 'active' : 'inactive';
}

public static function reorganizeIds()
{
    $users = self::orderBy('id')->get(); // Récupère tous les utilisateurs triés par ID
    $newId = 1;

    foreach ($users as $user) {
        DB::table('users')->where('id', $user->id)->update(['id' => $newId]);
        $newId++;
    }

    // Réinitialise l'auto-incrémentation
    DB::statement('ALTER TABLE users AUTO_INCREMENT = ' . ($newId));
}

public static function deleteUser($id)
{
    $user = self::find($id);

    if ($user) {
        $user->delete(); // Supprime l'utilisateur
        self::reorganizeIds(); // Réorganise les IDs
    }
}
    // ... autres relations et méthodes ...
}
