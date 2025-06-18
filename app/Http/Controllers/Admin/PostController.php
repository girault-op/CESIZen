<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request)
    {
    $search = $request->input('search');
    $posts = Post::with(['author', 'category'])->get(); // Récupère les articles avec auteur et catégorie

    $posts = Post::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->paginate(10); // Utilisation de la pagination

    return view('admin.posts.index', compact('posts'));
}

public function create()
{
    $categories = Category::all(); // Récupère toutes les catégories
    $users = User::all(); // Récupère tous les utilisateurs (auteurs)

    return view('admin.posts.create', compact('categories', 'users'));
}

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }
        // Enregistrement de l'article
        $post = Post::create($validatedData);

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post créé avec succès.');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Récupère l'article à éditer
        $categories = Category::all(); // Récupère toutes les catégories

        return view('admin.posts.edit', compact('post', 'categories'));
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'picture' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post mis à jour avec succès.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post supprimé avec succès.');
    }

    public function publish(Post $post)
{
    $post->update(['is_published' => true]);

    return redirect()->route('admin.posts.index')->with('success', 'Article publié avec succès.');
}
}
