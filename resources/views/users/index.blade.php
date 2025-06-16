@foreach ($users as $user)
    <p>{{ $user->lastname }}</p>
    <p>{{ $user->firstname }}</p>
    <p>{{ $user->email }}</p>
    <p>{{ $user->password }}</p>
    <p>{{ $user->role }}</p>
    <p>{{ $user->is_active }}</p>
    <p>{{ $user->is_verified }}</p>
    <p>{{ $user->is_admin }}</p>
    <p>{{ $user->is_super_admin }}</p>
    <p>{{ $user->is_banned }}</p>
    <p>{{ $user->is_deleted }}</p>
    <p>{{ $user->created_at }}</p>
    <p>{{ $user->updated_at }}</p>
@endforeach

@if (auth()->user() && auth()->user()->role === \App\Models\User::ROLES['admin'])
    <p>Bienvenue, administrateur !</p>
@endif

@if (auth()->check())
    <p>Un utilisateur est connecté.</p>
@else
    <p>Aucun utilisateur n'est connecté.</p>
@endif

@if (auth()->user())
    <p>Rôle de l'utilisateur connecté : {{ auth()->user()->role }}</p>
@endif