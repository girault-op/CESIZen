<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'content', 'picture', 'is_published', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope pour récupérer uniquement les articles publiés
    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    // Accesseur pour obtenir l’URL de l’image
    public function getImageUrlAttribute()
    {
        if ($this->picture) {
            return asset('storage/' . $this->picture);
        }

        return 'https://source.unsplash.com/random/600x400/?wellness';
    }
}
