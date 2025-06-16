<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js') 
  <title>Inscription - CESIZEN</title>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<style>
  .cz-btn-top {
  position: absolute;
  top: 0;
  right: 0;
  background: #1d2757;
  color: #fff;
  border: none;
  border-radius: 24px;
  padding: 11px 32px 11px 32px;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 2px 8px rgba(29,39,87,0.07);
  transition: background 0.2s;
}
.cz-btn-top:hover {
  background: #1d6fff;
}
main {
  width: 100%;
  display: flex;
  justify-content: center;
}
.cz-form {
  background: #fff;
  max-width: 420px;
  width: 100%;
  margin: 0 auto;
  padding: 28px 0 0 0;
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.cz-form-group input {
  width: 100%;
  padding: 15px 22px;
  border: none;
  border-radius: 22px;
  background: #f7f8fa;
  font-size: 17px;
  margin-bottom: 0;
  outline: none;
  color: #1d2757;
  font-family: 'Montserrat', Arial, sans-serif;
  box-shadow: 0 1px 2px rgba(29,39,87,0.03);
  transition: border 0.2s, background 0.2s;
}
.cz-form-group input:focus {
  border: 1.5px solid #1d6fff;
  background: #fff;
}
.cz-form-group input::placeholder {
  color: #b3b3b3;
  font-size: 17px;
  font-family: 'Montserrat', Arial, sans-serif;
  font-weight: 400;
}
.cz-password-info {
  font-size: 13px;
  color: #1d2757;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: -8px;
  margin-bottom: 2px;
}
.cz-password-info span {
  color: #7ebc5a;
  font-size: 13px;
  font-weight: 400;
}
.cz-strength {
  font-weight: 700;
  margin-left: 18px;
  color: #e74c3c; /* rouge par défaut */
  transition: color 0.2s;
}
.cz-strength.weak { color: #e74c3c; }
.cz-strength.medium { color: #f1c40f; }
.cz-strength.strong { color: #7ebc5a; }
.cz-strength.very-strong { color: #2ecc40; }
.g-recaptcha {
  transform: scale(1.08);
  margin-top: 4px;
}
.cz-checkbox-group {
  display: flex;
  align-items: center;
  gap: 9px;
  font-size: 15px;
  margin-top: -5px;
}
.cz-checkbox-group input[type="checkbox"] {
  accent-color: #1d6fff;
  width: 18px;
  height: 18px;
  margin: 0;
}
.cz-checkbox-group label {
  color: #1d2757;
  font-size: 15px;
  font-family: 'Filson Pro', Arial, sans-serif;
}
.cz-submit-btn {
  background: #1d2757;
  color: #fff;
  border: none;
  border-radius: 22px;
  padding: 13px 0;
  font-size: 20px;
  font-weight: 700;
  margin-top: 12px;
  cursor: pointer;
  transition: background 0.2s;
  box-shadow: 0 2px 8px rgba(29,39,87,0.07);
  width: 100%;
}
.cz-submit-btn:hover {
  background: #1d6fff;
}
.cz-form-group {
  position: relative;
  margin-bottom: 18px;
}
.cz-password-strength {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-top: 4px;
}
.cz-strength-bar-bg {
  width: 110px;
  height: 8px;
  background: #e0e0e0;
  border-radius: 4px;
  overflow: hidden;
}
.cz-strength-bar {
  height: 100%;
  width: 0%;
  background: #e74c3c;
  border-radius: 4px;
  transition: width 0.3s, background 0.3s;
}
.cz-strength-text {
  font-size: 14px;
  font-weight: 600;
  min-width: 70px;
  color: #e74c3c;
  transition: color 0.3s;
}
.cz-strength-text.medium { color: #f39c12; }
.cz-strength-text.strong { color: #27ae60; }
  </style>
  
  <body class="font-sans text-[#0A0F3D]">
  <div class="container mx-auto px-8 lg:px-20"> 
  <div class="container">
    <!-- Logo et tabs -->
    <header class="main-header">
        <div class="header-content">
            <div class="logo-title">
                <img src="images/logo-cesizen.png" alt="CESIZEN" class="logo">
            </div>
            <nav class="header-nav">
                <a href="register" class="nav-link">S'inscrire</a>
                <a href="login" class="nav-btn">Se connecter</a>
            </nav>
        </div>
    </header>
    <!-- Formulaire -->
    <main>
      <form class="cz-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="cz-form-group">
          <input type="text" name="firstname" placeholder="Prénom*" required>
        </div>
        <div class="cz-form-group">
          <input type="text" name="lastname" placeholder="Nom*" required>
        </div>
        <div class="cz-form-group">
          <input id="pseudo" type="text" name="pseudo" placeholder="Ajoute ton pseudo*" value="{{ old('pseudo') }}" required>
          @error('pseudo')
              <span>{{ $message }}</span>
          @enderror
        </div>
        <div>
          <label for="avatar">Choisissez un avatar :</label>
          <div>
              @foreach ($availableAvatars as $style)
                  <label>
                      <input type="radio" name="avatar" value="{{ $style }}" {{ old('avatar') === $style ? 'checked' : '' }} required>
                      <img src="https://api.dicebear.com/6.x/{{ $style }}/svg?seed=example" alt="Avatar {{ $style }}" width="60">
                  </label>
              @endforeach
          </div>
      </div>
        <div class="cz-form-group">
          <input type="email" name="email" placeholder="Adresse mail*" required>
        </div>
        <div class="cz-form-group">
          <input type="password" name="password" placeholder="Mot de passe*" required>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="cz-form-group">
          <label for="password_confirmation" class="cz-input-label"></label>
          <input id="password_confirmation" class="cz-text-input block mt-1 w-full" 
                 type="password" 
                 name="password_confirmation" 
                 placeholder="Confirmez le mot de passe*" 
                 required>
          <span class="cz-input-error mt-2">
            @error('password_confirmation') {{ $message }} @enderror
          </span>
        </div>
        <div class="cz-password-info">
          <span>Choisi un mot de passe avec au minimum 8 caractères (majuscules, minuscules, caractères spéciaux)</span>
        </div>
        <div class="cz-checkbox-group">
          <input type="checkbox" id="terms" required>
          <label for="terms">J’accepte les conditions d’utilisation et la politique de confidentialité.</label>
        </div>
        <button type="submit" class="cz-submit-btn">Créer son compte</button>
      </form>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col footer-col-logo">
                <img src="/images/logo-cesizen.png" alt="CESIZEN" class="footer-logo">
                <p class="footer-desc">
                    Vous avez le pouvoir de changer.<br>
                    Faites un pas de plus vers une vie sereine et épanouie.<br>
                    © 2025 CESIZEN
                </p>
            </div>
            <div class="footer-col">
                <h3>CESIZEN</h3>
                <ul>
                    <li><a href="#">Contactez-nous</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>SUIVEZ-NOUS</h3>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Youtube</a></li>
                    <li><a href="#">Linkedin</a></li>
                </ul>
            </div>
        </div>
    </footer>
  </div>
</body>
</html>
