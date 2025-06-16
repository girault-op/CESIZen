@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'article</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $article->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Catégorie :</strong> {{ $article->category->name ?? 'Non catégorisé' }}</p>
            <p><strong>Contenu :</strong></p>
            <p>{{ $article->content }}</p>
            @if($article->picture)
                <p><strong>Image :</strong></p>
                <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" class="img-thumbnail" width="300">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection