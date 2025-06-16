@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center fw-bold">Liste des utilisateurs</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="table-responsive shadow rounded">
        <table class="table table-hover table-bordered align-middle text-center mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->pseudo }}</td>
                        <td>{{ $user->email }}</td>

                        {{-- Affichage stylisé du rôle --}}
                        <td>
                            @if($user->role_label === 'Admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role_label === 'Utilisateur')
                                <span class="badge bg-secondary">Utilisateur</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $user->role_label }}</span>
                            @endif
                        </td>

                        {{-- Affichage stylisé du statut --}}
                        <td>
                            @if($user->status == 1)
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-dark">Désactivé</span>
                            @endif
                        </td>

                        {{-- Boutons d'action --}}
                        <td class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-edit"></i> Modifier
                            </a>

                            @if ($user->status == 1)
                                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                                        <i class="fas fa-user-slash"></i> Désactiver
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.activate', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success w-100">
                                        <i class="fas fa-user-check"></i> Activer
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Aucun utilisateur trouvé.</td>
                    </tr>
                @endforelse
                 {{-- Bouton retour au tableau de bord --}}
                 <br>
    <div class="mt-4 text-center">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour au tableau de bord
        </a>
    </div>
    <br>
            </tbody>
        </table>
    </div>
</div>
@endsection