# 📚 Médiathèque MVC - Application PHP

Une application web complète de gestion de médiathèque développée en PHP avec architecture MVC, permettant la gestion de livres, films et albums avec système d'emprunt.

## ✨ Fonctionnalités

### 🔐 Authentification
- **Inscription** avec validation de mot de passe robuste
- **Connexion** sécurisée avec sessions
- **Gestion des utilisateurs** avec hashage des mots de passe

### 📖 Gestion des médias
- **Types supportés** : Livres, Films, Albums
- **Héritage POO** : Classes spécialisées par type de média
- **Propriétés spécifiques** :
  - Livres : nombre de pages
  - Films : durée, genre (Action, Comédie, Drame, Science-Fiction)
  - Albums : nombre de pistes, éditeur

### 🔍 Fonctionnalités utilisateur
- **Collection complète** : Visualisation de tous les médias
- **Recherche avancée** : Par titre, auteur, genre, éditeur
- **Système d'emprunt** : Emprunter/rendre des médias
- **Mes emprunts** : Suivi personnel des emprunts
- **Dashboard** : Statistiques et vue d'ensemble

### ⚙️ Administration
- **Interface d'administration** complète
- **CRUD complet** : Ajouter, modifier, supprimer des médias
- **Gestion des types** : Interface spécialisée par type de média
- **Validation des données** avec feedback utilisateur

### 🎨 Interface utilisateur
- **Design moderne** : Interface dark theme élégante
- **Système de modales** personnalisées (pas d'alert/confirm natifs)
- **Responsive design** : Compatible mobile et desktop
- **Animations fluides** : Transitions et effets visuels
- **Messages contextuels** : Feedback utilisateur intuitif

## 🛠️ Architecture technique

### Structure MVC
```
├── controllers/           # Logique métier
│   ├── AuthController.php
│   ├── MediaController.php
│   ├── UserController.php
│   ├── AdminController.php
│   └── DashboardController.php
├── models/               # Modèles et entités
│   ├── Media.php         # Classe abstraite
│   ├── Book.php          # Héritage de Media
│   ├── Movie.php         # Héritage de Media
│   ├── Album.php         # Héritage de Media
│   ├── Genre.php         # Énumération des genres
│   └── User.php
├── repository/           # Couche d'accès aux données
│   ├── MediaRepository.php
│   └── UserRepository.php
├── views/               # Interface utilisateur
│   ├── login.php
│   ├── medias.php
│   ├── dashboard.php
│   ├── my_borrows.php
│   └── admin/
└── assets/             # Ressources statiques
    └── js/
        └── modal-system.js
```

### Technologies utilisées
- **Backend** : PHP 8+ avec architecture MVC
- **Base de données** : MySQL avec PDO
- **Frontend** : HTML5, CSS3, JavaScript ES6
- **Conteneurisation** : Docker avec docker-compose
- **Serveur web** : Apache avec mod_rewrite

## 🚀 Installation et déploiement

### Prérequis
- Docker et Docker Compose installés
- Port 8080 disponible

### Lancement rapide
```bash
# Cloner le projet
git clone [url-du-repo]
cd application-MVC

# Démarrer l'environnement
docker-compose up -d

# Accéder à l'application
# http://localhost:8080
```

### Configuration de la base de données
La base de données est automatiquement initialisée avec :
- **Structure** : Tables users, medias, books, movies, albums, emprunts
- **Données d'exemple** : Jeu d'essai avec médias variés
- **Configuration** : Voir `database/schema.sql` et `database/jeu_essai.sql`

### URLs principales
- **Accueil** : http://localhost:8080
- **Connexion** : http://localhost:8080/login
- **Inscription** : http://localhost:8080/signin
- **Collection** : http://localhost:8080/medias
- **Dashboard** : http://localhost:8080/dashboard
- **Administration** : http://localhost:8080/admin

## 📊 Modèle de données

### Héritage des médias
```php
abstract class Media {
    protected string $titre;
    protected string $auteur;
    protected DateTime $datePublication;
    protected bool $disponible;
}

class Book extends Media {
    private int $pageNumber;
}

class Movie extends Media {
    private int $duration;
    private Genre $genre;
}

class Album extends Media {
    private int $songNumber;
    private string $editor;
}
```

### Relations base de données
- **Users** (1,n) → **Emprunts** (n,1) → **Medias**
- **Medias** (1,1) → **Books/Movies/Albums** (spécialisations)

## 🎯 Fonctionnalités avancées

### Système d'emprunt intelligent
- **Vérification de disponibilité** automatique
- **Suivi par utilisateur** : Un utilisateur ne peut rendre que ses propres emprunts
- **Historique complet** avec dates d'emprunt/retour

### Recherche multicritères
- **Recherche textuelle** : Titre, auteur
- **Recherche spécialisée** : Genre des films, éditeur des albums
- **Résultats paginés** avec indicateurs visuels

### Interface utilisateur moderne
- **Système de modales** : Confirmations élégantes
- **Feedback temps réel** : Messages de succès/erreur
- **Navigation intuitive** : Breadcrumbs et états actifs
- **Design responsive** : Adaptation automatique mobile/desktop

## 🔒 Sécurité

- **Hashage des mots de passe** avec `password_hash()`
- **Validation côté serveur** pour tous les formulaires
- **Protection CSRF** via sessions
- **Gestion des erreurs** sans exposition d'informations sensibles
- **Validation des types** et des données d'entrée

## 🛠️ Développement

### Commandes utiles
```bash
# Voir les logs
docker-compose logs -f

# Redémarrer les services
docker-compose restart

# Accéder au conteneur
docker-compose exec web bash

# Arrêter l'environnement
docker-compose down
```

### Structure des routes
Voir `.htaccess` pour la configuration complète des URLs propres avec mod_rewrite.
---

**Développé avec ❤️ en PHP MVC**
