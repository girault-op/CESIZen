@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Modifier un article</h1>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="file" name="picture" id="picture" class="form-control">
            @if($post->picture)
                <img src="{{ asset('storage/' . $post->picture) }}" alt="{{ $post->title }}" class="img-thumbnail mt-2" width="200">
            @endif
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->label}}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection