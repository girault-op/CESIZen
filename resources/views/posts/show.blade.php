@extends('layouts.app')

@section('title', $post->title)

@section('header')
<header>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p class="subtitle">Publié dans {{ $post->category->name }}</p>
    </div>
</header>
@endsection

@section('content')
<article>
    <div class="post-image-container">
        <img src="{{ $post->picture ?? 'https://source.unsplash.com/random/1200x600/?wellness' }}" alt="{{ $post->title }}" class="post-image" style="width: 100%; height: auto; max-height: 400px;">
    </div>
    
    @if ($post->is_published)
    <div class="post-meta" style="margin: 20px 0;">
        <div>
            <span>Publié le: {{ $post->created_at->format('d/m/Y à H:i') }}</span>
            @if($post->updated_at != $post->created_at)
                <span style="margin-left: 15px;">Mis à jour le: {{ $post->updated_at->format('d/m/Y à H:i') }}</span>
            @endif
        </div>
    </div>
@else
    <div class="post-meta" style="margin: 20px 0; color: red;">
        <strong>Article non publié</strong>
    </div>
@endif
</article>
@endsection