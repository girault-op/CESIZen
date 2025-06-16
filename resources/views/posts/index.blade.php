<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Articles sur le bien-être</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .header {
            background: linear-gradient(135deg, #A8E6CF, #DCEDC1);
            padding: 50px 0;
            text-align: center;
        }
        .header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.2rem;
            color: #444;
        }
        .search-bar {
            max-width: 600px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            padding: 0 20px;
        }
        .search-bar input {
            flex: 1;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-bar button {
            padding: 10px 20px;
            background: #009688;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .search-bar button:hover {
            background: #00796B;
        }
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }
        .post-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s;
        }
        .post-card:hover {
            transform: translateY(-4px);
        }
        .post-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .post-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .post-category {
            display: inline-block;
            font-size: 0.85rem;
            color: #fff;
            background: #8BC34A;
            padding: 4px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            align-self: flex-start;
        }
        .post-title {
            margin: 0;
            font-size: 1.5rem;
            color: #333;
        }
        .post-description {
            margin: 10px 0;
            color: #555;
            flex-grow: 1;
        }
        .post-meta {
            font-size: 0.8rem;
            color: #999;
        }
        .read-more {
            text-decoration: none;
            background: #009688;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            transition: background 0.3s ease;
        }
        .read-more:hover {
            background: #00796B;
        }
        p.no-articles {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-top: 40px;
        }
    </style>
</head>
<body>
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

    <div class="header">
        <h1>Nos Articles sur le Bien-être</h1>
        <p>Votre compagnon pour un quotidien plus serein et équilibré</p>
    </div>

    <form class="search-bar" action="{{ route('posts.index') }}" method="GET">
        <input type="text" name="search" placeholder="Rechercher un article..." value="{{ request('search') }}" />
        <button type="submit">Rechercher</button>
    </form>
    
<div class="posts-grid">
    @forelse($posts as $post)
    <article class="post-card">
        <img src="{{ $post->picture ?? 'https://source.unsplash.com/600x400/?' . ($post->category->label ?? 'wellness') }}" alt="{{ $post->title }}" class="post-image" />
        <div class="post-content">
            <span class="post-category">{{ $post->category->label ?? 'Sans catégorie' }}</span>
            <h2 class="post-title">{{ $post->title }}</h2>
            <p class="post-description">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
            <div class="post-meta">Publié le {{ $post->created_at->format('d/m/Y') }}</div>
            <a href="{{ route('posts.show', $post) }}" class="read-more">Lire l'article</a>
        </div>
    </article>
    @empty
        <p style="text-align:center;">Aucun article trouvé.</p>
    @endforelse
</div>

    <!-- Si pas d'article -->
    <!-- <p class="no-articles">Aucun article trouvé.</p> -->

    <div style="max-width: 1200px; margin: 20px auto; padding: 0 40px; text-align:center;">
        <!-- Pagination (à intégrer dynamiquement) -->
        <a href="#" style="margin:0 5px; text-decoration:none; color:#009688;">&laquo; Précédent</a>
        <a href="#" style="margin:0 5px; text-decoration:none; color:#009688;">1</a>
        <a href="#" style="margin:0 5px; text-decoration:none; color:#009688;">2</a>
        <a href="#" style="margin:0 5px; text-decoration:none; color:#009688;">3</a>
        <a href="#" style="margin:0 5px; text-decoration:none; color:#009688;">Suivant &raquo;</a>
    </div>

</body>
</html>
