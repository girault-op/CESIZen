<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'picture', 'category_id', 'user_id'];

    // Relation avec l'auteur (utilisateur)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Casts automatiques
    protected $casts = [
        'published_at' => 'datetime',
        'read_time' => 'integer',
    ];

    /**
     * Accesseur pour obtenir un temps de lecture par défaut si null
     */
    public function getReadTimeAttribute($value)
    {
        return $value ?? 5; // 5 minutes par défaut
    }

    /**
     * Accesseur personnalisé pour une date formatée en français (ex: 16 juin 2025)
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at
            ? $this->published_at->locale('fr')->isoFormat('LL')
            : null;
    }

    /**
     * Scope pour ne récupérer que les articles publiés (date passée ou égale)
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }
}
