
@foreach ($Categories as $Category)
    <p>ID : {{ $Category->id}}</p>
    <p>Label : {{ $Category->label}}</p>
    <p>Crée le : {{ $Category->created_at}}</p>
    <p>Mis à jour le : {{ $Category->updated_at}}</p>
@endforeach
