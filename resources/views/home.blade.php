<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESIZEN</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js') 
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <!-- important pour lier tailwind -->
    <style>
.hero-section {
    margin: 0 auto;
    padding: 48px 24px;
}

.hero-content {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    align-items: center;
    justify-content: space-between;
}

.hero-text {
    flex: 1 1 380px;
    max-width: 540px;
}

.hero-text h1 {
    font-size: 48px;
    font-weight: 700;
    color: #001C6D;
    margin-bottom: 24px;
    line-height: 1.1;
    font-family: "Filson Pro", sans-serif;
}

.hero-text p {
    font-size: 20px;
    color: #001C6D;
    margin-bottom: 24px;
    line-height: 1.6;
    font-family: "Catamaran", sans-serif;
}

.cta-btn {
    display: inline-block;
    background: #8ACDFF;
    color: #001C6D;
    font-weight: 700;
    padding: 12px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 1.1rem;
    border: none;
    transition: background 0.2s;
    box-shadow: 0 2px 8px #e6f2ff;
}

.cta-btn:hover {
    background: #7fc8f8;
}

.hero-image {
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-placeholder {
    width: 340px;
    height: 340px;
    background: #0a1a9c;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 2rem;
    text-align: center;
    font-weight: 700;
    box-shadow: 0 2px 16px #e6f2ff;
}

.hero-img-real {
    width: 400px;
    border-radius: 24px;
    object-fit: cover;
    box-shadow: 0 2px 16px #e6f2ff;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-name {
    font-weight: 
}

.user-pseudo {
    color: blue;
}

.user-avatar-small {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}
.pseudo-highlight {
    font-weight: bold;
    color: #4A90E2;
}

/* Responsive mobile */
@media (max-width: 900px) {
    .hero-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .hero-text {
        align-items: center;
        display: flex;
        flex-direction: column;
    }

    .hero-text h1 {
        font-size: 48px;
        color: #0a1a9c;
    }

    .hero-image {
        width: 100%;
        justify-content: center;
    }

    .image-placeholder,
    .hero-img-real {
        height: 300px;
        font-size: 1.2rem;
    }
}

.main-header {
    padding: 32px 0 0;
    width: 100%;
}

.header-content {
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    padding: 0 24px;
}

.logo-title {
    display: flex;
    align-items: center;
}

.logo {
    height: 100px;
}

.header-nav {
    display: flex;
    align-items: center;
    gap: 30px;
    font-family: "Filson Pro", sans-serif;
}

.nav-link {
    color: #001C6D;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    margin-right: 10px;
    background: none;
    border: none;
    padding: 0;
}

.nav-btn {
    background: #001C6D;
    color: #fff;
    padding: 10px 28px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    border: none;
    transition: background 0.2s;
    cursor: pointer;
}

.nav-btn:hover {
    background: #001489;
}

@media (max-width: 700px) {
    .header-content {
        flex-direction: column;
        align-items: center;
        gap: 18px;
    }

    .logo-title {
        justify-content: center;
        width: 300px;
    }

    .header-nav {
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }

    .nav-link,
    .nav-btn {
        max-width: 320px;
        text-align: center;
        margin: 0;
    }
}

.articles-section {
    max-width: 900px;
    margin: 64px auto 0;
    text-align: center;
    padding: 0 24px;
}

.articles-section h2 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #1400a7;
    margin-bottom: 18px;
    line-height: 1.15;
}

.articles-section p {
    color: #001489;
    margin-bottom: 32px;
    font-size: 1rem;
    line-height: 1.6;
}

.articles-actions {
    display: flex;
    justify-content: center;
    gap: 100px;
    flex-wrap: wrap;
}

.article-btn,
.exercise-btn {
    display: inline-block;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    border: none;
}

.article-btn {
    background: #8ACDFF;
    color: #001C6D;
    font-family: "Filson Pro", sans-serif;
    font-size: 20px;
}

.article-btn:hover {
    background: #6cb6e6;
}

.exercise-btn {
    background: #001C6D;
    color: #fff;
    font-family: "Filson Pro", sans-serif;
    font-size: 20px;
}

.exercise-btn:hover {
    background: #001489;
}

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

    <!-- Header -->
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
                        <span class="user-name" style="font-weight: bold;">{{ Auth::user()->first_name }}</span>
                        <span class="user-pseudo">{{ Auth::user()->pseudo }}</span>
                        <br>
                        <a href="{{ route('dashboard') }}" class="nav-link">Mon espace</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-btn" style="background: none; border: none; color: inherit; cursor: pointer;">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                    <a href="{{ route('login') }}" class="nav-btn">Se connecter</a>
                @endif
            </nav>
        </div>
    </header>
    

    <!-- Affichage conditionnel basé sur l'authentification -->

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>
                    Faites un pas de<br>
                    plus vers une vie<br>
                    sereine et épanouie
                </h1>
                <p>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                </p>
                <a href="#" class="cta-btn">Rejoins l'aventure !</a>
            </div>
            <div class="hero-image">
                <!-- Remplace l'image ici par la tienne si besoin -->
                <img src="images/image-breathing.png" alt="Illustration" class="hero-img-real">
            </div>
        </div>
    </section>


    <!-- Section Articles -->
    <section class="flex flex-col md:flex-row items-center justify-center p-6 md:p-8 space-y-8 md:space-y-0" style="padding-top: 80px";>
        <div class="md:w-1/2 text-center md:text-left space-y-4">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight" style="font-family: 'Filson Pro', sans-serif; font-size: 48px; color: #001C6D; text-align: center;">
                Lorem ipsum dolor sit amet consectetur adipiscing
            </h1>
            <p class="text-gray-600 text-lg md:text-xl text-center" style="font-family: 'Filson Pro', sans-serif; font-size: 20px; color: #001C6D; margin-bottom: 40px; margin-top: 40px;">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
                fugiat nulla pariatur."
            </p>
                <div class="articles-actions">
                    <a href="#" class="article-btn">Découvrez les articles</a>
                    <a href="#" class="exercise-btn">Tester notre exercice</a>
                </div>
        </div>
    </section>
    
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
    </body>      
      
      
      