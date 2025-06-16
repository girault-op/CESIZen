<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\CoherenceCardiaqueStat;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Exemple d'une méthode pour créer une session de cohérence cardiaque
    public function createBreathingSession()
    {
        $sessionId = Str::uuid(); // Génère un identifiant unique pour la session

        // Utilise l'ID de l'utilisateur actuel
        CoherenceCardiaqueStat::create([
            'user_id' => $this->id, // ID de l'utilisateur actuel
            'session_id' => $sessionId,
            'mode' => 'relaxation',
            'duration' => 300, // 5 minutes
            'breaths' => 50,
        ]);

        // Récupère les statistiques de la session
        return CoherenceCardiaqueStat::where('session_id', $sessionId)->get();
    }

    // Mutator pour hacher le mot de passe
    public function setPasswordAttribute($value)
    {
        if (\Illuminate\Support\Facades\Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'role', // 0 = admin, 1 = user
        'password',
        'pseudo',
        'avatar',
        'is_admin', 
        'status',
    ];

        protected $hidden = [
            'password',
            'remember_token',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public const ROLES = [
        'anonymous' => 0,  // Utilisateur non connecté
        'user' => 1,  // Utilisateur connecté
        'admin' => 2, // Administrateur
    ];

    public const STATUSES = [
        'active',
        'inactive',
        'banned',
        'pending',
    ];

    public static function isValidRole($role)
    {
        return in_array($role, array_keys(self::ROLES));
    }

    public static function isValidStatus($status)
    {
        return in_array($status, self::STATUSES);
    }

    public function setRoleAttribute($value)
    {
        if (is_string($value) && isset(self::ROLES[$value])) {
            $this->attributes['role'] = self::ROLES[$value];
        } else {
            $this->attributes['role'] = $value;
        }
    }
    
    public function getRoleLabelAttribute()
    {
        $roles = [
            0 => 'Admin',
            1 => 'Utilisateur',
            2 => 'Anonyme',
        ];
        return $roles[$this->attributes['role']] ?? 'Inconnu';
    }

     // ==== Relations ====

    public function breathingModes()
    {
        return $this->belongsToMany(BreathingMode::class)->withPivot('usage_count');
    }

    public function coherenceSessions()
    {
        return $this->hasMany(CoherenceSession::class);
    }

    // ==== Statistiques ====

    public function incrementBreathingModeUsage(BreathingMode $mode): void
    {
        $currentUsage = $this->breathingModes()->find($mode->id)?->pivot->usage_count ?? 0;

        $this->breathingModes()->syncWithoutDetaching([
            $mode->id => ['usage_count' => $currentUsage + 1]
        ]);
    }

    public function getBreathingModeStats(): array
    {
        return $this->breathingModes->map(function ($mode) {
            return [
                'mode' => $mode->label,
                'usage_count' => $mode->pivot->usage_count,
            ];
        })->toArray();
    }

    // app/Models/User.php
    public function isAdmin()
    {
        return $this->role === 'admin' && $this->is_active;
    }

    public function canManageUsers()
    {
        return $this->isAdmin();
    }

    public function exercises() {
        return $this->hasMany(Exercise::class);
    }
    public function diagnostics() {
        return $this->hasMany(Diagnostic::class);
    }
    public function getIsAdminAttribute()
    {
    return $this->role === 'admin'; // Supposons que vous avez une colonne `role` dans la table `users`
    }
}