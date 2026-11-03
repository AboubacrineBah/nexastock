# NexaStock

Application de gestion de stock bâtie avec Laravel 13, Blade, Bootstrap 5.3 et MySQL. Elle est configurée pour un environnement local Windows avec XAMPP.

## Fonctions disponibles

- Tableau de bord avec valeur du stock, alertes de seuil et mouvements récents
- Catalogue : création, consultation, modification, recherche et pagination des articles
- Catégories et fournisseurs : création, consultation et modification
- Mouvements d’entrée, de sortie et d’ajustement avec recalcul transactionnel du stock
- Blocage des sorties supérieures au stock disponible
- Rapport d’état et de valorisation du stock, imprimable depuis le navigateur
- Connexion, déconnexion, protection CSRF et pages métier protégées
- Données d’exemple et compte administrateur local ajoutés avec le seeder

## Prérequis

- Windows 10/11
- XAMPP avec Apache, MySQL/MariaDB et PHP 8.3 à 8.5 (le projet est créé avec Laravel 13)
- Composer 2
- Extension PHP `pdo_mysql` active
- Connexion Internet lors de l’installation initiale des dépendances et pour charger Bootstrap/les polices depuis les CDN

## Installation rapide avec XAMPP

1. Placez le dossier `NexaStock_App` dans `C:\xampp\htdocs` (ou utilisez le chemin du projet et `php artisan serve`).
2. Ouvrez XAMPP Control Panel et démarrez **Apache** et **MySQL**.
3. Dans `http://localhost/phpmyadmin`, créez une base vide nommée `nexastock` avec l’interclassement `utf8mb4_unicode_ci`.
4. Ouvrez PowerShell dans le dossier du projet et lancez `composer install`.
5. Copiez `.env.example` vers `.env` si le fichier n’existe pas. Configurez `DB_DATABASE=nexastock`, le nom d’utilisateur et le mot de passe MySQL.
6. Générez la clé avec `php artisan key:generate`.
7. Préparez les tables et les données de démonstration avec `php artisan migrate --seed`.
8. Démarrez le serveur depuis la racine du projet avec `php artisan serve`.
9. Ouvrez `http://127.0.0.1:8000` et connectez-vous avec le compte de démonstration indiqué ci-dessous.

### Identifiants de démonstration

- E-mail : `admin@nexastock.test`
- Mot de passe : `NexaStock2026!`

Ces identifiants sont réservés à l’installation locale de démonstration. Changez le mot de passe avant tout usage réel.

## Accès avec Apache via `htdocs`

Le moyen le plus simple pour démarrer le projet est `php artisan serve`. Pour l’exécuter directement dans Apache, le DocumentRoot ou l’Alias Apache doit pointer vers le sous-dossier `public` du projet, jamais vers la racine complète. Vérifiez également que `mod_rewrite` est activé et que les règles `.htaccess` de `public` sont autorisées. Une configuration Apache incorrecte peut exposer des fichiers de configuration.

## Commandes utiles

```powershell
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Pour remettre la base locale à zéro puis recharger les exemples :

```powershell
php artisan migrate:fresh --seed
```

Cette dernière commande supprime toutes les données des tables gérées par les migrations NexaStock. Ne l’utilisez pas sur une base contenant des données à conserver.

## Structure fonctionnelle

- `app/Models` : articles, catégories, fournisseurs et mouvements
- `app/Http/Controllers` : traitements métier et contrôleurs
- `database/migrations` : schéma MySQL
- `database/seeders/DatabaseSeeder.php` : compte local et données de démonstration
- `resources/views` : interface Bootstrap en français
- `routes/web.php` : pages publiques et pages protégées par authentification

## Limites du socle livré

Cette première version couvre les flux de base du cahier des charges. Les fonctions de gestion des utilisateurs/rôles, inventaires avec sessions de comptage, export CSV/PDF, notifications et réinitialisation de mot de passe par e-mail restent à développer. Les pages Bootstrap chargent les ressources depuis des CDN. Pour une installation sans Internet, il faudra intégrer les fichiers Bootstrap localement.

## Licence et identité

Interface NexaStock, identité visuelle dédiée et composants réalisés pour NexaWeb Mali. Le framework Laravel et Bootstrap conservent leurs licences respectives.
