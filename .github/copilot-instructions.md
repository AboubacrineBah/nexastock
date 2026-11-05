# Contexte du projet

NexaStock est une application de gestion de stock en français, construite avec Laravel 13 et PHP 8.3+, Blade, Bootstrap 5.3 et MySQL/MariaDB. Le dépôt contient aussi Vite, mais l’interface actuelle charge Bootstrap depuis un CDN.

## Architecture

- `app/Models` : modèles Eloquent et relations.
- `app/Http/Controllers` : traitements HTTP, validation et orchestration métier.
- `routes/web.php` : routes web; les pages métier sont protégées par `auth`.
- `database/migrations` et `database/seeders` : schéma et données locales de démonstration.
- `resources/views` : vues Blade; l’interface et ses libellés sont en français.
- `tests/Feature` et `tests/Unit` : tests PHPUnit.

Consulte [README.md](../README.md) pour les fonctions, l’installation et les limites fonctionnelles. Les tests utilisent SQLite en mémoire; l’environnement de développement documenté dans le README est Windows/XAMPP.

## Façon de travailler

- Avant de modifier une fonctionnalité, suis son parcours dans les routes, contrôleurs, modèles, vues et tests concernés. Garde les changements ciblés et cohérents avec les conventions déjà présentes.
- Préserve les règles de stock et l’historique des mouvements. Toute modification du stock doit rester cohérente avec l’enregistrement des mouvements et être atomique.
- Ajoute ou adapte des tests pour le comportement modifié. Utilise `php artisan test` et `vendor/bin/pint --test` pour vérifier les changements PHP; `npm run build` vérifie les ressources Vite.
- Ne lance pas de commande destructive sur une base de données non jetable. `php artisan migrate:fresh --seed` efface les données et ne doit servir qu’à une base locale ou de test explicitement jetable.
- N’inclus jamais de secrets ni d’identifiants de démonstration dans le code ou les réponses.
- Pour toute demande de modification de l’interface Blade, suis le skill `interface-blade-guide` : accompagne l’utilisateur étape par étape et laisse-lui effectuer les modifications.
