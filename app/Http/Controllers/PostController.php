<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::orderBy('published_at', 'desc');

        // Filtrage par catégorie
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Recherche sur title, excerpt et content
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Pagination
        $posts = $query->paginate(6)->withQueryString();

        // Liste des catégories distinctes pour filtres (ordre alphabétique)
        $categories = Post::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
