<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreathingMode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mode', 'duree', 'date', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('usage_count', 'total_duration')
                    ->withTimestamps();
    }

    /**
     * Récupère les statistiques d'utilisation pour un utilisateur donné.
     */
    public function getUserStats($userId)
    {
        return $this->users()
                    ->where('user_id', $userId)
                    ->first()
                    ->pivot;
    }

    /**
     * Incrémente le compteur d'utilisation pour un utilisateur donné.
     */
    public function incrementUsage($userId, $duration)
    {
        $this->users()->updateExistingPivot($userId, [
            'usage_count' => \DB::raw('usage_count + 1'),
            'total_duration' => \DB::raw('total_duration + ' . $duration),
        ]);
    }
}