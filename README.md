# README - Installation Serveur Laravel

## Prérequis système

- PHP >= 8.1
- Serveur web (Apache ou Nginx)
- Base de données (MariaDB/MySQL)
- Composer
- Node.js & npm

## Installation

### 1. Installation de PHP et extensions

**Sur Ubuntu/Debian :**
```bash
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-bcmath php-curl php-mysql php-tokenizer php-zip php-json unzip curl
```

**Vérifier la version PHP :**
```bash
php -v
```

### 2. Installation du serveur web

**Option A - Apache :**
```bash
sudo apt install apache2 libapache2-mod-php
sudo systemctl start apache2
sudo systemctl enable apache2
```

**Option B - Nginx + PHP-FPM :**
```bash
sudo apt install nginx php-fpm
sudo systemctl start nginx
sudo systemctl enable nginx
sudo systemctl start php8.1-fpm
```

### 3. Installation de la base de données

**MariaDB/MySQL :**
```bash
sudo apt install mysql-server
sudo mysql_secure_installation
```

### 4. Installation de Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### 5. Installation de Node.js & npm

```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs
node -v
npm -v
```

## Configuration du projet Laravel

### 1. Créer un nouveau projet

```bash
composer create-project laravel/laravel nom_du_projet
cd nom_du_projet
```

### 2. Configuration de l'environnement

```bash
cp .env.example .env
```

**Modifier le fichier `.env` :**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=utilisateur
DB_PASSWORD=motdepasse
```

### 3. Installation des dépendances

**Dépendances PHP :**
```bash
composer install
```

**Dépendances front-end :**
```bash
npm install
npm run dev
```

### 4. Configuration de la base de données

1. Se connecter à MariaDB
2. Créer une base de données "cesizen"
3. Configurer le `.env` avec les informations de connexion

### 5. Migrations et lancement

**Créer les tables :**
```bash
php artisan migrate
```

**Lancer le serveur de développement :**
```bash
php artisan serve
```

## Tests

Le serveur sera accessible à l'adresse : `http://localhost:8000`

## Notes importantes

- Assurez-vous que tous les services (Apache/Nginx, MySQL, PHP-FPM si applicable) sont démarrés
- Vérifiez les permissions sur le répertoire du projet
- La base de données "cesizen" doit être créée avant de lancer les migrations

## Dépannage

En cas de problème, vérifiez :
- Les logs Apache/Nginx
- Les logs PHP
- La connectivité à la base de données
- Les permissions de fichiers