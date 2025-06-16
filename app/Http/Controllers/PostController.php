<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $postsQuery = Post::with('category')->where('is_published', 1);
    
        if ($search) {
            $postsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
            });
        }
    
        $posts = $postsQuery->get();
    
        return view('posts.index', compact('posts', 'search'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
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
    
        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Vérifie si published_at est null
        if (!$post->is_published) {
            abort(404);
        }
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post supprimé avec succès.');
    }
}