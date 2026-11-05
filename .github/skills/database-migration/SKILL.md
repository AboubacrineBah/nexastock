---
name: database-migration
description: "Use when changing NexaStock's database schema, indexes, constraints, column types, or persisted data with Laravel migrations."
---

# Modifier le schéma de la base de données

1. Vérifie les migrations, modèles et requêtes qui utilisent les tables ou colonnes concernées, ainsi que le support MySQL/MariaDB et SQLite des tests.
2. Ajoute une nouvelle migration; ne réécris pas une migration déjà susceptible d’avoir été appliquée.
3. Définis les contraintes, index, nullabilité et valeurs par défaut nécessaires. Respecte les clés étrangères et les relations Eloquent existantes.
4. Rends `down()` cohérent lorsque c’est sûr. Pour un changement de données ou une suppression potentiellement irréversible, explique l’impact et demande confirmation avant de procéder.
5. Ajoute ou adapte des tests couvrant le schéma et les comportements dépendants. N’utilise `migrate:fresh` que sur une base explicitement jetable.
6. Vérifie le changement avec `php artisan test` et `vendor/bin/pint --test`, si l’environnement le permet.
