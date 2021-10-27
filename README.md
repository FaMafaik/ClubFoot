# ClubFoot

## Environnement de développement

### Pré-requis

* Environnement de serveurs : WampServer (PHP, phpMyAdmin, MySQL)
* PHP 7.4
* Gestionnaire de dépendances PHP : Composer
* Symfony CLI

### Lancer l'environnement de développement

* Activer le serveur local avec Wamp. Tout les services doivent être lancé.

* Créer la base de données sur Wamp avec la commande :
```bash
php bin/console doctrine:database:create
```

### Ajouter les données de tests

* Sur la base de données principale, pour tester le site directement
```bash
php bin/console doctrine:fixtures:load
```

* Sur la base de données de l'environnement de test, pour lancer les tests unitaires et fonctionnels

### Lancer les tests

```bash
php bin/phpunit
```

### Les identifiants du compte admin

* Email : admin@gmail.com
* Mot de passe : admin123