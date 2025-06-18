@extends('admin.layout')

@section('content')
<div class="admin-dashboard">
    <h1>Interface d'administration</h1>
    <p>Bienvenue, {{ Auth::user()->firstname }} !</p>

    <p>Statut : 
        @if(Auth::user()->status === 'disabled')
            Désactivé
        @else
            Actif
        @endif
    </p>

    <!-- Ajoutez ici les fonctionnalités du back-office -->
</div>
@endsection