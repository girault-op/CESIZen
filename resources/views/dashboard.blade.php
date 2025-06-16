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

body {
    font-family: 'Filson Pro', sans-serif;
}

.profile-container {
    display: flex;
    margin: 40px;
}

.sidebar {
    background-color: #001870;
    color: white;
    padding: 20px;
    width: 250px;
    border-radius: 20px;
}

.profile-image {
    background-color: white;
    color: #001870;
    height: 180px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
}

.sidebar-link {
    display: block;
    color: white;
    padding: 10px 0;
    text-decoration: none;
    gap: 20px; 
    margin-top: 10px; 
}

.sidebar-link.logout {
    margin-top: 30px;
}

.profile-main {
    flex: 1;
    padding: 0 40px;
}

.profile-main h2 {
    font-family: 'Filson Pro', sans-serif;
    color: #001C6D;
    font-weight: bold; 
    font-size: 36px;
}


.profile-header {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.search-bar {
    display: flex;
    gap: 10px;
    align-items: center;
}

.search-bar input {
    border: 2px solid #001870;
    border-radius: 20px;
    padding: 6px 15px;
}

.description {
    color: #001870;
    font-size: 14px;
    max-width: 800px;
}

.profile-info {
    color: #001C6D; 
    margin-top: 30px;
    border: 4px solid #001870;
    border-radius: 20px;
    padding: 30px;
}

.profile-info h2 {
    margin-top: 0;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px 40px;
    margin-top: 20px;
}

.online-status {
    color: green;
}

.buttons {
    margin-top: 20px;
}

.btn-primary {
    background-color: #001870;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    margin-right: 10px;
}

.btn-secondary {
    background-color: #A8C9F0;
    color: #001870;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
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

.user-avatar_ {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 10px;
}

.user-name {
    font-weight: 
}

.user-pseudo {
    color: blue;
}

.user-profile h2 {
    margin-top: 30px; 
    padding-bottom: 30px; 
    font-size: 21px;
    font-family: 'Filson Pro', sans-serif; 
    font-weight: bold; 
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
      <!-- Logo et tabs -->
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

      <div class="profile-container">
        <aside class="sidebar">
            <div class="user-profile">
                @php
                $isSidebarAvatarExternal = Str::startsWith($user->avatar, 'http');
                $sidebarAvatarPath = $isSidebarAvatarExternal ? $user->avatar : asset('storage/' . $user->avatar);
            @endphp
            <img src="{{ $sidebarAvatarPath }}" alt="Avatar de {{ $user->pseudo }}" class="user-avatar_">
            
                <h2>Bienvenue, {{ $user->pseudo }}</h2>
            </div>
            <nav>
                <a href="#" class="sidebar-link">Mes informations personnelles</a>
                <a href="posts" class="sidebar-link">Accéder aux articles</a>
                <a href="breathing-modes" class="sidebar-link">Accéder à l’exercice de cohérence cardiaque</a>
                <form method="POST" action="{{ route('logout') }}" class="sidebar-link logout" style="display: inline;">
                    @csrf
                    <button class="deconnect" type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;">
                        Se déconnecter
                    </button>
                </form>
            </nav>
        </aside>

          <main class="profile-main">
            <h2>Mes informations personnelles</h2>
            <section class="profile-info">
                @if ($user && $user->created_at)
                    <p><strong>Membre depuis :</strong> {{ $user->created_at->format('F Y') }}</p>
                @else
                    <p><strong>Membre depuis :</strong> Non disponible</p>
                @endif
                <p><strong>Statut :</strong> 
                    @if (Auth::check())
                        <span class="online-status">En ligne ●</span>
                    @else
                        <span class="offline-status">Hors ligne</span>
                    @endif
                </p>
                
                <!-- Affichage des informations personnelles -->
                <div class="info-grid">
                    <div><strong>Nom :</strong> {{ $user->lastname }}</div>
                    <div><strong>Adresse mail :</strong> {{ $user->email }}</div>
                    <div><strong>Prénom :</strong> {{ $user->firstname }}</div>
                    <div><strong>Pseudo :</strong> <span class="pseudo-highlight">{{ $user->pseudo }}</span></div>
                    <div><strong>Rôle :</strong> {{ $user->role }}</div>
                    <div><strong>Mot de passe :</strong> ********</div>
                    <div><strong>Avatar :</strong><br>
                        @php
    $isAvatarExternal = Str::startsWith($user->avatar, 'http');
    $avatarPath = $isAvatarExternal ? $user->avatar : asset('storage/' . $user->avatar);
@endphp
<img src="{{ $avatarPath }}" class="user-avatar-small" alt="Avatar de {{ $user->pseudo }}">

                    </div>
                </div>
        
                <!-- Boutons d'action -->
                <div class="buttons">
                    <button class="btn-primary" id="edit-profile-btn">Modifier mon profil</button>
                    <button class="btn-secondary">Supprimer mon profil</button>
                </div>
        
                <!-- Formulaire de modification (caché par défaut) -->
                <form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST" style="display: none; margin-top: 20px;">
                    @csrf
                    @method('PATCH') 
        
                    <div class="form-group">
                        <label for="firstname">Prénom :</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $user->firstname }}" required>
                    </div>
        
                    <div class="form-group">
                        <label for="lastname">Nom :</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $user->lastname }}" required>
                    </div>
                    @php
                    $availableAvatars = ['adventurer', 'bottts', 'micah'];
                    @endphp
                   <div class="form-group">
                    <label for="avatar">Choisir un style d’avatar :</label>
                    <select id="avatar" name="avatar" class="form-control" onchange="updateAvatarPreview()">
                        @foreach($availableAvatars as $style)
                            <option value="{{ $style }}" {{ $user->avatar && str_contains($user->avatar, $style) ? 'selected' : '' }}>
                                {{ ucfirst($style) }}
                            </option>
                        @endforeach
                    </select>
                    @php
                    $isAvatarExternal = Str::startsWith($user->avatar, 'http');
                    $avatarPreviewPath = $isAvatarExternal ? $user->avatar : asset('storage/' . $user->avatar);
                @endphp
                <img id="avatar-preview" src="{{ $avatarPreviewPath }}" alt="Aperçu de l'avatar" style="max-width: 100px; margin-top: 10px;">
                
                </div>
                    <div class="form-group">
                        <label for="pseudo">Pseudo :</label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control" value="{{ $user->pseudo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse mail :</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
        
                    <div class="form-group">
                        <label for="current_password">Mot de passe actuel</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                        @error('current_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input type="password" name="new_password" id="new_password" class="form-control">
                        @error('new_password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                    <button type="button" class="btn-secondary" id="cancel-edit-btn">Annuler</button>
                </form>
                <script>
                    function updateAvatarPreview() {
                        const select = document.getElementById('avatar');
                        const pseudo = document.getElementById('pseudo').value || 'default';
                        const preview = document.getElementById('avatar-preview');
                        preview.src = `https://api.dicebear.com/6.x/${select.value}/svg?seed=${pseudo}`;
                    }
                    document.getElementById('pseudo').addEventListener('input', updateAvatarPreview);
                    </script>
                            
        <script>
            // Gestion de l'affichage du formulaire
            document.getElementById('edit-profile-btn').addEventListener('click', function () {
                document.getElementById('edit-profile-form').style.display = 'block';
            });
        
            // Gestion du bouton "Annuler"
            document.getElementById('cancel-edit-btn').addEventListener('click', function () {
                document.getElementById('edit-profile-form').style.display = 'none';
            });
        </script>
        </div>
        </div>
    </section>
</main>
<section class="mt-12">
    <h2>Statistiques cohérence cardiaque</h2>
    <p>Nombre total de sessions : {{ $totalSessions }}</p>
    <p>Durée totale : {{ $totalDuration }} secondes</p>

    @if($lastSession)
      <p>Dernière session : {{ $lastSession->created_at->diffForHumans() }}</p>
    @endif

    <h3>Par mode :</h3>
    <ul>
      @foreach ($sessionsByMode as $stat)
        <li>{{ $stat->mode->label }} : {{ $stat->total }} sessions</li>
      @endforeach
    </ul>

    <h3>Évolution mensuelle :</h3>
    <canvas id="monthlySessionsChart" width="400" height="200"></canvas>
    <!-- Chart.js d'abord -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Ensuite ton script -->
<script>
  const ctx = document.getElementById('monthlySessionsChart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($sessionsByMonth->pluck('month')),
      datasets: [{
        label: 'Sessions par mois',
        data: @json($sessionsByMonth->pluck('total')),
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
  </section>

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
</main>
</div>
</div>
</body>
</html>