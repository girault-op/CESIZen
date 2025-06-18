<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js') 
  <title>Dashboard - CESIZEN</title>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <style>
</head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            font-family: 'Filson Pro', sans-serif;
        }


.sidebar {
    background-color: #001870;
    color: white;
    padding: 20px;
    width: 250px;
    border-radius: 20px;
}
        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: bold;
            color: #1e3a8a;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            padding: 4rem 2rem;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            color: #1e3a8a;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero p {
            color: #374151;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        /* Search Section */
        .search-section {
            background: white;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: -2rem auto 3rem;
            max-width: 600px;
            border-radius: 15px;
            position: relative;
            z-index: 10;
        }

        .search-container {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: #1e3a8a;
        }

        .search-btn {
            background:  #1e3a8a;;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .search-btn:hover {
            background:  #1e3a8a;
        }

        /* Posts Grid */
        .posts-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .post-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .post-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #bfdbfe, #93c5fd);
            position: relative;
            overflow: hidden;
        }

        .post-image::after {
            content: '🧘‍♀️';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
        }

        .post-content {
            padding: 1.5rem;
        }

        .post-category {
            display: inline-block;
            background:  #1e3a8a;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .post-title {
            color: #1e3a8a;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .post-excerpt {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #9ca3af;
            font-size: 0.85rem;
        }

        .post-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .read-time {
            background: #f3f4f6;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 3rem;
        }

        .pagination a,
        .pagination span {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #1e3a8a;
            color: white;
        }

        .pagination .current {
            background: #1e3a8a;
            color: white;
        }

        /* Filter Tags */
        .filter-section {
            margin-bottom: 2rem;
            text-align: center;
        }

        .filter-tags {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .filter-tag {
            background: white;
            color: #374151;
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-tag:hover,
        .filter-tag.active {
            background: #1e3a8a;
            color: white;
            border-color: #1e3a8a;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #374151;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .search-container {
                flex-direction: column;
            }
            
            .posts-grid {
                grid-template-columns: 1fr;
            }
            
            .filter-tags {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.5rem;
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

.deconnect {
    margin-top: 20px; 
}
        }
    </style>
</head>
<body>
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
                  @php
                  $isHeaderAvatarExternal = Str::startsWith(Auth::user()->avatar, 'http');
                  $headerAvatarPath = $isHeaderAvatarExternal ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar);
              @endphp
              <img src="{{ $headerAvatarPath }}" alt="Avatar de {{ Auth::user()->pseudo }}" class="user-avatar">                
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Tous nos Articles</h1>
            <p>Découvrez notre collection d'articles pour un quotidien plus serein et équilibré</p>
        </div>
    </section>

    <!-- Search Section -->
    <div class="posts-container">
        <div class="search-section">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Rechercher un article..." id="searchInput">
                <button class="search-btn" onclick="searchPosts()">Rechercher</button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-tags">
                <span class="filter-tag active" onclick="filterPosts('all')">Tous</span>
                <span class="filter-tag" onclick="filterPosts('meditation')">Méditation</span>
                <span class="filter-tag" onclick="filterPosts('nutrition')">Nutrition</span>
                <span class="filter-tag" onclick="filterPosts('exercice')">Exercice</span>
                <span class="filter-tag" onclick="filterPosts('sommeil')">Sommeil</span>
                <span class="filter-tag" onclick="filterPosts('mindfulness')">Pleine conscience</span>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="posts-grid" id="postsGrid">
            <!-- Article 1 -->
            <article class="post-card" data-category="meditation">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Méditation</span>
                    <h3 class="post-title">Commencer la méditation : guide pour débutants</h3>
                    <p class="post-excerpt">Découvrez les bases de la méditation et comment intégrer cette pratique bienfaisante dans votre quotidien...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 15 juin 2025</span>
                        <span class="read-time">5 min</span>
                    </div>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="post-card" data-category="nutrition">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Nutrition</span>
                    <h3 class="post-title">Alimentation équilibrée : les fondamentaux</h3>
                    <p class="post-excerpt">Les clés d'une alimentation saine et équilibrée pour nourrir votre corps et votre esprit...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 14 juin 2025</span>
                        <span class="read-time">7 min</span>
                    </div>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="post-card" data-category="exercice">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Exercice</span>
                    <h3 class="post-title">Yoga matinal : routine de 15 minutes</h3>
                    <p class="post-excerpt">Une séquence de yoga douce pour bien commencer la journée et réveiller votre corps en douceur...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 13 juin 2025</span>
                        <span class="read-time">4 min</span>
                    </div>
                </div>
            </article>

            <!-- Article 4 -->
            <article class="post-card" data-category="sommeil">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Sommeil</span>
                    <h3 class="post-title">Améliorer la qualité de votre sommeil</h3>
                    <p class="post-excerpt">Techniques et conseils pour un sommeil réparateur et des nuits plus sereines...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 12 juin 2025</span>
                        <span class="read-time">6 min</span>
                    </div>
                </div>
            </article>

            <!-- Article 5 -->
            <article class="post-card" data-category="mindfulness">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Pleine conscience</span>
                    <h3 class="post-title">Vivre l'instant présent au quotidien</h3>
                    <p class="post-excerpt">Comment cultiver la pleine conscience dans vos activités quotidiennes pour plus de sérénité...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 11 juin 2025</span>
                        <span class="read-time">5 min</span>
                    </div>
                </div>
            </article>

            <!-- Article 6 -->
            <article class="post-card" data-category="meditation">
                <div class="post-image"></div>
                <div class="post-content">
                    <span class="post-category">Méditation</span>
                    <h3 class="post-title">Méditation guidée pour la gestion du stress</h3>
                    <p class="post-excerpt">Une pratique méditative spécialement conçue pour apaiser l'anxiété et retrouver la paix intérieure...</p>
                    <div class="post-meta">
                        <span class="post-date">📅 10 juin 2025</span>
                        <span class="read-time">8 min</span>
                    </div>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <a href="#" onclick="changePage(1)">« Précédent</a>
            <span class="current">1</span>
            <a href="#" onclick="changePage(2)">2</a>
            <a href="#" onclick="changePage(3)">3</a>
            <a href="#" onclick="changePage(2)">Suivant »</a>
        </div>
    </div>

    <script>
        // Variables globales
        let currentFilter = 'all';
        let currentPage = 1;
        let allPosts = [];

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            allPosts = Array.from(document.querySelectorAll('.post-card'));
            
            // Ajouter les événements de clic sur les articles
            allPosts.forEach(post => {
                post.addEventListener('click', function() {
                    // Ici vous pouvez rediriger vers l'article complet
                    console.log('Clic sur article:', this.querySelector('.post-title').textContent);
                    // window.location.href = '/posts/' + postId;
                });
            });
        });

        // Fonction de recherche
        function searchPosts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const posts = document.querySelectorAll('.post-card');
            let visibleCount = 0;

            posts.forEach(post => {
                const title = post.querySelector('.post-title').textContent.toLowerCase();
                const excerpt = post.querySelector('.post-excerpt').textContent.toLowerCase();
                const category = post.querySelector('.post-category').textContent.toLowerCase();
                
                const matches = title.includes(searchTerm) || 
                               excerpt.includes(searchTerm) || 
                               category.includes(searchTerm);
                
                if (matches && (currentFilter === 'all' || post.dataset.category === currentFilter)) {
                    post.style.display = 'block';
                    visibleCount++;
                } else {
                    post.style.display = 'none';
                }
            });

            toggleEmptyState(visibleCount === 0);
        }

        // Fonction de filtrage
        function filterPosts(category) {
            currentFilter = category;
            
            // Mettre à jour les tags actifs
            document.querySelectorAll('.filter-tag').forEach(tag => {
                tag.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filtrer les posts
            const posts = document.querySelectorAll('.post-card');
            let visibleCount = 0;

            posts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                    visibleCount++;
                } else {
                    post.style.display = 'none';
                }
            });

            toggleEmptyState(visibleCount === 0);
            
            // Réinitialiser la recherche si nécessaire
            document.getElementById('searchInput').value = '';
        }

        // Fonction pour afficher/masquer l'état vide
        function toggleEmptyState(show) {
            let emptyState = document.querySelector('.empty-state');
            
            if (show && !emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.innerHTML = `
                    <h3>Aucun article trouvé</h3>
                    <p>Essayez de modifier vos critères de recherche ou de filtrage.</p>
                `;
                document.getElementById('postsGrid').appendChild(emptyState);
            } else if (!show && emptyState) {
                emptyState.remove();
            }
        }

        // Fonction de pagination
        function changePage(page) {
            currentPage = page;
            console.log('Changement vers la page:', page);
            // Ici vous pouvez implémenter la logique de pagination côté serveur
            // window.location.href = '/posts?page=' + page;
        }

        // Recherche en temps réel
        document.getElementById('searchInput').addEventListener('input', function() {
            if (this.value.length > 2 || this.value.length === 0) {
                searchPosts();
            }
        });

        // Recherche avec Entrée
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchPosts();
            }
        });
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
</html>