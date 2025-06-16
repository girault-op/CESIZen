<!DOCTYPE html>
<html>
<head>
    <title>Vérification du mot de passe</title>
</head>
<body>
    <form action="{{ route('check.password') }}" method="POST">
        @csrf
        <label for="user_id">récupère le hachage de la base de données</label>
        <input type="text" id="user_id" name="user_id" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Vérifier</button>
    </form>
</body>
</html>