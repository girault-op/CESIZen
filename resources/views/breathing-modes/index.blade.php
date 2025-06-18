<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Exercice de cohérence cardiaque - CESIZen</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js') 
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
body {
  background-color: #ffffff;
  color: #00008F;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

h1 {
  font-size: 32px;
  margin-bottom: 10px;
}

p#current-action {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 20px;
}

/* === Barres de respiration === */
.bar-container {
  width: 60px;
  height: 300px;
  background-color: #e0e0e0;
  border-radius: 30px;
  overflow: hidden;
  display: flex;
  margin: auto;
  flex-direction: column-reverse;
  margin-bottom: 30px;
}

.bar-progress {
  background-color: #0033cc;
  width: 100%;
  height: 0%;
  transition: height 1s ease-in-out;
}

/* === Boutons === */
.buttons {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
  justify-content: center;
}

button,
.buttons button {
  background-color: #69C3FF;
  color: #00008F;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  border-radius: 25px;
  cursor: pointer;
  font-weight: 600;
  transition: background-color 0.3s;
}

button:hover,
.buttons button:hover {
  background-color: #4ea7e5;
  color: #ffffff;
}

/* === Wrapper principal === */
.coherence-wrapper {
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center; 
}
/* === Footer cohérent avec site === */

.footer {
    padding: 48px 0 24px;
    margin-top: 64px;
}

.footer-container {
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 100px;
    padding: 0 24px;
}

.footer-col {
    min-width: 180px;
    text-align: left; 
}

.footer-col-logo {
    min-width: 220px;
}

.footer-logo {
    height: 90px;
    margin-bottom: 16px;
}

.footer-desc {
    font-size: 1rem;
    color: #001C6D;
    margin-bottom: 0;
    line-height: 1.5;
}

.footer-col h3 {
    color: #001C6D;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 14px;
    letter-spacing: 1px;
}

.footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-col ul li {
    margin-bottom: 10px;
}

.footer-col ul li a {
    color: #001C6D;
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.2s;
}

.footer-col ul li a:hover {
    color: #1400a7;
}

.deconnect {
    margin-top: 20px; 
}

@media (max-width: 900px) {
    .hero-content,
    .footer-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 32px;
    }

    .hero-image,
    .hero-text {
        max-width: 100%;
    }

    .footer-col,
    .footer-col-logo {
        min-width: 0;
        width: 100%;
    }

    .image-placeholder {
        width: 100%;
        height: 220px;
        font-size: 1.2rem;
    }
}

@media (max-width: 768px) {
    .footer-container {
        text-align: center;
        gap: 50px;
    }

    .footer-logo {
        padding-bottom: 20px;
        width: 100px;
        height: 160px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }

    .articles-actions {
        gap: 20px;
    }
}

  </style>
</head>
<body class="font-sans text-[#0A0F3D]">
  <div class="container mx-auto px-8 lg:px-20"> 
  <div class="container">

<header class="main-header">
  <div class="header-content">
      <div class="logo-title">
        <a href="/">
            <img src="{{ asset('images/logo-cesizen.png') }}" alt="CESIZEN" class="logo">
        </a>
      </div>
      <nav class="header-nav">
        @if(Auth::check())
          <div class="user-info">
            <img src="{{ Auth::user()->avatar }}" alt="Avatar de {{ Auth::user()->pseudo }}" class="user-avatar">
              <span class="user-name">{{ Auth::user()->first_name }}</span>
              <span class="user-pseudo">{{ Auth::user()->pseudo }}</span>
          </div>
        @else
        <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
        <a href="{{ route('login') }}" class="nav-btn">Se connecter</a>
        @endif
      </nav>
  </div>
</header>

<div class="coherence-wrapper">
  <h1>Exercice de cohérence cardiaque</h1>
  <p id="current-action">Cliquez sur un bouton pour commencer</p>
  <div class="bar-container">
    <div id="progression" class="bar-progress"></div>
  </div>

  <div class="buttons">
    <button onclick="doExercise('s748')">Mode 7-4-8</button>
    <button onclick="doExercise('s55')">Mode 5-5</button>
    <button onclick="doExercise('s46')">Mode 4-6</button>
  </div>

  <script>
    const modes = {
      s748: { inspirationTime: 7, apneaTime: 4, exhalationTime: 8 },
      s55:  { inspirationTime: 5, apneaTime: 0, exhalationTime: 5 },
      s46:  { inspirationTime: 4, apneaTime: 0, exhalationTime: 6 }
    };

    function doExercise(solution, repetitions = 3) {
      const mode = modes[solution];
      const currentAction = document.getElementById("current-action");
      const progressBar = document.getElementById("progression");
      let height = 0;
      let currentRep = 0;

      currentAction.innerText = "Préparez-vous à commencer l'exercice...";
      setTimeout(() => cycle(), 2000);

      function cycle() {
        if (currentRep >= repetitions) {
          currentAction.innerText = "Exercice terminé. Bravo !";
          return;
        }
        currentRep++;
        inspiration();
      }

      function inspiration() {
        let t = 0;
        currentAction.innerText = `Inspirez... (Répétition ${currentRep}/${repetitions})`;
        const i = setInterval(() => {
          height += 100 / mode.inspirationTime;
          progressBar.style.height = height + '%';
          t++;
          if (t >= mode.inspirationTime) {
            clearInterval(i);
            apnea();
          }
        }, 1000);
      }

      function apnea() {
        currentAction.innerText = "Rétention (apnée)...";
        setTimeout(() => exhalation(), mode.apneaTime * 1000);
      }

      function exhalation() {
        let t = 0;
        currentAction.innerText = "Expirez...";
        const e = setInterval(() => {
          height -= 100 / mode.exhalationTime;
          if (height < 0) height = 0;
          progressBar.style.height = height + '%';
          t++;
          if (t >= mode.exhalationTime) {
            clearInterval(e);
            setTimeout(() => cycle(), 1000);
          }
        }, 1000);
      }
    }
  </script>
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
    </body>      
      
