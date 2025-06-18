@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Créer un article</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="file" name="picture" id="picture" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="" disabled selected>Choisissez une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">Auteur</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="" disabled selected>Choisissez un auteur</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection