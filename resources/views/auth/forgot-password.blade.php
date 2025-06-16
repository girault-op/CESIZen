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
    main {
      width: 100%;
      display: flex;
      justify-content: center;
    }
    
    body {
      font-family: 'Filson Pro', sans-serif;
      background: white;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .password-reset-container {
      text-align: center;
      max-width: 500px;
      width: 100%;
      padding: 20px;
    }

    .password-reset-container h1 {
      font-size: 28px;
      font-weight: 800;
      color: #0d0c6b;
      margin-bottom: 10px;
    }

    .password-reset-container p {
      font-size: 14px;
      color: #2b2b2b;
      margin-bottom: 30px;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 8px;
      font-weight: 600;
      color: #0d0c6b;
    }

    input[type="email"] {
      width: 100%;
      padding: 14px;
      border-radius: 12px;
      border: none;
      background-color: #f0f0f0;
      font-size: 14px;
      margin-bottom: 20px;
    }

    button {
      background-color: #0d0c6b;
      color: white;
      border: none;
      border-radius: 999px;
      padding: 14px 24px;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 100%;
      margin-bottom: 15px;
    }

    button:hover {
      background-color: #060547;
    }

    a {
      color: #0d0c6b;
      font-size: 14px;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .success-message {
      display: none;
      background-color: #e0f7e9;
      color: #176c3f;
      padding: 12px;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 15px;
      animation: fadeInOut 5s ease forwards;
    }

    @keyframes fadeInOut {
      0% { opacity: 0; }
      10% { opacity: 1; }
      90% { opacity: 1; }
      100% { opacity: 0; }
    }
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

      <main>
      <div class="password-reset-container">
        <h1>Mot de passe oublié ?</h1>
        <p>Pas de souci. Indique-nous ton adresse e-mail,<br>et nous t’enverrons un lien pour choisir un nouveau mot de passe.</p>
    
        <div class="success-message" id="successMessage">
          ✅ Un lien a été envoyé à votre adresse e-mail.
        </div>
    
        <form id="resetForm">
          <label for="email">Adresse e-mail</label>
          <input type="email" id="email" name="email" placeholder="exemple@domaine.com" required>
          <button type="submit">Envoyer le lien</button>
        </form>
    
        <a href="login.html">Retour à la connexion</a>
      </div>
      <script>
        document.getElementById('resetForm').addEventListener('submit', function (e) {
          e.preventDefault();
          const message = document.getElementById('successMessage');
          message.style.display = 'block';
    
          // Optionnel : réinitialiser le champ
          this.reset();
    
          // Masquer le message après 5 secondes
          setTimeout(() => {
            message.style.display = 'none';
          }, 5000);
        });
      </script>
    </main>
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

  <!-- Alpine.js pour la gestion des messages (optionnel) -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>