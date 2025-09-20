# Application MVC PHP

## Prérequis
- Docker installés
- (Optionnel) XAMPP ou un environnement Apache/PHP/MySQL local

## Lancement avec Docker

1. Ouvrez un terminal dans le dossier du projet.
2. Exécutez la commande suivante :

```
docker-compose up -d
```

3. Accédez à l'application via :
- http://localhost:8080 (ou le port défini dans `docker-compose.yaml`)

## Structure du projet
- `controllers/` : Contrôleurs PHP (logique métier)
- `models/` : Modèles PHP (accès aux données)
- `views/` : Vues PHP (affichage)
- `assets/` : Fichiers statiques (CSS, JS, images)
- `index.php` : Point d'entrée principal

## Arrêter les conteneurs

```
docker-compose down
```

## Dépannage
- Vérifiez les logs Docker en cas de problème :
  ```
  docker-compose logs
  ```
- Assurez-vous que le port 8080 n'est pas déjà utilisé.

---

Pour toute question, contactez l'auteur du projet.
