# ClubFoot

## Environnement de développement

### Pré-requis

* Environnement de serveurs : WampServer (PHP, phpMyAdmin, MySQL)
* PHP 7.4
* Gestionnaire de dépendances PHP : Composer
* Symfony CLI
* Éditeur de code : Visual Studio Code (optionnel)

### Récupérer le dépot distant et le configurer sur WampServer

* Télécharger le dossier du répositoire en .zip
* Décompresser le dossier .zip dans le dossier 'www' de Wamp
* Créer le virtualhost sur Wamp en indiquant le chemin complet absolu du dossier

    - "C:/wamp64/www/nom_du_dossier/public"

    - Exemple : C:/wamp64/www/clubfoot/public

### Lancer l'environnement de développement

* Activer le serveur local avec Wamp. Tout les services doivent être lancés

* Créer la base de données sur Wamp avec la commande depuis le terminal de Visual Studio Code:
```bash
php bin/console doctrine:database:create
```

* Créer les migrations avec la base de données
```bash
php bin/console make:migration
```

* Appliquer les migrations sur la base de données
```bash
php bin/console doctrine:migrations:migrate
```

### Ajouter les données de tests

* Sur la base de données principale, pour tester le site directement
```bash
php bin/console doctrine:fixtures:load
```

### Lancer les tests

```bash
php bin/phpunit
```

* Pour avoir la couverture sur l'ensemble du code on utilise la commande suivante :
```bash
php bin/phpunit --coverage-html var/log/test/test-coverage
```

### Les identifiants du compte admin

* Email : admin@gmail.com
* Mot de passe : admin123