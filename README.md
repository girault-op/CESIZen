# 🚀 Guide Complet d'Installation Laravel

Ce guide vous accompagne pas à pas dans l'installation et la configuration d'un environnement de développement Laravel complet sur Ubuntu/Debian.

## 🔧 Prérequis système

Avant de commencer, assurez-vous d'avoir :

- **Système d'exploitation** : Ubuntu 20.04+ ou Debian 10+
- **Droits administrateur** : accès sudo
- **Connexion Internet** : pour télécharger les paquets
- **Espace disque** : minimum 2 Go disponibles

### Spécifications techniques requises :
- **PHP** : Version 8.1 ou supérieure
- **Serveur web** : Apache 2.4+ ou Nginx 1.18+
- **Base de données** : MariaDB 10.3+ ou MySQL 8.0+
- **Mémoire** : 512 Mo RAM minimum (2 Go recommandé)

## 🛠 Installation des composants

### 1. Mise à jour du système

```bash
# Mise à jour des paquets système
sudo apt update
sudo apt upgrade -y
```

### 2. Installation de PHP et extensions

**Installation de PHP 8.1+ avec toutes les extensions nécessaires :**

```bash
sudo apt install php php-cli php-mbstring php-xml php-bcmath php-curl php-mysql php-tokenizer php-zip php-json php-gd php-intl php-soap php-xmlrpc unzip curl
```

**Détail des extensions PHP :**
- `php-cli` : Interface en ligne de commande PHP
- `php-mbstring` : Support des chaînes multi-octets
- `php-xml` : Support XML
...

**Vérification de l'installation PHP :**
```bash
php -v
php -m  # Liste des modules installés
```

**Configuration PHP recommandée :**
```bash
# Éditer le fichier de configuration PHP
sudo nano /etc/php/8.1/cli/php.ini

# Paramètres recommandés :
# memory_limit = 256M
# max_execution_time = 300
# upload_max_filesize = 20M
# post_max_size = 20M
```

### 3. Installation du serveur web

#### Option A : Apache

**Installation d'Apache avec module PHP :**
```bash
sudo apt install apache2 libapache2-mod-php
```

**Configuration et démarrage :**
```bash
# Démarrage et activation au boot
sudo systemctl start apache2
sudo systemctl enable apache2

# Vérification du statut
sudo systemctl status apache2

# Activation du module de réécriture (requis pour Laravel)
sudo a2enmod rewrite

# Redémarrage d'Apache
sudo systemctl restart apache2
```

**Configuration d'un Virtual Host pour Laravel :**
```bash
# Créer un fichier de configuration
sudo nano /etc/apache2/sites-available/laravel.conf
```

```apache
<VirtualHost *:80>
    ServerName laravel.local
    DocumentRoot /var/www/laravel/public
    
    <Directory /var/www/laravel/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/laravel_error.log
    CustomLog ${APACHE_LOG_DIR}/laravel_access.log combined
</VirtualHost>
```

```bash
# Activer le site
sudo a2ensite laravel.conf
sudo systemctl reload apache2
```

#### Option B : Nginx + PHP-FPM

**Installation de Nginx et PHP-FPM :**
```bash
sudo apt install nginx php-fpm
```

**Configuration et démarrage :**
```bash
# Démarrage des services
sudo systemctl start nginx
sudo systemctl enable nginx
sudo systemctl start php8.1-fpm
sudo systemctl enable php8.1-fpm

# Vérification des statuts
sudo systemctl status nginx
sudo systemctl status php8.1-fpm
```

**Configuration Nginx pour Laravel :**
```bash
# Créer un fichier de configuration
sudo nano /etc/nginx/sites-available/laravel
```

```nginx
server {
    listen 80;
    server_name laravel.local;
    root /var/www/laravel/public;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

```bash
# Activer le site
sudo ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/
sudo nginx -t  # Test de la configuration
sudo systemctl reload nginx
```

### 4. Installation de la base de données MariaDB

**Installation de MariaDB :**
```bash
sudo apt install mariadb-server mariadb-client
```

**Sécurisation de l'installation :**
```bash
sudo mysql_secure_installation
```

**Création de la base de données et utilisateur :**
```bash
sudo mysql -u root -p
```

```sql
-- Créer la base de données
CREATE DATABASE cesizen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Créer un utilisateur dédié
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'mot_de_passe_securise';

-- Accorder les privilèges
GRANT ALL PRIVILEGES ON cesizen.* TO 'laravel_user'@'localhost';

-- Actualiser les privilèges
FLUSH PRIVILEGES;

-- Quitter
EXIT;
```

**Vérification de la connexion :**
```bash
mysql -u laravel_user -p cesizen
```

### 5. Installation de Composer

**Téléchargement et installation :**
```bash
# Télécharger l'installateur
curl -sS https://getcomposer.org/installer | php

# Déplacer vers le répertoire global
sudo mv composer.phar /usr/local/bin/composer

# Rendre exécutable
sudo chmod +x /usr/local/bin/composer

# Vérifier l'installation
composer --version
```

### 6. Installation de Node.js et npm

**Installation via NodeSource (version LTS recommandée) :**
```bash
# Ajouter le repository NodeSource
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -

# Installer Node.js et npm
sudo apt install nodejs

# Vérifier les versions
node -v
npm -v
```

## ⚙️ Configuration du projet Laravel

### 1. Création d'un nouveau projet Laravel

```bash
# Naviguer vers le répertoire web
cd /var/www

# Créer le projet Laravel
sudo composer create-project laravel/laravel cesizen

# Changer le propriétaire du répertoire
sudo chown -R $USER:$USER /var/www/cesizen

# Définir les permissions appropriées
sudo chmod -R 755 /var/www/cesizen
sudo chmod -R 775 /var/www/cesizen/storage
sudo chmod -R 775 /var/www/cesizen/bootstrap/cache

# Naviguer dans le projet
cd cesizen
```

### 2. Configuration de l'environnement

**Copie du fichier de configuration :**
```bash
cp .env.example .env
```

**Génération de la clé d'application :**
```bash
php artisan key:generate
```

**Configuration du fichier `.env` :**
```bash
nano .env
```

**Paramètres de base de données :**
```env
APP_NAME=Cesizen
APP_ENV=local
APP_KEY=base64:... # Généré automatiquement
APP_DEBUG=true
APP_URL=http://laravel.local

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cesizen
DB_USERNAME=root
DB_PASSWORD=mot_de_passe_securise

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Installation des dépendances

**Installation des dépendances PHP :**
```bash
composer install --optimize-autoloader
```

**Installation des dépendances front-end :**
```bash
npm install
```

**Compilation des assets (développement) :**
```bash
npm run dev
```

**Compilation des assets (production) :**
```bash
npm run build
```

### 4. Configuration de la base de données

**Test de connexion :**
```bash
php artisan migrate:status
```

**Exécution des migrations :**
```bash
php artisan migrate
```

**Seeders (optionnel) :**
```bash
php artisan db:seed
```

**Migration avec seeders :**
```bash
php artisan migrate:fresh --seed
```

### 5. Configuration du serveur de développement

**Lancement du serveur Artisan :**
```bash
php artisan serve
```

**Lancement sur une adresse spécifique :**
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## ✅ Vérification de l'installation

### Tests de base

**1. Vérification de la page d'accueil :**
```bash
curl http://localhost:8000
```

**2. Vérification de la base de données :**
```bash
php artisan migrate:status
```

**3. Vérification des routes :**
```bash
php artisan route:list
```

**4. Vérification de la configuration :**
```bash
php artisan config:show
```

**5. Tests unitaires :**
```bash
php artisan test
```

### Outils de diagnostic

**Informations système :**
```bash
php artisan about
```

**Vérification des permissions :**
```bash
ls -la storage/
ls -la bootstrap/cache/
```

## 📚 Ressources et documentation

### 🔧 Documentation officielle

#### Laravel
- **Documentation principale** : [laravel.com/docs](https://laravel.com/docs)
  - Architecture et concepts
  - Routing et contrôleurs
  - Eloquent ORM
  - Blade templates
  - Artisan CLI
  - Testing
  - Deployment

#### Composer
- **Documentation Composer** : [getcomposer.org/doc](https://getcomposer.org/doc/)
  - Gestion des dépendances
  - Autoloading PSR-4
  - Scripts personnalisés
  - Optimisations de performance
  - Packages privés

#### PHP
- **Manuel PHP** : [php.net/manual/fr](https://www.php.net/manual/fr/install.php)
  - Installation sur différentes plateformes
  - Configuration php.ini
  - Extensions recommandées
  - Bonnes pratiques de sécurité

### 🗄️ Gestion de base de données

#### MariaDB
- **Documentation MariaDB** : [mariadb.com/kb/en/getting-started-with-mariadb](https://mariadb.com/kb/en/getting-started-with-mariadb/)
  - Installation et configuration
  - Utilisateurs et privilèges
  - Sauvegarde et restauration
  - Optimisation des performances
  - Réplication

#### Outils graphiques
- **Sequel Pro** (Mac uniquement) : [sequelpro.com](https://sequelpro.com/)
  - Interface graphique intuitive
  - Gestion des connexions
  - Édition de données
  - Export/Import

- **DBeaver** (multiplateforme) : [dbeaver.io](https://dbeaver.io/)
  - Support multi-SGBD
  - Éditeur SQL avancé
  - Visualisation des données
  - Plugins et extensions

- **phpMyAdmin** (web) :
```bash
sudo apt install phpmyadmin
```

### 🌐 Configuration serveur web

#### Apache
- **Documentation Apache** : [httpd.apache.org/docs](https://httpd.apache.org/docs/)
  - Virtual Hosts
  - Modules PHP
  - Réécriture d'URL
  - Sécurité et performance
  - SSL/TLS

#### Nginx
- **Tutoriel Nginx + Laravel** : [digitalocean.com/community/tutorials/how-to-deploy-laravel-on-nginx-in-ubuntu-20-04](https://www.digitalocean.com/community/tutorials/how-to-deploy-laravel-on-nginx-in-ubuntu-20-04)
  - Configuration PHP-FPM
  - Gestion des domaines
  - Optimisation des performances
  - Configuration SSL

### 🌐 Développement front-end

#### Node.js et npm
- **Documentation Node.js** : [nodejs.org/en/docs](https://nodejs.org/en/docs)
  - Gestion des modules
  - Scripts package.json
  - Versioning et LTS
  - Debugging

#### Laravel Mix (Webpack)
- **Laravel Mix** : [laravel-mix.com/docs/6.0/installation](https://laravel-mix.com/docs/6.0/installation)
  - Compilation SCSS/Sass
  - Minification JS/CSS
  - Versioning des assets
  - Hot reloading

#### Vite (Laravel 9+)
- **Laravel Vite** : [laravel.com/docs/vite](https://laravel.com/docs/vite)
  - Configuration moderne
  - Hot Module Replacement
  - TypeScript support
  - Optimisations build

### 🧪 Tests et développement

#### Artisan CLI
- **Documentation Artisan** : [laravel.com/docs/artisan](https://laravel.com/docs/artisan)
  - Commandes natives
  - Création de commandes personnalisées
  - Scheduling et queues
  - Maintenance

#### Migrations et Eloquent
- **Migrations** : [laravel.com/docs/migrations](https://laravel.com/docs/migrations)
  - Création de tables
  - Modification de structure
  - Rollback et status
  - Seeders

- **Eloquent ORM** : [laravel.com/docs/eloquent](https://laravel.com/docs/eloquent)
  - Modèles et relations
  - Query Builder
  - Mutators et accessors
  - Collections

#### Testing
- **PHPUnit avec Laravel** : [laravel.com/docs/testing](https://laravel.com/docs/testing)
  - Tests unitaires
  - Tests de fonctionnalités
  - Database testing
  - Mocking

### 🎓 Formations et tutoriels

#### Plateformes d'apprentissage

**Laracasts** (anglais) - [laracasts.com](https://laracasts.com/)
- **Contenu** : 2000+ vidéos sur Laravel, PHP, JavaScript
- **Sujets** : Laravel, Vue.js, Testing, Livewire, PHP
- **Niveau** : Débutant à avancé
- **Prix** : Abonnement mensuel

**Grafikart** (français) - [grafikart.fr/formations/laravel](https://grafikart.fr/formations/laravel)
- **Contenu** : Formation Laravel complète en français
- **Sujets** : Bases de Laravel, projets pratiques
- **Niveau** : Débutant à intermédiaire
- **Prix** : Gratuit avec option premium

**Laravel From Scratch** (anglais) - [YouTube Playlist](https://www.youtube.com/playlist?list=PLpzy7FIRqpGD0kxI48v8QEVVZd744Phi4)
- **Contenu** : Série complète Laravel
- **Durée** : 30+ heures de contenu
- **Mise à jour** : Régulièrement actualisé
- **Prix** : Gratuit

#### Ressources complémentaires

**Livres recommandés :**
- "Laravel: Up & Running" par Matt Stauffer
- "Clean Code" par Robert C. Martin
- "Refactoring" par Martin Fowler

**Communautés :**
- [Laravel.io](https://laravel.io/) - Forum communautaire
- [Laracasts Forum](https://laracasts.com/discuss) - Discussions
- [Reddit r/laravel](https://reddit.com/r/laravel) - Actualités et discussions

#### 3. Problèmes de base de données
```bash
# Vérifier la connexion
php artisan migrate:status

# Réinitialiser les migrations
php artisan migrate:fresh

# Vérifier les logs
tail -f storage/logs/laravel.log
```

#### 4. Erreurs Composer
```bash
# Vider le cache Composer
composer clear-cache

# Réinstaller les dépendances
rm -rf vendor/
composer install
```

**Commandes de debugging :**
```bash
# Activer le mode debug
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Vider tous les caches
php artisan optimize:clear

# Informations sur l'environnement
php artisan about
php artisan env
```
---

Ce guide vous accompagne dans l'installation complète d'un environnement Laravel. Pour toute question spécifique, consultez la documentation officielle ou la communauté Laravel.