@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Articles</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <h4>Catégories</h4>
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        {{ $category->name }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <h4>Liste des articles</h4>
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($post->picture)
                                <img src="{{ asset('storage/' . $post->picture) }}" class="card-img-top" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <p class="text-muted">Catégorie : {{ $post->category->name ?? 'Non catégorisé' }}</p>
                                <a href="#" class="btn btn-primary">Lire la suite</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Aucun article publié.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection