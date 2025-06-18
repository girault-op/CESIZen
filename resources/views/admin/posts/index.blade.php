@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des articles</h1>
    <div class="mb-4">
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Créer un article</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name ?? 'Non défini' }}</td>
                        <td>{{ $post->category->label ?? 'Non défini' }}</td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Aucun article trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

<style>
    .badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
</style>
@endsection