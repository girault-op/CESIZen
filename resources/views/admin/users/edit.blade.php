@extends('admin.layout')

@section('content')
    <h2>Modifier l'utilisateur</h2>

    {{-- Formulaire de modification --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')    

        {{-- Champ Nom --}}
        <div class="mb-3">
            <label for="firstname" class="form-label">Nom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
        </div>

        {{-- Champ Prénom --}}
        <div class="mb-3">
            <label for="lastname" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
        </div>

        {{-- Champ Pseudo --}}
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="{{ old('pseudo', $user->pseudo) }}" required>
        </div>

        {{-- Champ Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Utilisateur</option>
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
    
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        {{-- Bouton Enregistrer --}}
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection