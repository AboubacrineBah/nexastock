---
name: laravel-feature
description: "Use when implementing, extending, or fixing a NexaStock business feature in Laravel: trace its route, controller, model, view, validation, and tests, then verify the behavior."
---

# Développer une fonctionnalité Laravel

1. Reformule le comportement attendu et relève les cas d’erreur ou règles métier qui ne sont pas précisés. Demande une clarification si plusieurs interprétations changent le résultat.
2. Suis le parcours existant depuis `routes/web.php` vers le contrôleur, les modèles, les vues et les tests. Identifie les surfaces à garder cohérentes.
3. Implémente le changement le plus petit qui respecte les conventions locales, les noms français et les protections d’accès existantes.
4. Ajoute ou adapte des tests PHPUnit pour le comportement attendu, les limites et les erreurs pertinentes.
5. Lance les tests ciblés, puis `php artisan test` et `vendor/bin/pint --test` si l’environnement le permet. Pour les ressources Vite modifiées, lance `npm run build`.
6. Résume les fichiers et comportements modifiés, les vérifications exécutées et tout point restant.

Ne modifie pas une règle de stock ou un schéma de base sans suivre également `stock-movement` ou `database-migration`, selon le cas.
